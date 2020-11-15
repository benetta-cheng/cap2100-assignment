<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';
    protected $primaryKey = "course_id";
    public $incrementing = false;
    protected $keyType = "string";

    public function section()
    {
        return $this->hasMany('App\Models\Section', 'course_id', 'course_id');
    }
}
