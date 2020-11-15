<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Student;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Enum\UserType;
use App\Enum\StudentType;

class PendingController extends Controller
{
    public function show(Request $request)
    {
        //Authentication check
        $user = auth()->user();

        // if ($user->staff_type === UserType::IO) {
        //     if ($request->student->student_type === StudentType::INTERNATIONAL) {
        //         $userRole = UserType::IO;
        //     }
        // } else if ($user->staff_type === UserType::HOP && $request->student->studentProgramme->headOfProgramme->is($user)) {
        //     $userRole = UserType::HOP;
        // } else {
        //     foreach ($request->leaveActions->where('staff_authority', UserType::LECTURER) as $action) {
        //         if ($action->session->section->staff->is($user)) {
        //             $userRole = UserType::LECTURER;
        //         }
        //     }
        // }


        // SELECT * FROM student WHERE student_id = 'J12345678';
        // $staffUser = Staff::find('S0001');

        // $user->leaveApplication;
        $leaves = [];
        $sections = $user->section;

        if ($user->staff_type === UserType::IO) {
            $students = Student::where('student_type', '=', StudentType::INTERNATIONAL);

            foreach ($students as $student) {
                $leaveApplications = $student->leaveApplication;

                foreach ($leaveApplications as $leave) {
                    $leaveAction = $leave->leaveActions->where('staff_authority', UserType::IO)->first();
                    if (!$leaveAction->completed() && !$leave->completed()) {
                        $leaves[] = [
                            "leaveId" => $leave->leave_id,
                            "student" => $student->name,
                        ];
                    }
                }
            }
        } else {

            foreach ($sections as $section) {
                $sessions = $section->session;

                foreach ($sessions as $session) {
                    $leaveActions = $session->leaveActions;

                    if ($leaveActions->count() > 0) {
                        foreach ($leaveActions as $action) {
                            $leave = $action->leaveApplication;
                            if (!$action->completed() && !$leave->completed()) {
                                if (isset($leaves[$leave->leave_id])) {
                                    $leaves[$leave->leave_id]['courseId'] .= ", " . $section->course_id;
                                } else {
                                    $leaves[$leave->leave_id] = [
                                        "leaveId" => $leave->leave_id,
                                        "courseId" => $section->course_id,
                                        "student" => $leave->student->name
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
                            if (!$leave->completed()) {
                                if (isset($leaves[$leave->leave_id])) {
                                    $leaves[$leave->leave_id]['courseId'] .= ' (HOP)';
                                } else {
                                    $leaves[] = [
                                        "leaveId" => $leave->leave_id,
                                        "courseId" => 'HOP',
                                        "student" => $student->name
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

            // Course Filter
            if ($request->filled('course')) {
                if (strtoupper($request->get('course')) !== strtoupper($leave['courseId'])) {
                    unset($leaves[$key]);
                }
            }
        }

        $perPage = 10;
        $pageStart = request()->get('page', 1);
        $offSet = ($pageStart * $perPage) - $perPage;

        $itemsForCurrentPage = array_slice($leaves, $offSet, $perPage, true);

        $paginatedLeaves = new LengthAwarePaginator($itemsForCurrentPage, count($leaves), $perPage, LengthAwarePaginator::resolveCurrentPage(), array('path' => LengthAwarePaginator::resolveCurrentPath()));

        return view('pending', ["staffType" => $user->staff_type, "leaves" => $paginatedLeaves, "section" => $sections]);
    }
}
