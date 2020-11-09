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

    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'session_id', 'session_id');
    }
}
