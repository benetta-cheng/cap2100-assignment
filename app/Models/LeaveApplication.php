<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\LeaveStatus;

class LeaveApplication extends Model
{
    protected $table = 'leave_application';
    protected $primaryKey = 'leave_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $attributes = [
        'status' => LeaveStatus::PENDING
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'student_id');
    }

    public function leaveActions()
    {
        return $this->hasMany('App\Models\LeaveAction', 'leave_id', 'leave_id');
    }

    public function supportingDocuments()
    {
        return $this->hasMany('App\Models\SupportingDocument', 'leave_id', 'leave_id');
    }

    public function completed()
    {
        return $this->status === LeaveStatus::CANCELLED || $this->status === LeaveStatus::APPROVED || $this->status === LeaveStatus::REJECTED;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();

        $update = new Update();
        $update->student_id = $this->student_id;
        $update->leave_id = $this->leave_id;
        $update->action_message = 'Your leave has been ' . strtolower($status) . '. (Leave ID: [leaveID]).';
        $update->save();
    }

    public function updates()
    {
        return $this->hasMany('App\Models\Update', 'leave_id', 'leave_id');
    }
}
