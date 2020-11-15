<?php

namespace App\Http\Controllers;

use App\Models\LeaveAction;
use App\Models\LeaveApplication;
use App\Models\Student;
use App\Models\SupportingDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;
use App\Enum\StudentType;
use App\Enum\LeaveType;
use App\Enum\UserType;

class LeaveApplicationConfirmationController extends Controller
{
    //Post to confirmation page and display leave application
    public function passInput(Request $request)
    {
        $student = auth()->user();

        //Get document path
        $docArray = array();
        $documentPaths = array();
        if ($request->file('supportingDocuments') != null) {
            foreach ($request->file('supportingDocuments') as $document) {
                $documentName = $document->getClientOriginalName();
                $document->storeAs('tmp/' . $student->student_id, $documentName);
                $docArray[] = $documentName;
            }
        }

        //Extract date from datetime input and count their interval
        $extractDate1 = date_create(substr(request()->get('startDate'), 0, 10));
        $extractDate2 = date_create(substr(request()->get('endDate'), 0, 10));
        $dateRangeCount = date_diff($extractDate1, $extractDate2)->format('%a');

        $enrolments = $student->enrolments;
        foreach ($enrolments as $enrolment) {
            foreach ($enrolment->section->session as $session) {
                $sessions[] = $session;
            }
        }

        $affectedClasses = [];
        $affectedSessions = [];

        for ($i = 0; $i <= $dateRangeCount; $i++) {
            $day = date_format($extractDate1, 'l');

            if ($i == 0) {
                $extractTime1 = date("H:i", strtotime(request()->get('startDate')));
                //query to filter all session tht involved in those days and ID in array
                foreach ($sessions as $session) {
                    if ($session->day_of_week == $day) {
                        if ($session->start_time >= $extractTime1) {
                            $affectedClasses[] = $session->section->course;
                            $affectedSessions[] = $session->session_id;
                        }
                    }
                }
            } else if ($i == $dateRangeCount) {
                $extractTime2 = date("H:i", strtotime(request()->get('endDate')));
                //query to filter all session tht involved in those days and ID in array
                foreach ($sessions as $session) {
                    $course = $session->section->course;
                    if ($session->day_of_week == $day && !in_array($course, $affectedClasses)) {
                        if ($session->start_time <= $extractTime2) {
                            $affectedClasses[] = $course;
                            $affectedSessions[] = $session->session_id;
                        }
                    }
                }
            } else {
                //query to filter all session tht involved in those days and ID in array
                foreach ($sessions as $session) {
                    $course = $session->section->course;
                    if ($session->day_of_week == $day && !in_array($course, $affectedClasses)) {
                        $affectedClasses[] = $course;
                        $affectedSessions[] = $session->session_id;
                    }
                }
            }
            $extractDate1->modify('+1 day');
        }

        //Store details that will be passed to UI to display
        $details = [
            "leaveType" => request()->get('leaveType'),
            "leavePeriod" => request()->get('startDate') . ' - ' . request()->get('endDate'),
            "reason" => request()->get('reason'),
            "supportingDocuments" =>  $docArray,
            "affectedClasses" => $affectedClasses
        ];

        //Store in web sessions
        $request->session()->put('leaveType', $details['leaveType']);
        $request->session()->put('startDate',  request()->get('startDate'));
        $request->session()->put('endDate',  request()->get('endDate'));
        $request->session()->put('reason', $details['reason']);
        $request->session()->put('docNames', $docArray);
        $request->session()->put('affectedClasses', $details['affectedClasses']);
        $request->session()->put('affectedSessions', $affectedSessions);

        return view('ApplicationConfirmation', ['details' => $details]);
    }


    public function storeDB(Request $request)
    {
        $student = auth()->user();

        //Generate leave id
        $leaveType = $request->session()->get('leaveType');
        if ($leaveType == LeaveType::MEDICAL_LEAVE) {
            $medicalLeaves = DB::table('leave_application')->where('leave_id', 'like', 'ML%')->count();
            $leaveID = 'ML' . $medicalLeaves;
        } else if ($leaveType == LeaveType::OFFICIAL_LEAVE) {
            $officialLeaves = DB::table('leave_application')->where('leave_id', 'like', 'OL%')->count();
            $leaveID = 'OL' . $officialLeaves;
        } else if ($leaveType == LeaveType::BEREAVEMENT_LEAVE) {
            $bereavementLeaves = DB::table('leave_application')->where('leave_id', 'like', 'BL%')->count();
            $leaveID = 'BL' . $bereavementLeaves;
        }

        //Store record in database
        $leaveAppRecord = new LeaveApplication();
        $leaveAppRecord->leave_id = $leaveID;
        $leaveAppRecord->student_id = $student->student_id;
        $leaveAppRecord->leave_type = $request->session()->get('leaveType');
        $leaveAppRecord->start_date =  $request->session()->get('startDate');
        $leaveAppRecord->end_date = $request->session()->get('endDate');
        $leaveAppRecord->reasons = $request->session()->get('reason');
        $leaveAppRecord->save();

        // Store supporting documents in database
        if ($request->session()->get('docNames') != null) {
            $supportingDocumentRecord = new SupportingDocument();
            foreach ($request->session()->get('docNames') as $doc) {
                $supportingDocumentRecord->leave_id = $leaveID;
                $supportingDocumentRecord->filename = $doc;
                $supportingDocumentRecord->save();

                //Move from storage/app/tmp/{student_id} to storage/app/supportingDocuments/{student_id}
                Storage::disk('local')->move('tmp/' . $student->student_id . '/' . $doc, 'supportingDocuments/' . $leaveID . "/" . $doc);
            }
        }

        // Create Lecturer Leave action
        $affectedSessions = $request->session()->get('affectedSessions');
        foreach ($affectedSessions as $affectedSession) {
            $leaveAction = new LeaveAction();
            $leaveAction->leave_id = $leaveAppRecord->leave_id;
            $leaveAction->staff_authority = UserType::LECTURER;
            $leaveAction->remarks = "";
            $leaveAction->session_id = $affectedSession;
            $leaveAction->save();
        }

        // Create HOP Leave action
        $hopLeaveAction = new LeaveAction();
        $hopLeaveAction->leave_id = $leaveAppRecord->leave_id;
        $hopLeaveAction->staff_authority = UserType::HOP;
        $hopLeaveAction->remarks = "";
        $hopLeaveAction->save();

        //Create IO Leave Action
        if (auth()->user()->student_type === StudentType::INTERNATIONAL) {
            $hopLeaveAction = new LeaveAction();
            $hopLeaveAction->leave_id = $leaveAppRecord->leave_id;
            $hopLeaveAction->staff_authority = UserType::IO;
            $hopLeaveAction->remarks = "";
            $hopLeaveAction->save();
        }

        //Clear session after confirm submission
        if ($request->session()->has(['leaveType', 'startDate', 'endDate', 'reason', 'supportingDocuments', 'affectedClasses', 'affectedSessions'])) {
            $request->session()->forget('leaveType', 'startDate', 'endDate', 'reason', 'supportingDocuments', 'affectedClasses', 'affectedSessions');
        }

        return redirect('/history');
    }

    public function downloadDoc(Request $request, $filename)
    {
        $supportingDocuments = $request->session()->get('docNames');
        if (in_array($filename, $supportingDocuments)) {
            return response()->file(storage_path('app/tmp/' . auth()->user()->student_id . '/' . $filename));
        }
        abort(404);
    }
}
