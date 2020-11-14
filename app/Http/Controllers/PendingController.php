<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PendingController extends Controller
{
    public function show(Request $request)
    {

        // SELECT * FROM student WHERE student_id = 'J12345678';
        $staffUser = Staff::find('S0001');

        $staffUser->leaveApplication;
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
                            "startDate" => $leave->start_date,
                            "endDate" => $leave->end_date
                        ];
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

        foreach ($leaves as $key => $leave) {
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

        return view('pending', ["leaves" => $paginatedLeaves, "section" => $section]);
    }
}
