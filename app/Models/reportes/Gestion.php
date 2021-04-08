<?php

namespace App\Models\reportes;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    protected $connection = 'reportes';
    protected $table = 'gestion';

    public $timestamps = false;

    protected $guarded = [];



}
