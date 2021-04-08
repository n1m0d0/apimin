<?php

namespace App\Models\reportes;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $connection = 'reportes';
    protected $table = 'entidad';
    protected $primaryKey = 'cod_entidad';

    public $timestamps = false;

    protected $guarded = [];



}
