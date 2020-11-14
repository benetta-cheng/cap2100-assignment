<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'student';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function leaveApplication()
    {
        return $this->hasMany('App\Models\LeaveApplication', 'student_id', 'student_id');
    }

    public function enrolments()
    {
        return $this->hasMany('App\Models\Enrolment', 'student_id', 'student_id');
    }

    public function studentProgramme()
    {
        return $this->belongsTo('App\Models\Programme', 'programme', 'programme_id');
    }

    public function updates()
    {
        return $this->hasMany('App\Models\Update', 'student_id', 'student_id');
    }
}
