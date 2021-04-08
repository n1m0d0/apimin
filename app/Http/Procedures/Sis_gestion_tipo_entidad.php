<?php 
namespace App\Http\Procedures;

use Illuminate\Support\Facades\DB;

class Sis_gestion_tipo_entidad {
    private $gestion;
    private $cod_tipo_entidad;
    private $vigente;
    

    /**
     * Get the value of gestion
     */ 
    public function getGestion()
    {
        return $this->gestion;
    }

    /**
     * Set the value of gestion
     *
     * @return  self
     */ 
    public function setGestion($gestion)
    {
        $this->gestion = $gestion;

        return $this;
    }

    /**
     * Get the value of cod_tipo_entidad
     */ 
    public function getCod_tipo_entidad()
    {
        return $this->cod_tipo_entidad;
    }

    /**
     * Set the value of cod_tipo_entidad
     *
     * @return  self
     */ 
    public function setCod_tipo_entidad($cod_tipo_entidad)
    {
        $this->cod_tipo_entidad = $cod_tipo_entidad;

        return $this;
    }

    /**
     * Get the value of vigente
     */ 
    public function getVigente()
    {
        return $this->vigente;
    }

    /**
     * Set the value of vigente
     *
     * @return  self
     */ 
    public function setVigente($vigente)
    {
        $this->vigente = $vigente;

        return $this;
    }

    public function ejecutar($accion) {
        $sql = "CALL sp_sis_gestion_tipo_entidad(?,?,?,?)";
        return DB::connection('sisin')->select($sql,[$this->gestion, $this->cod_tipo_entidad, $this->vigente, $accion]);
    }
}