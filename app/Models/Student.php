<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function leaveApplication()
    {
        return $this->hasMany('App\Models\LeaveApplication', 'student_id', 'student_id');
    }

    public function enrolments()
    {
        return $this->hasMany('App\Models\Enrolment', 'student_id', 'student_id');
    }
}
