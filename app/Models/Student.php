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
        return $this->hasMany('App\Models\LeaveApplication', null, 'student_id');
    }

    public function programme()
    {
        return $this->belongsTo('App\Models\Programme', 'programme', 'programme_id');
    }
}
