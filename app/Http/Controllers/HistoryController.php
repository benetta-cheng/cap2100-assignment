<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enum\UserType;
use App\Enum\StudentType;

class HistoryController extends Controller
{
    public function show(Request $request)
    {
        $user = auth()->user();

        if ($user instanceof Student) {
            $userRole = UserType::STUDENT;
        } else {
            $userRole = $user->staff_type;
        }

        $leaves = [];
        if ($user instanceof Student) {
            $leaveApplications = $user->leaveApplication;

            foreach ($leaveApplications as $leave) {
                $leaves[] = [
                    "leaveId" => $leave->leave_id,
                    "status" => $leave->status,
                    "dateApplied" => $leave->created_at,
                    "createdAt" => $leave->created_at,
                    "startDate" => $leave->start_date,
                    "endDate" => $leave->end_date
                ];
            }
        } else if ($user->staff_type === UserType::IO) {
            $students = Student::where('student_type', '=', StudentType::INTERNATIONAL)->get();

            foreach ($students as $student) {
                $leaveApplications = $student->leaveApplication;

                foreach ($leaveApplications as $leave) {
                    $leaveAction = $leave->leaveActions->where('staff_authority', UserType::IO)->first();
                    if ($leaveAction->completed() || $leave->completed()) {
                        $leaves[] = [
                            "leaveId" => $leave->leave_id,
                            "student" => $student->name,
                            "status" => $leave->status,
                            "createdAt" => $leave->created_at,
                            "startDate" => $leave->start_date,
                            "endDate" => $leave->end_date
                        ];
                    }
                }
            }
        } else {

            $sections = $user->section;

            foreach ($sections as $section) {
                $sessions = $section->session;

                foreach ($sessions as $session) {
                    $leaveActions = $session->leaveActions;

                    if ($leaveActions->count() > 0) {
                        foreach ($leaveActions as $action) {
                            $leave = $action->leaveApplication;
                            if ($action->completed() || $leave->completed()) {
                                if (isset($leaves[$leave->leave_id])) {
                                    $leaves[$leave->leave_id]['courseId'] .= ", " . $section->course_id;
                                } else {
                                    $leaves[$leave->leave_id] = [
                                        "leaveId" => $leave->leave_id,
                                        "courseId" => $section->course_id,
                                        "student" => $leave->student->name,
                                        "status" => $leave->status,
                                        "createdAt" => $leave->created_at,
                                        "startDate" => $leave->start_date,
                                        "endDate" => $leave->end_date
                                    ];
                                }
                            }
                        }
                    }
                }
            }

            if ($user->staff_type === UserType::HOP) {
                foreach ($user->programme as $programme) {
                    $students = $programme->student;
                    foreach ($students as $student) {
                        $leaveApplications = $student->leaveApplication;

                        foreach ($leaveApplications as $leave) {
                            if ($leave->completed()) {
                                if (isset($leaves[$leave->leave_id])) {
                                    $leaves[$leave->leave_id]['courseId'] .= ' (HOP)';
                                } else {
                                    $leaves[] = [
                                        "leaveId" => $leave->leave_id,
                                        "courseId" => 'HOP',
                                        "student" => $student->name,
                                        "status" => $leave->status,
                                        "createdAt" => $leave->created_at,
                                        "startDate" => $leave->start_date,
                                        "endDate" => $leave->end_date
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }


        foreach ($leaves as $key => $leave) {
            // Date Filter
            // The startDate and endDate will undergo the date() function first to remove the time part
            if ($request->filled('leaveDateFrom') && $request->filled('leaveDateTo')) {
                if (strtotime(date('d-m-Y', strtotime($leave['endDate']))) < strtotime($request->get('leaveDateFrom')) || strtotime(date('d-m-Y', strtotime($leave['startDate']))) > strtotime($request->get('leaveDateTo'))) {
                    unset($leaves[$key]);
                }
            } else if ($request->filled('leaveDateFrom')) {
                if (strtotime(date('d-m-Y', strtotime($leave['endDate']))) < strtotime($request->get('leaveDateFrom'))) {
                    unset($leaves[$key]);
                }
            } else if ($request->filled('leaveDateTo')) {
                if (strtotime(date('d-m-Y', strtotime($leave['startDate']))) > strtotime($request->get('leaveDateTo'))) {
                    unset($leaves[$key]);
                }
            }

            // Status Filter
            if ($request->filled('approvalStatus')) {
                if ($request->get('approvalStatus') !== $leave['status']) {
                    unset($leaves[$key]);
                }
            }

            // Name filter
            if ($request->filled('name')) {
                if (strtoupper($request->get('name')) !== strtoupper($leave['student'])) {
                    unset($leaves[$key]);
                }
            }

            // Course Filter
            if ($request->filled('course')) {
                if (strtoupper($request->get('course')) !== strtoupper($leave['courseId'])) {
                    unset($leaves[$key]);
                }
            }

            // LeaveID Filter
            if ($request->filled('leaveId')) {
                if (strpos(strtoupper($leave['leaveId']), strtoupper($request->get('leaveId'))) === false) {
                    unset($leaves[$key]);
                }
            }
        }

        return view('history', ["userRole" => $userRole, "leaves" => $leaves]);
    }
}
