<?php 
namespace App\Http\Procedures;

use Illuminate\Support\Facades\DB;

class Entidad_relacion {
    private $gestion;
    private $cod_entidad;
    private $cod_entidad_relacionada;
    private $cod_tipo_entidad;
    private $cod_tipo_administracion;
    private $cod_grupo_entidad;
    private $cod_grupo_prioridad;
    private $cod_entidad_tuicion;
    private $prioridad;
    private $orden_prioridad;
    private $cierre_menor_inversion;


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
     * Get the value of cod_entidad
     */ 
    public function getCod_entidad()
    {
        return $this->cod_entidad;
    }

    /**
     * Set the value of cod_entidad
     *
     * @return  self
     */ 
    public function setCod_entidad($cod_entidad)
    {
        $this->cod_entidad = $cod_entidad;

        return $this;
    }

    /**
     * Get the value of cod_entidad_relacionada
     */ 
    public function getCod_entidad_relacionada()
    {
        return $this->cod_entidad_relacionada;
    }

    /**
     * Set the value of cod_entidad_relacionada
     *
     * @return  self
     */ 
    public function setCod_entidad_relacionada($cod_entidad_relacionada)
    {
        $this->cod_entidad_relacionada = $cod_entidad_relacionada;

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
     * Get the value of cod_tipo_administracion
     */ 
    public function getCod_tipo_administracion()
    {
        return $this->cod_tipo_administracion;
    }

    /**
     * Set the value of cod_tipo_administracion
     *
     * @return  self
     */ 
    public function setCod_tipo_administracion($cod_tipo_administracion)
    {
        $this->cod_tipo_administracion = $cod_tipo_administracion;

        return $this;
    }

    /**
     * Get the value of cod_grupo_entidad
     */ 
    public function getCod_grupo_entidad()
    {
        return $this->cod_grupo_entidad;
    }

    /**
     * Set the value of cod_grupo_entidad
     *
     * @return  self
     */ 
    public function setCod_grupo_entidad($cod_grupo_entidad)
    {
        $this->cod_grupo_entidad = $cod_grupo_entidad;

        return $this;
    }

    /**
     * Get the value of cod_grupo_prioridad
     */ 
    public function getCod_grupo_prioridad()
    {
        return $this->cod_grupo_prioridad;
    }

    /**
     * Set the value of cod_grupo_prioridad
     *
     * @return  self
     */ 
    public function setCod_grupo_prioridad($cod_grupo_prioridad)
    {
        $this->cod_grupo_prioridad = $cod_grupo_prioridad;

        return $this;
    }

    /**
     * Get the value of cod_entidad_tuicion
     */ 
    public function getCod_entidad_tuicion()
    {
        return $this->cod_entidad_tuicion;
    }

    /**
     * Set the value of cod_entidad_tuicion
     *
     * @return  self
     */ 
    public function setCod_entidad_tuicion($cod_entidad_tuicion)
    {
        $this->cod_entidad_tuicion = $cod_entidad_tuicion;

        return $this;
    }

    /**
     * Get the value of prioridad
     */ 
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set the value of prioridad
     *
     * @return  self
     */ 
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get the value of orden_prioridad
     */ 
    public function getOrden_prioridad()
    {
        return $this->orden_prioridad;
    }

    /**
     * Set the value of orden_prioridad
     *
     * @return  self
     */ 
    public function setOrden_prioridad($orden_prioridad)
    {
        $this->orden_prioridad = $orden_prioridad;

        return $this;
    }

    /**
     * Get the value of cierre_menor_inversion
     */ 
    public function getCierre_menor_inversion()
    {
        return $this->cierre_menor_inversion;
    }

    /**
     * Set the value of cierre_menor_inversion
     *
     * @return  self
     */ 
    public function setCierre_menor_inversion($cierre_menor_inversion)
    {
        $this->cierre_menor_inversion = $cierre_menor_inversion;

        return $this;
    }

    public function ejecutar($accion) {
        $sql ="CALL sp_entidad_relacion(?,?,?,?,?,?,?,?,?,?,?,?)";
        return DB::connection('sisin')->select($sql,[$this->gestion,$this->cod_entidad,$this->cod_entidad_relacionada,$this->cod_tipo_entidad,$this->cod_tipo_administracion,$this->cod_grupo_entidad,$this->prioridad,$this->orden_prioridad,$this->cod_grupo_prioridad,$this->cod_entidad_tuicion,$this->cierre_menor_inversion,$accion]);
    }
}