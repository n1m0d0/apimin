<?php

namespace App\Models\reportes;

use Illuminate\Database\Eloquent\Model;

class DatosResumenGestion extends Model
{
    protected $connection = 'reportes';
    protected $table = 'datos_resumen_gestion';

    public $timestamps = false;

    protected $guarded = [];



}
