<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'session';
    protected $primaryKey = 'session_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function section()
    {
        return $this->belongsTo('App\Models\Section', null, 'section_id');
    }

    public function leaveActions()
    {
        return $this->hasMany('App\Models\LeaveAction', null, 'session_id');
    }
}
