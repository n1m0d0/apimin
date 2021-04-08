<?php 
namespace App\Http\Procedures;

use Illuminate\Support\Facades\DB;

class Reportes_paginaweb {
    
    private $gestion;
    private $cod_entidad;
    private $cod_inversion;
    private $cod_usuario;
    private $cod_tipo;
    private $cod_departamento;
    private $cod_mes;
    private $tipo;

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
     * Get the value of cod_inversion
     */ 
    public function getCod_inversion()
    {
        return $this->cod_inversion;
    }

    /**
     * Set the value of cod_inversion
     *
     * @return  self
     */ 
    public function setCod_inversion($cod_inversion)
    {
        $this->cod_inversion = $cod_inversion;

        return $this;
    }

    /**
     * Get the value of cod_usuario
     */ 
    public function getCod_usuario()
    {
        return $this->cod_usuario;
    }

    /**
     * Set the value of cod_usuario
     *
     * @return  self
     */ 
    public function setCod_usuario($cod_usuario)
    {
        $this->cod_usuario = $cod_usuario;

        return $this;
    }

    /**
     * Get the value of cod_tipo
     */ 
    public function getCod_tipo()
    {
        return $this->cod_tipo;
    }

    /**
     * Set the value of cod_tipo
     *
     * @return  self
     */ 
    public function setCod_tipo($cod_tipo)
    {
        $this->cod_tipo = $cod_tipo;

        return $this;
    }

    /**
     * Get the value of cod_departamento
     */ 
    public function getCod_departamento()
    {
        return $this->cod_departamento;
    }

    /**
     * Set the value of cod_departamento
     *
     * @return  self
     */ 
    public function setCod_departamento($cod_departamento)
    {
        $this->cod_departamento = $cod_departamento;

        return $this;
    }

    /**
     * Get the value of cod_mes
     */ 
    public function getCod_mes()
    {
        return $this->cod_mes;
    }

    /**
     * Set the value of cod_mes
     *
     * @return  self
     */ 
    public function setCod_mes($cod_mes)
    {
        $this->cod_mes = $cod_mes;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    protected function ejecutar($accion) {
        $sql = "CALL SP_reportes_paginaweb(?,?,?,?,?,?,?,?,?)";
        return DB::select($sql,[
                $this->gestion,
                $this->cod_entidad,
                $this->cod_inversion,
                $this->cod_usuario,
                $this->cod_tipo,
                $this->cod_departamento,
                $this->cod_mes,
                $this->tipo,
                $accion
        ]);
    }
}