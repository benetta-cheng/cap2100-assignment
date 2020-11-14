<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    private static $studentUserId = 'J12345678';

    public function show()
    {
        // Route::get('/dashboard', function () {
        //     $dashboardTestData = [
        //         "newUpdates" => [
        //             ["update" => "Mr Tang Yang Tze has approved your leave", "leaveId" => "SL12345"],
        //             ["update" => "Ms Ng Ruoh Ling has approved your leave", "leaveId" => "SL12345"],
        //             ["update" => "Ms Fui Chie Shee has approved your leave", "leaveId" => "SL12345"],
        //             ["update" => "Ms Lusiana Syaiful has approved your leave", "leaveId" => " SL12344"],
        //         ],
        //         "approvalStatuses" => [
        //             ["course" => "IBM2104", "leaveId" => "SL12345", "status" => "APPROVED"],
        //             ["course" => "IBM2105", "leaveId" => "SL12345", "status" => "REJECTED"],
        //             ["course" => "CAP2100", "leaveId" => "SL12345", "status" => "PENDING"],
        //             ["course" => "IBM2104", "leaveId" => "SL12345", "status" => "REJECTED"]
        //         ]
        //     ];
        //     return view('dashboard', $dashboardTestData);
        // });

        $studentUser = Student::find(DashboardController::$studentUserId);

        $updates = $studentUser->updates;
        $leaves = $studentUser->leaveApplication;

        $approvalStatuses = [];
        foreach ($leaves as $leave) {

            $courses = [];

            foreach ($leave->leaveActions->where('staff_authority', 'lecturer') as $action) {
                $course_id = $action->session->section->course->course_id;
                if (!in_array($course_id, $courses)) {
                    $courses[] = $course_id;
                }
            }

            $approvalStatuses[] = [
                "courses" => implode(", ", $courses),
                "leaveId" => $leave->leave_id,
                "status" => strtoupper($leave->status)
            ];
        }

        $newUpdates = [];
        foreach ($updates as $update) {
            $newUpdates[] = [
                "update" => $update->staff->name,
                "leaveId" => $update->leaveApplication->leave_id
            ];
        }

        $calendarData = [];
        foreach ($leaves as $event) {
            $calendarData[] = [
                "leaveId" => $event->leave_id,
                "startDate" => date('Y-m-d\TH:i:s', strtotime($event->start_date)),
                "endDate" => date('Y-m-d\TH:i:s', strtotime($event->end_date)),
                "status" => $event->status
            ];
        }

        $dashboardData = [
            "newUpdates" => $newUpdates,
            "approvalStatuses" => $approvalStatuses,
            "calendarData" => $calendarData
        ];

        return view('dashboard', $dashboardData);
    }
}
