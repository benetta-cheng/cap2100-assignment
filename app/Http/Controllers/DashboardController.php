<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Enum\UserType;
use App\Models\Update;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        //Authentication check
        $user = auth()->user();

        // $studentUser = Student::find(DashboardController::$studentUserId);

        $updates = Update::where('student_id', '=', $user->student_id)->orderBy('created_at', 'desc')->get();
        $leaves = $user->leaveApplication;

        $approvalStatuses = [];
        foreach ($leaves as $leave) {

            $courses = [];

            foreach ($leave->leaveActions->where('staff_authority', UserType::LECTURER) as $action) {
                $course_id = $action->session->section->course->course_id;
                if (!in_array($course_id, $courses)) {
                    $courses[] = $course_id;
                }
            }

            $approvalStatuses[] = [
                "courses" => implode(", ", $courses),
                "leaveId" => $leave->leave_id,
                "status" => $leave->status
            ];
        }

        $newUpdates = [];
        foreach ($updates as $update) {
            $message = $update->action_message;
            if ($update->staff_id) {
                $message = str_replace('[staff]', $update->staff->name, $message);
            }
            $newUpdates[] = [
                'message' => str_replace('[leaveID]', $update->leave_id, $message),
                'leaveId' => $update->leave_id
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
