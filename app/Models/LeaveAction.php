<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAction extends Model
{
    protected $table = 'leave_action';

    protected $attributes = [
        'staff_status' => 'Pending'
    ];

    public function leaveApplication()
    {
        return $this->belongsTo('App\Models\LeaveApplication', 'leave_id', 'leave_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff', 'staff_id', 'staff_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'course_id');
    }
}
