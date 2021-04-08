<?php

namespace App\Http\Controllers\Sisin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Http\Procedures\Sis_gestion_tipo_entidad;
use App\Http\Procedures\Entidad_relacion;

class ProcedureController extends ApiController
{
    protected $gestionTipoEntidad;
    protected $entidadRelacion;
    
    public function __construct(Sis_gestion_tipo_entidad $gestionTipoEntidad, Entidad_relacion $entidadRelacion)
    {
        $this->gestionTipoEntidad = $gestionTipoEntidad;
        $this->entidadRelacion = $entidadRelacion;
    }

    public function gestionTipoEntidad()
    {
	$this->gestionTipoEntidad->setGestion('2020');
	$data  = $this->gestionTipoEntidad->ejecutar('C3');
	
	return $this->showArray($data);
    }
    
    public function gestionEntidad(Request $request)
    {
	$codTipoEntidad = $request->input('codTipoEntidad');
	$this->entidadRelacion->setGestion('2020');
	$this->entidadRelacion->setCod_tipo_entidad($codTipoEntidad);
	return $this->showArray($this->entidadRelacion->ejecutar('C105'));
    }
}