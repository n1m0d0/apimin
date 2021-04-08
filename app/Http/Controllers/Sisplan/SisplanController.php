<?php

namespace App\Http\Controllers\Sisplan;

use Illuminate\Http\Request;
use App\Models\sispro\Demanda;
use App\Http\Controllers\ApiController;

class SisplanController extends ApiController
{

    public function proyectosPriorizados($codigo)
    {
        $proyectos = \DB::connection('sisindesa')->select("SELECT DISTINCT i.codigo_sisin, 
        i.nombre_formal, z.vigente  as priorizado, z.gestion
        FROM inversion AS i 
        INNER JOIN rel_inversion_ear_ee AS riee ON i.cod_inversion = riee.cod_inversion AND riee.relacion_visible = 1 
        INNER JOIN rel_ear_ee AS ree ON riee.cod_ear_ee = ree.cod_ear_ee 
        INNER JOIN entidad AS ear ON ree.cod_ear = ear.cod_entidad
        INNER JOIN entidad AS ee ON ree.cod_ee = ee.cod_entidad 
        INNER JOIN (
    	SELECT DISTINCT (er.cod_inversion), er.vigente, er.gestion
    	    FROM entidad_inversion_relacion er
    		INNER JOIN entidad e ON e.cod_entidad =  er.cod_entidad
    		    INNER JOIN (
    		    SELECT er.cod_inversion, max(er.gestion) as gestion
    		    FROM entidad_inversion_relacion er
    		    INNER JOIN entidad e ON e.cod_entidad =  er.cod_entidad
    		    WHERE  e.codigo_presupuestario = '".$codigo."' 
    	    group by er.cod_inversion
    	    ) as x  ON  x.cod_inversion = er.cod_inversion
    	    WHERE  e.codigo_presupuestario = '".$codigo."' AND er.gestion = x.gestion
    	) AS z ON i.cod_inversion = z.cod_inversion 
    	WHERE i.cod_tipo_proyecto <> 3 
    	AND ear.codigo_presupuestario = '".$codigo."'
    	AND i.cod_estado_inversion not in (5,12,1) ");
        return $this->showArray($proyectos);
    }


}
