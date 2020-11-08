<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $primaryKey = "staff_id";
    public $incrementing = false;
    protected $keyType = "string";

    public function section()
    {
        return $this->hasMany('App\Models\Section', 'lecturer_id', 'staff_id');
    }

    public function programme()
    {
        return $this->hasMany('App\Models\Programme', 'head_of_programme', 'staff_id');
    }
}
