<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    protected $table = 'update';

    public function leaveApplication()
    {
        return $this->belongsTo('App\Models\LeaveApplication', 'leave_id', 'leave_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff', 'staff_id', 'staff_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'student_id');
    }
}
