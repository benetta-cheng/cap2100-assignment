<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = "student_id";
    public $incrementing=false;
    protected $keyType="string";

    //Subject to change model name for leave app
    public function leaveApplication()
    {
        return $this->hasMany('App\Models\LeaveApplication','student_id');
    }
}
