<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $table = 'programme';
    protected $primaryKey = 'programme_id';
    protected $keyType = 'string';
    public $incrementing = 'false';

    public function headOfProgramme()
    {
        return $this->belongsTo('App\Models\Staff', 'head_of_programme', 'staff_id');
    }

    public function student()
    {
        return $this->hasMany('\App\Models\Student', 'programme', 'programme_id');
    }
}
