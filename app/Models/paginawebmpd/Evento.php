<?php

namespace App\Models\paginawebmpd;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $connection= 'registro';
    protected $table = 'evento';
    public $timestamps = false;
    protected $guarded = ['id'];
    
}
