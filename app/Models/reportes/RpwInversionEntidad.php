<?php

namespace App\Models\reportes;

use Illuminate\Database\Eloquent\Model;

class RpwInversionEntidad extends Model
{
    protected $connection = 'reportes';
    protected $table = 'rpw_inversion_entidad';

    public $timestamps = false;

    protected $guarded = [];



    public function entidad_ee(){
	return $this->belongsTo(Entidad::class, 'cod_ee', 'cod_entidad');
    }
    
    public function entidad_ear(){
	return $this->belongsTo(Entidad::class, 'cod_ear', 'cod_entidad');
    }
}
