<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    //@var array
    //Declaring attributes
    protected $primaryKey = 'programme_id';
    protected $keyType = 'string';
    public $incrementing = 'false';

    //Many to one relationship from Staff model to Programme model
    public function staff() {
        return $this->belongsTo('App\Models\staff', 'programme_id');
    }
}
