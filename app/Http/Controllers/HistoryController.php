<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function show(Request $request)
    {
        $userRole = 'Staff';

        // SELECT * FROM student WHERE student_id = 'J12345678';
        $studentUser = Student::find('J12345678');
        $staffUser = Staff::find('S0001');

        if ($userRole === 'Student') {
            // SELECT * FROM leave_application WHERE student_id = 'J12345678';
            $leaveApplications = $studentUser->leaveApplication;

            foreach ($leaveApplications as $leave) {
                $leaves[] = [
                    "leaveId" => $leave->leave_id,
                    "approvalStatus" => $leave->status,
                    "dateApplied" => $leave->created_at,
                    "leaveDateFrom" => $leave->start_date,
                    "leaveDateTo" => $leave->end_date
                ];
            }
        } else {

            $sections = $staffUser->section;

            foreach ($sections as $section) {
                $sessions = $section->session;

                foreach ($sessions as $session) {
                    $leaveActions = $session->leaveActions;

                    if ($leaveActions->count() > 0) {
                        foreach ($leaveActions as $action) {
                            $leave = $action->leaveApplication;
                            $leaves[] = [
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

        // Date From Filter
        foreach ($leaves as $key => $leave) {
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
        }

        // Status Filter
        foreach ($leaves as $key => $leave) {
            if ($request->filled('approvalStatus')) {
                if ($request->get('approvalStatus') !== $leave['status']) {
                    unset($leaves[$key]);
                }
            }
        }

        // Name filter
        foreach ($leaves as $key => $leave) {
            if ($request->filled('name')) {
                if (strtoupper($request->get('name')) !== strtoupper($leave['student'])) {
                    unset($leaves[$key]);
                }
            }
        }

        // Course Filter
        foreach ($leaves as $key => $leave) {
            if ($request->filled('course')) {
                if (strtoupper($request->get('course')) !== strtoupper($leave['courseId'])) {
                    unset($leaves[$key]);
                }
            }
        }

        return view('history', ["userRole" => $userRole, "leaves" => $leaves, "section" => $section]);
    }
}
