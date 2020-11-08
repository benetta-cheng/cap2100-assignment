<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $table = 'programme';
    protected $primaryKey = 'programme_id';
    protected $keyType = 'string';
    public $incrementing = 'false';

    public function headOfProgramme()
    {
        return $this->belongsTo('App\Models\Staff', 'head_of_programme', 'staff_id');
    }
}
