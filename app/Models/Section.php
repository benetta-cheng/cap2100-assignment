<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'section';
    protected $primaryKey = 'section_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'course_id');
    }

    public function session()
    {
        return $this->hasMany('App\Models\Session', 'section_id', 'section_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff', 'lecturer_id', 'staff_id');
    }

    public function enrolments()
    {
        return $this->hasMany('App\Models\Enrolment', 'section_id', 'section_id');
    }
}
