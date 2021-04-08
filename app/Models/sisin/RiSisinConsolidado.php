<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $gestion
 * @property int $cod_inversion
 * @property int $cod_etapa
 * @property int $cod_ear
 * @property int $cod_sector_economico
 * @property int $cod_nodo_plan
 * @property int $cod_municipio
 * @property int $cod_fuente_financiamiento
 * @property int $cod_organismo_financiador
 * @property int $cod_convenio_financiamiento
 * @property int $cod_mes
 * @property string $codigo_sisin
 * @property string $nombre_formal
 * @property string $fecha_inicio_proyecto
 * @property string $fecha_termino_proyecto
 * @property int $cod_area_influencia
 * @property string $area_influencia
 * @property int $cod_tipo_inversion
 * @property string $tipo_inversion
 * @property int $etapa_presup
 * @property string $etapa_abrev
 * @property string $etapa
 * @property float $costo_etapa
 * @property boolean $cod_tipo_administracion
 * @property string $tipo_administracion
 * @property int $cod_tipo_entidad
 * @property string $tipo_entidad
 * @property string $cod_entidad_ear
 * @property string $sigla_entidad_ear
 * @property string $entidad_ear
 * @property int $cod_sectorial
 * @property string $cod_sector
 * @property string $sector
 * @property string $cod_subsector
 * @property string $subsector
 * @property string $cod_tipo_proyecto
 * @property string $tipo_proyecto
 * @property string $presup_plan
 * @property string $presup_n1_plan
 * @property string $n1_plan
 * @property string $presup_n2_plan
 * @property string $n2_plan
 * @property string $presup_n3_plan
 * @property string $n3_plan
 * @property string $presup_n4_plan
 * @property string $n4_plan
 * @property int $cod_departamento
 * @property string $cod_depto
 * @property string $abrev_depto
 * @property string $departamento
 * @property string $cod_mun
 * @property string $abrev_mun
 * @property string $municipio
 * @property int $cod_tipo_recurso
 * @property string $tipo_recurso
 * @property string $cod_fuente
 * @property string $sigla_fuente
 * @property string $fuente_financiamiento
 * @property string $cod_organismo
 * @property string $sigla_organismo
 * @property string $organismo_financiador
 * @property string $sigla_convenio
 * @property string $convenio_sisfin
 * @property string $convenio_sisfin_web
 * @property string $convenio
 * @property float $monto_presupuesto
 * @property float $monto_reprogramado_total
 * @property float $monto_ejecutado
 */
class RiSisinConsolidado extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ri_sisin_consolidado';

    /**
     * @var array
     */
    protected $fillable = ['codigo_sisin', 'nombre_formal', 'fecha_inicio_proyecto', 'fecha_termino_proyecto', 'cod_area_influencia', 'area_influencia', 'cod_tipo_inversion', 'tipo_inversion', 'etapa_presup', 'etapa_abrev', 'etapa', 'costo_etapa', 'cod_tipo_administracion', 'tipo_administracion', 'cod_tipo_entidad', 'tipo_entidad', 'cod_entidad_ear', 'sigla_entidad_ear', 'entidad_ear', 'cod_sectorial', 'cod_sector', 'sector', 'cod_subsector', 'subsector', 'cod_tipo_proyecto', 'tipo_proyecto', 'presup_plan', 'presup_n1_plan', 'n1_plan', 'presup_n2_plan', 'n2_plan', 'presup_n3_plan', 'n3_plan', 'presup_n4_plan', 'n4_plan', 'cod_departamento', 'cod_depto', 'abrev_depto', 'departamento', 'cod_mun', 'abrev_mun', 'municipio', 'cod_tipo_recurso', 'tipo_recurso', 'cod_fuente', 'sigla_fuente', 'fuente_financiamiento', 'cod_organismo', 'sigla_organismo', 'organismo_financiador', 'sigla_convenio', 'convenio_sisfin', 'convenio_sisfin_web', 'convenio', 'monto_presupuesto', 'monto_reprogramado_total', 'monto_ejecutado'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'sisin';

}
