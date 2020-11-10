<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportingDocument extends Model
{
    protected $table = 'supporting_document';

    public function leaveApplication()
    {
        return $this->belongsTo('App\Models\LeaveApplication', 'leave_id', 'leave_id');
    }
}
