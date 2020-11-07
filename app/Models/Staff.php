<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $primaryKey = "staff_id";
    public $incrementing = false;
    protected $keyType = "string";

    public function Staff()
    {
        return $this->hasMany('App\Models\Staff', 'staff_id');
    }
}
