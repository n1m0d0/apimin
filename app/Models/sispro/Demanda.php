<?php

namespace App\Models\sispro;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $cod_demanda
 * @property int $cod_accion_inversion
 * @property int $cod_usuario
 * @property int $cod_demanda_estado
 * @property int $cod_tipo_demanda
 * @property int $cod_entidad
 * @property string $objeto
 * @property string $localizacion
 * @property string $nombre_formal
 * @property string $nombre
 * @property string $objetivo_general
 * @property int $gestion_inico
 * @property int $duracion
 * @property int $agregar_nivel
 * @property int $cod_nodo_plan
 * @property int $cod_sector_economico
 * @property int $cod_etapa
 * @property string $fecha_modificacion
 * @property string $fecha_registro
 * @property string $situacion_actual
 * @property int $mes_inicio
 * @property int $habilitar_ajustes
 * @property ClasifDemandaEstado $clasifDemandaEstado
 * @property ClasifTipoDemanda $clasifTipoDemanda
 * @property Entidad $entidad
 * @property ClasifAccionInversion $clasifAccionInversion
 * @property Usuario $usuario
 * @property DemandaClasificador[] $demandaClasificadors
 * @property DemandaEntidad[] $demandaEntidads
 * @property DemandaIndicadorObjetivo[] $demandaIndicadorObjetivos
 * @property DemandaMarca[] $demandaMarcas
 * @property DemandaTerritorio[] $demandaTerritorios
 */
class Demanda extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'demanda';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cod_demanda';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['cod_accion_inversion', 'cod_usuario', 'cod_demanda_estado', 'cod_tipo_demanda', 'cod_entidad', 'objeto', 'localizacion', 'nombre_formal', 'nombre', 'objetivo_general', 'gestion_inico', 'duracion', 'agregar_nivel', 'cod_nodo_plan', 'cod_sector_economico', 'cod_etapa', 'fecha_modificacion', 'fecha_registro', 'situacion_actual', 'mes_inicio', 'habilitar_ajustes'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'sispro';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clasifDemandaEstado()
    {
        return $this->belongsTo('App\ClasifDemandaEstado', 'cod_demanda_estado', 'cod_demanda_estado');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clasifTipoDemanda()
    {
        return $this->belongsTo('App\ClasifTipoDemanda', 'cod_tipo_demanda', 'cod_tipo_demanda');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entidad()
    {
        return $this->belongsTo('App\Entidad', 'cod_entidad', 'cod_entidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clasifAccionInversion()
    {
        return $this->belongsTo('App\ClasifAccionInversion', 'cod_accion_inversion', 'cod_accion_inversion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'cod_usuario', 'cod_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demandaClasificadors()
    {
        return $this->hasMany('App\DemandaClasificador', 'cod_demanda', 'cod_demanda');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demandaEntidads()
    {
        return $this->hasMany('App\DemandaEntidad', 'cod_demanda', 'cod_demanda');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demandaIndicadorObjetivos()
    {
        return $this->hasMany('App\DemandaIndicadorObjetivo', 'cod_demanda', 'cod_demanda');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demandaMarcas()
    {
        return $this->hasMany('App\DemandaMarca', 'cod_demanda', 'cod_demanda');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demandaTerritorios()
    {
        return $this->hasMany('App\DemandaTerritorio', 'cod_demanda', 'cod_demanda');
    }
}
