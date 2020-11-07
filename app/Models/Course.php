<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = "course_id";
    public $incrementing = false;
    protected $keyType = "string";

    public function Course()
    {
        return $this->hasMany('App\Models\Course', 'course_id');
    }
}
