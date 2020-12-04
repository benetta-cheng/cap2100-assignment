<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\LeaveStatus;

class LeaveAction extends Model
{
    protected $table = 'leave_action';

    protected $attributes = [
        'staff_status' => LeaveStatus::PENDING
    ];

    public function leaveApplication()
    {
        return $this->belongsTo('App\Models\LeaveApplication', 'leave_id', 'leave_id');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'session_id', 'session_id');
    }

    public function completed()
    {
        return $this->staff_status === LeaveStatus::APPROVED || $this->staff_status === LeaveStatus::REJECTED;
    }

    public function setStatus($status, $remark = null)
    {
        $this->staff_status = $status;

        if ($remark === null) {
            $this->remarks = "";
        } else {
            $this->remarks = $remark;
        }
        $this->save();

        $update = new Update();
        $update->student_id = $this->leaveApplication->student_id;
        $update->staff_id = auth()->user()->staff_id;
        $update->leave_id = $this->leave_id;

        if ($status === LeaveStatus::MEET_STUDENT) {
            $update->action_message = '[staff] has requested to meet you. (Leave ID: [leaveID])';
        } else {
            $update->action_message = '[staff] has recommended the ' . strtolower($status) . " of your leave. (Leave ID: [leaveID]).";
        }
        $update->save();
    }
}
