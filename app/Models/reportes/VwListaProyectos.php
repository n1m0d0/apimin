<?php

namespace App\Models\reportes;

use Illuminate\Database\Eloquent\Model;

class VwListaProyectos extends Model
{
    protected $connection = 'reportes';
    protected $table = 'vw_lista_proyectos';

    public $timestamps = false;

    protected $guarded = [];



}
