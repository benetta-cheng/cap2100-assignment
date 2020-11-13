<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\Staff;
use App\Models\Student;
use App\Models\SupportingDocument;
use Illuminate\Http\Request;

class LeaveController extends Controller
{

    public function show(LeaveApplication $leave)
    {

        // Authentication check
        $user = auth()->user();

        if ($user instanceof Student && $leave->student->is($user)) {
            $userRole = 'Student';
        } else {
            if ($user->staff_type === 'io') {
                if ($leave->student->student_type === 'international') {
                    $userRole = 'IO';
                }
            } else if ($user->staff_type === 'hop' && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                $userRole = 'HOP';
            } else {
                foreach ($leave->leaveActions->where('staff_authority', 'lecturer') as $action) {
                    if ($action->session->section->staff->is($user)) {
                        $userRole = 'Lecturer';
                    }
                }
            }
        }

        abort_unless(isset($userRole), 403);

        $leaveActions = $leave->leaveActions;
        $userLeaveStatus = $leave->status;

        foreach ($leaveActions as $leaveAction) {
            if ($leaveAction->staff_authority === 'lecturer') {
                $section = $leaveAction->session->section;

                if ($user instanceof Staff && $section->staff->is($user)) {
                    $userLeaveStatus = $leaveAction->staff_status;
                }

                $course = $section->course;
                $affectedClasses[] = $course->course_id . " " . $course->course_name;
            } else if ($user instanceof Staff && $userRole === strtoupper($leaveAction->staff_authority)) {
                $userLeaveStatus = $leaveAction->staff_status;
            }
        }

        $leaveData = [
            "userRole" => $userRole,
            "leaveStatus" => strtoupper($leave->status),
            "userLeaveStatus" => strtoupper($userLeaveStatus),
            "affectedClasses" => $affectedClasses,
            'leave' => $leave
        ];

        if ($userRole !== 'Lecturer') {
            $courseIds = [];
            foreach ($leaveActions as $leaveAction) {

                $individualApprovalStatus = [
                    "status" => strtoupper($leaveAction->staff_status),
                    "remarks" => $leaveAction->remarks
                ];

                switch ($leaveAction->staff_authority) {
                    case "lecturer":
                        $section = $leaveAction->session->section;
                        if (in_array($section->course_id, $courseIds)) {
                            // The course is already added into the approval status, this is just another session from the same course and section
                            continue 2;
                        }
                        $individualApprovalStatus['approver'] = strtoupper($section->staff->name) . " (" . $section->course_id . ")";

                        $courseIds[] = $section->course_id;
                        break;
                    case "hop":
                        $individualApprovalStatus['approver'] = strtoupper($leave->student->studentProgramme->headOfProgramme->name) . " (HOP)";
                        break;
                    case "io":
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

            if ($user->staff_type === 'io' && $leave->student->student_type === 'international') {

                $leaveAction = $leave->leaveActions->where('staff_authority', 'io')->first();

                if (!$leaveAction->completed()) {
                    $leaveAction->setStatus('approved');
                }
            } else {

                $lecturerLeaveActions = $leave->leaveActions->where('staff_authority', 'lecturer');

                // Set approve for lecturer
                foreach ($lecturerLeaveActions as $leaveAction) {
                    if ($leaveAction->session->section->staff->is($user)) {
                        if (!$leaveAction->completed()) {
                            $leaveAction->setStatus('approved');
                        }
                    }
                }

                // If HOP, set approve for the whole leave application as well
                if ($user->staff_type === 'hop' && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                    $leave->leaveActions->where('staff_authority', 'hop')->first()->setStatus('approved');
                    $leave->setStatus('approved');
                }
            }
        }

        return redirect('leave/' . $leave->leave_id);
    }

    public function reject(Request $request, LeaveApplication $leave)
    {

        $user = auth()->user();

        if (!$leave->completed()) {

            if ($user->staff_type === 'io' && $leave->student->student_type === 'international') {

                $leaveAction = $leave->leaveActions->where('staff_authority', 'io')->first();

                if (!$leaveAction->completed()) {
                    $leaveAction->setStatus('rejected', $request->post('remarks'));
                }
            } else {

                $lecturerLeaveActions = $leave->leaveActions->where('staff_authority', 'lecturer');

                // Set complete for lecturer
                foreach ($lecturerLeaveActions as $leaveAction) {
                    if ($leaveAction->session->section->staff->is($user)) {
                        if (!$leaveAction->completed()) {
                            $leaveAction->setStatus('rejected', $request->post('remarks'));
                        }
                    }
                }

                // If HOP, set complete for the whole leave application as well
                if ($user->staff_type === 'hop' && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                    $leave->leaveActions->where('staff_authority', 'hop')->first()->setStatus('rejected', $request->post('remarks'));
                    $leave->setStatus('rejected');
                }
            }
        }

        return redirect('leave/' . $leave->leave_id);
    }

    public function meetStudent(Request $request, LeaveApplication $leave)
    {

        $user = auth()->user();

        if (!$leave->completed()) {

            if ($user->staff_type === 'io' && $leave->student->student_type === 'international') {

                $leaveAction = $leave->leaveActions->where('staff_authority', 'io')->first();

                if (!$leaveAction->completed()) {
                    $leaveAction->setStatus('meet student', $request->post('remarks'));
                }
            } else {

                $lecturerLeaveActions = $leave->leaveActions->where('staff_authority', 'lecturer');

                // Set complete for lecturer
                foreach ($lecturerLeaveActions as $leaveAction) {
                    if ($leaveAction->session->section->staff->is($user)) {
                        if (!$leaveAction->completed()) {
                            $leaveAction->setStatus('meet student', $request->post('remarks'));
                        }
                    }
                }

                // If HOP, set complete for the whole leave application as well
                if ($user->staff_type === 'hop' && $leave->student->studentProgramme->headOfProgramme->is($user)) {
                    $leave->leaveActions->where('staff_authority', 'hop')->first()->setStatus('meet student', $request->post('remarks'));
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
                $leave->setStatus('cancelled');
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
            if ($user->staff_type === 'io' && $leave->student->student_type === 'international') {
                $permitted = true;
            } else if ($user->staff_type === 'hop') {
                if ($leave->student->studentProgramme->headOfProgramme->is($user)) {
                    $permitted = true;
                }
            } else {
                foreach ($leave->leaveActions->where('staff_authority', 'lecturer') as $action) {
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
