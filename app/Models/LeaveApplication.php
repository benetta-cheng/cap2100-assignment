<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    protected $table = 'leave_application';
    protected $primaryKey = 'leave_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $attributes = [
        'status' => 'Pending'
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', null, 'student_id');
    }

    public function leaveActions()
    {
        return $this->hasMany('App\Models\LeaveAction', 'leave_id', 'leave_id');
    }
}
