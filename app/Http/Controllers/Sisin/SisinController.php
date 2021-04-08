<?php

namespace App\Http\Controllers\Sisin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class SisinController extends ApiController
{

    public function proyecto($codigo)
    {
        $proyecto = DB::connection('sisin')->select('select distinct(a.cod_inversion),CASE WHEN SUBSTRING(a.codigo_sisin,1,1) ="_" THEN CONCAT(" ",SUBSTRING(a.codigo_sisin,2,13)) ELSE a.codigo_sisin END AS codigo_sisin,
        a.nombre_formal,a.fecha_inicio_estimada,a.fecha_fin_estimada,d.sigla sigla_ear,d.entidad entidad_ear,e.sigla sigla_ee,e.entidad entidad_ee
        from inversion a
        inner join rel_inversion_ear_ee b on a.cod_inversion = b.cod_inversion
        inner join rel_ear_ee c on b.cod_ear_ee = c.cod_ear_ee
        inner join entidad d on c.cod_ear = d.cod_entidad
        inner join entidad e on c.cod_ee = e.cod_entidad
        WHERE a.codigo_sisin = :sisin', ['sisin' => $codigo]);
        return $this->showArray($proyecto[0]);
    }

    public function listaProyectos(Request $request)
    {
        $rules = ['sisin'=>'required'];
        $this->validate($request,$rules);
        $proyectos = DB::connection('sisin')->select('select distinct(a.cod_inversion),CASE WHEN SUBSTRING(a.codigo_sisin,1,1) ="_" THEN CONCAT(" ",SUBSTRING(a.codigo_sisin,2,13)) ELSE a.codigo_sisin END AS codigo_sisin,
            a.nombre_formal,a.fecha_inicio_estimada,a.fecha_fin_estimada,d.sigla sigla_ear,d.entidad entidad_ear,e.sigla sigla_ee,e.entidad entidad_ee
            from inversion a
            inner join rel_inversion_ear_ee b on a.cod_inversion = b.cod_inversion
            inner join rel_ear_ee c on b.cod_ear_ee = c.cod_ear_ee
            inner join entidad d on c.cod_ear = d.cod_entidad
            inner join entidad e on c.cod_ee = e.cod_entidad
            WHERE a.codigo_sisin IN ('.$request->input('sisin').')');
        return $this->showArray($proyectos);
    }

    public function presupuesto($codigo)
    {
        $presupuesto = DB::connection('sisin')->select('SELECT sum(monto_presupuesto) as monto_presupuesto, sum(monto_reprogramado_total) as monto_reprogramado,
            sum(monto_ejecutado) as monto_ejecutado, gestion
            FROM ri_sisin_consolidado r
            WHERE cod_inversion = :inversion
            GROUP BY gestion', ['inversion' => $codigo]);
        return $this->showArray($presupuesto);
    }

    public function cierre($gestion)
    {
        $gestion = DB::connection('sisin')->select('SELECT gestion,observaciones FROM rg_gestion WHERE gestion=:gestion', ['gestion' => $gestion]);
        return $this->showArray($gestion[0]);
    }
	
	public function ejecucionMesSisin($gestion,$mes)
    {
        $presupuesto = DB::connection('sisin')->select("SELECT  
		ROUND((SUM(sf.monto_ejecutado)/6.86)/1000000) AS total,
		TRUNCATE(((SUM(sf.monto_ejecutado)/6.86)/1000000)/(SELECT SUM((monto_programado)/6.86)/1000000 FROM seguimiento_financiero WHERE gestion = $gestion)*100,2) as n,
		TRUNCATE((SELECT SUM((monto_ejecutado)/6.86)/1000000 FROM seguimiento_financiero WHERE gestion = $gestion and cod_mes<=$mes)/(SELECT SUM((monto_programado)/6.86)/1000000 FROM seguimiento_financiero WHERE gestion = $gestion)*100,2) as a,
		'% Ejec. Línea/Total Prog.: ' as t,
		'Ejecución mes en línea ' as titulo
		FROM seguimiento_financiero AS sf
		WHERE sf.gestion = $gestion
		AND sf.cod_mes = $mes");
        return $this->showArray($presupuesto[0]);
    }
	public function montoOriginal($codInversion)
	{
		$query = DB::connection('sisin')->select("SELECT
		sum(monto_aporte_local) + sum(monto_cofinanciamiento)+ sum(monto_finan_externo) + sum(monto_otros) + sum(monto_sin_financiamiento) as monto_origen
		FROM
		inversion_dictamen_costos  
		where  cod_dictamen = 
		(SELECT min(id.cod_dictamen) 
		FROM inversion_dictamen id
		inner join inversion_dictamen_costos idc on id.cod_dictamen = idc.cod_dictamen
		where
		id.cod_inversion = $codInversion and id.cod_tipo_dictamen = 1 and id.cierre_entidad=1)");
        return $this->showArray($query[0]);
	}
	
	public function fechaOriginal($codInversion,$cambioFecha,$cambioFechaCosto)
	{
		$query = DB::connection('sisin')->select("SELECT
		 cod_inversion,
		  proyecto_fecha_inicio as fecha_inicio,
		  proyecto_fecha_fin as fecha_termino
		FROM
		inversion_dictamen
		where  cod_dictamen = (SELECT min(cod_dictamen) FROM inversion_dictamen where  cod_inversion = $codInversion and (cod_tipo_dictamen = $cambioFecha or cod_tipo_dictamen = $cambioFechaCosto) and cierre_entidad=1)");
        return $this->showArray($query[0]);
	}
	
	public function montoAjustado($codInversion,$cambioCosto,$cambioFechaCosto)
	{
		$query = DB::connection('sisin')->select("SELECT
		sum(monto_aporte_local) + sum(monto_cofinanciamiento)+ sum(monto_finan_externo) + sum(monto_otros) + sum(monto_sin_financiamiento) as monto_ajustado
		FROM
		inversion_dictamen_costos  
		where  cod_dictamen = 
		(SELECT max(id.cod_dictamen) 
		FROM inversion_dictamen id
		inner join inversion_dictamen_costos idc on id.cod_dictamen = idc.cod_dictamen
		where
		id.cod_inversion = $codInversion and (id.cod_tipo_dictamen = $cambioCosto or id.cod_tipo_dictamen = $cambioFechaCosto) and id.cierre_entidad = 1)");
        return $this->showArray($query[0]);
	}
	
	public function nroModificacion($codInversion,$cambio,$cambioFechaCosto)
	{
		$query = DB::connection('sisin')->select("SELECT 
		count(cod_dictamen) as nro_modificaciones
		FROM
		inversion_dictamen
		where  cod_inversion = $codInversion and (cod_tipo_dictamen = $cambio or cod_tipo_dictamen = $cambioFechaCosto) and cierre_entidad=1");
        return $this->showArray($query[0]);
	}
	
	public function ejecucionMesSectorSisin($gestion,$mes,$sector)
	{
		$query = DB::connection('sisin')->select("select  
		ROUND((SUM(sf.monto_ejecutado)/6.86)/1000000) AS total,

		 TRUNCATE(((SUM(sf.monto_ejecutado)/6.86)/1000000)/
		 (SELECT SUM((sfp.monto_programado)/6.86)/1000000 
		from seguimiento_financiero sfp
		LEFT JOIN rel_inversion_clasificadores ric on sfp.cod_inversion=ric.cod_inversion
		LEFT JOIN vw_sector_economico vse on ric.cod_sector_economico = vse.cod_tipo_proyecto
		WHERE sfp.gestion = $gestion AND  vse.cod_sector= $sector)*100,2) as n,

		 TRUNCATE(( SELECT SUM((sfp.monto_ejecutado)/6.86)/1000000 
		from seguimiento_financiero sfp
		LEFT JOIN rel_inversion_clasificadores ric on sfp.cod_inversion=ric.cod_inversion
		LEFT JOIN vw_sector_economico vse on ric.cod_sector_economico = vse.cod_tipo_proyecto
		WHERE sfp.gestion = $gestion AND sfp.cod_mes <= $mes AND  vse.cod_sector= $sector)/
		 (SELECT SUM((sfp.monto_programado)/6.86)/1000000 
		from seguimiento_financiero sfp
		LEFT JOIN rel_inversion_clasificadores ric on sfp.cod_inversion=ric.cod_inversion
		LEFT JOIN vw_sector_economico vse on ric.cod_sector_economico = vse.cod_tipo_proyecto
		WHERE sfp.gestion = $gestion AND  vse.cod_sector= $sector)*100,2) as a,
		'% Ejec. Línea Sec./Total Sec. Prog.: ' as t,

		'Ejecución mes en línea por Sector ' as titulo

		FROM
		seguimiento_financiero sf
		LEFT JOIN rel_inversion_clasificadores ric on sf.cod_inversion=ric.cod_inversion
		LEFT JOIN vw_sector_economico vs on ric.cod_sector_economico = vs.cod_tipo_proyecto
		  
		WHERE sf.gestion = $gestion AND sf.cod_mes = $mes AND vs.cod_sector= $sector");
		
        return $this->showArray($query[0]);
	}
	
	
}
