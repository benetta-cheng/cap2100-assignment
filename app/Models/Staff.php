<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use HasFactory;

    protected $table = 'staff';
    protected $primaryKey = "staff_id";
    public $incrementing = false;
    protected $keyType = "string";

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function section()
    {
        return $this->hasMany('App\Models\Section', 'lecturer_id', 'staff_id');
    }

    public function programme()
    {
        return $this->hasMany('App\Models\Programme', 'head_of_programme', 'staff_id');
    }

    public function updates()
    {
        return $this->hasMany('App\Models\Update', 'staff_id', 'staff_id');
    }
}
