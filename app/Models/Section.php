<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    protected $primaryKey = 'section_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function course()
    {
        return $this->belongsTo('App\Models\Course', null, 'course_id');
    }

    public function session()
    {
        return $this->hasMany('App\Models\Session', null, 'section_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff', null, 'staff_id');
    }
}
