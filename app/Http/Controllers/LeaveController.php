<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\Staff;
use App\Models\Student;
use App\Models\SupportingDocument;
use Illuminate\Http\Request;
use App\Enum\LeaveStatus;
use App\Enum\StudentType;
use App\Enum\UserType;
use App\Models\Update;

class LeaveController extends Controller
{
    public function show(LeaveApplication $leave)
    {
        $user = auth()->user();

        if ($user instanceof Student && $leave->student->is($user)) {
            $userRole = UserType::STUDENT;
        } else {
            if ($user->staff_type === UserType::IO) {
                if ($leave->student->student_type === StudentType::INTERNATIONAL) {
                    $userRole = UserType::IO;
                }
            } else if ($user->staff_type === UserType::HOP && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                $userRole = UserType::HOP;
            } else {
                foreach ($leave->leaveActions->where('staff_authority', UserType::LECTURER) as $action) {
                    if ($action->session->section->staff->is($user)) {
                        $userRole = UserType::LECTURER;
                    }
                }
            }
        }

        abort_unless(isset($userRole), 403);

        // Clear updates if there are updates
        if ($userRole === UserType::STUDENT) {
            Update::where([['student_id', '=', $user->student_id], ['leave_id', '=', $leave->leave_id]])->delete();
        }

        $leaveActions = $leave->leaveActions;
        $userLeaveStatus = $leave->status;

        foreach ($leaveActions as $leaveAction) {
            if ($leaveAction->staff_authority === UserType::LECTURER) {
                $section = $leaveAction->session->section;
                $course = $section->course;

                if ($user instanceof Staff) {
                    if ($section->staff->is($user)) {
                        $userLeaveStatus = $leaveAction->staff_status;

                        // User is the lecturer, show them the course
                        $affectedClasses[] = $course->course_id . " " . $course->course_name;
                    } else if ($userRole !== UserType::LECTURER) {
                        // User is not the lecturer but they are IO or HOP
                        $affectedClasses[] = $course->course_id . " " . $course->course_name;
                    }
                } else {
                    // User is student, show all affected classes
                    $affectedClasses[] = $course->course_id . " " . $course->course_name;
                }
            } else if ($user instanceof Staff && $userRole === $leaveAction->staff_authority) {
                $userLeaveStatus = $leaveAction->staff_status;
            }
        }

        $leaveData = [
            "userRole" => $userRole,
            "leaveStatus" => $leave->status,
            "userLeaveStatus" => $userLeaveStatus,
            "affectedClasses" => $affectedClasses,
            'leave' => $leave
        ];

        if ($userRole !== UserType::LECTURER) {
            $courseIds = [];
            foreach ($leaveActions as $leaveAction) {

                $individualApprovalStatus = [
                    "status" => $leaveAction->staff_status,
                    "remarks" => $leaveAction->remarks
                ];

                switch ($leaveAction->staff_authority) {
                    case UserType::LECTURER:
                        $section = $leaveAction->session->section;
                        if (in_array($section->course_id, $courseIds)) {
                            // The course is already added into the approval status, this is just another session from the same course and section
                            continue 2;
                        }
                        $individualApprovalStatus['approver'] = strtoupper($section->staff->name) . " (" . $section->course_id . ")";

                        $courseIds[] = $section->course_id;
                        break;
                    case UserType::HOP:
                        $individualApprovalStatus['approver'] = strtoupper($leave->student->studentProgramme->headOfProgramme->name) . " (HOP)";
                        break;
                    case UserType::IO:
                        $individualApprovalStatus['approver'] = "INTERNATIONAL OFFICE (IO)";
                        break;
                }

                $approvalStatus[] = $individualApprovalStatus;
            }
            $leaveData['approvalStatus'] = $approvalStatus;
        }

        return view('leave', $leaveData);
    }

    public function approve(LeaveApplication $leave)
    {

        $user = auth()->user();

        if (!$leave->completed()) {

            if ($user->staff_type === UserType::IO && $leave->student->student_type === StudentType::INTERNATIONAL) {

                $leaveAction = $leave->leaveActions->where('staff_authority', UserType::IO)->first();

                if (!$leaveAction->completed()) {
                    $leaveAction->setStatus(LeaveStatus::APPROVED);
                }
            } else {

                $updatedSent = false;

                $lecturerLeaveActions = $leave->leaveActions->where('staff_authority', UserType::LECTURER);

                // Set approve for lecturer
                foreach ($lecturerLeaveActions as $leaveAction) {
                    if ($leaveAction->session->section->staff->is($user)) {
                        if (!$leaveAction->completed()) {
                            $leaveAction->setStatus(LeaveStatus::APPROVED, null, !$updatedSent);
                            $updatedSent = true;
                        }
                    }
                }

                // If HOP, set approve for the whole leave application as well
                if ($user->staff_type === UserType::HOP && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                    $leave->leaveActions->where('staff_authority', UserType::HOP)->first()->setStatus(LeaveStatus::APPROVED, null, !$updatedSent);
                    $leave->setStatus(LeaveStatus::APPROVED);
                }
            }
        }

        return redirect('leave/' . $leave->leave_id);
    }

    public function reject(Request $request, LeaveApplication $leave)
    {

        $user = auth()->user();

        if (!$leave->completed()) {

            if ($user->staff_type === UserType::IO && $leave->student->student_type === StudentType::INTERNATIONAL) {

                $leaveAction = $leave->leaveActions->where('staff_authority', UserType::IO)->first();

                if (!$leaveAction->completed()) {
                    $leaveAction->setStatus(LeaveStatus::REJECTED, $request->post('remarks'));
                }
            } else {

                $updatedSent = false;

                $lecturerLeaveActions = $leave->leaveActions->where('staff_authority', UserType::LECTURER);

                // Set complete for lecturer
                foreach ($lecturerLeaveActions as $leaveAction) {
                    if ($leaveAction->session->section->staff->is($user)) {
                        if (!$leaveAction->completed()) {
                            $leaveAction->setStatus(LeaveStatus::REJECTED, $request->post('remarks'), !$updatedSent);
                            $updatedSent = true;
                        }
                    }
                }

                // If HOP, set complete for the whole leave application as well
                if ($user->staff_type === UserType::HOP && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                    $leave->leaveActions->where('staff_authority', UserType::HOP)->first()->setStatus(LeaveStatus::REJECTED, $request->post('remarks'), !$updatedSent);
                    $leave->setStatus(LeaveStatus::REJECTED);
                }
            }
        }

        return redirect('leave/' . $leave->leave_id);
    }

    public function meetStudent(Request $request, LeaveApplication $leave)
    {

        $user = auth()->user();

        if (!$leave->completed()) {

            if ($user->staff_type === UserType::IO && $leave->student->student_type === StudentType::INTERNATIONAL) {

                $leaveAction = $leave->leaveActions->where('staff_authority', UserType::IO)->first();

                if (!$leaveAction->completed()) {
                    $leaveAction->setStatus(LeaveStatus::MEET_STUDENT, $request->post('remarks'));
                }
            } else {

                $updatedSent = false;

                $lecturerLeaveActions = $leave->leaveActions->where('staff_authority', UserType::LECTURER);

                // Set complete for lecturer
                foreach ($lecturerLeaveActions as $leaveAction) {
                    if ($leaveAction->session->section->staff->is($user)) {
                        if (!$leaveAction->completed()) {
                            $leaveAction->setStatus(LeaveStatus::MEET_STUDENT, $request->post('remarks'), !$updatedSent);
                            $updatedSent = true;
                        }
                    }
                }

                // If HOP, set complete for the whole leave application as well
                if ($user->staff_type === UserType::HOP && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                    $leave->leaveActions->where('staff_authority', UserType::HOP)->first()->setStatus(LeaveStatus::MEET_STUDENT, $request->post('remarks'), !$updatedSent);
                }
            }
        }

        return redirect('leave/' . $leave->leave_id);
    }

    public function cancel(LeaveApplication $leave)
    {

        $user = auth()->user();

        if (!$leave->completed()) {

            if ($leave->student->is($user)) {
                $leave->setStatus(LeaveStatus::CANCELLED);
            }
        }

        return redirect('leave/' . $leave->leave_id);
    }

    public function getSupportingDocument(LeaveApplication $leave, SupportingDocument $supportingDocument)
    {
        // Authentication check
        $user = auth()->user();

        $permitted = false;

        if ($user instanceof Student && $leave->student->is($user)) {
            $permitted = true;
        } else {
            if ($user->staff_type === UserType::IO && $leave->student->student_type === StudentType::INTERNATIONAL) {
                $permitted = true;
            } else if ($user->staff_type === UserType::HOP && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                $permitted = true;
            } else {
                foreach ($leave->leaveActions->where('staff_authority', UserType::LECTURER) as $action) {
                    if ($action->session->section->staff->is($user)) {
                        $permitted = true;
                    }
                }
            }
        }

        abort_unless($permitted, 403);

        return response()->file(storage_path('app/supportingDocuments/' . $leave->leave_id . '/' . $supportingDocument->filename));
    }
}
