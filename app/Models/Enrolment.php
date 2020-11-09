<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    protected $table = 'enrolment';

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'student_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id', 'section_id');
    }
}
