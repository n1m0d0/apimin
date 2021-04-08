<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\reportes\DatosResumenGestion;
use App\Models\reportes\Gestion;
use App\Models\reportes\RpwInversionEntidad;
use App\Models\reportes\VwListaProyectos;

class ReportesController extends ApiController {

	public function gestion(Request $request) {
		$media = DB::connection('reportes')->select("SELECT * FROM gestion");
		// echo "hola";
		// print_r($media);
		// $media = DB::connection('paginaweb')->select("select * from contenido_media ");
		// $media = DB::connection('sisin')->select("select * from clasif_etapa");
		//$gestion = array('hola' => "hola" );
		return response()->json($media);
	}

	public function grafico($id) {
		// $jsonGrafico["cod_grafico"] = $id;

		$datosGrafico = DB::connection('reportes')->select("SELECT * FROM grafico WHERE cod_grafico = " . $id);

		$jsonGrafico["datos_grafico"]["title"]["text"] = $datosGrafico["0"]->texto_title;
		$jsonGrafico["datos_grafico"]["subtitle"]['text'] = $datosGrafico["0"]->texto_subtitle;

		$datosGraficoPropiedades = DB::connection('reportes')->select("SELECT * FROM vw_grafico_propiedades WHERE cod_tipo_grafico = " . $datosGrafico["0"]->cod_tipo_grafico);

		foreach ($datosGraficoPropiedades as $key => $value) {
			$propiedad = $value->propiedad;
			$opciones = $value->opciones;
			$tipo_opcion = $value->tipo_opcion;
			$valor = $value->valor;

			if ($value->valor == 'true') {
				$valor = true;
			}

			if ($value->valor == 'false') {
				$valor = false;
			}

			if ($value->tipo_dato == 'I') {
				$valor = (double) $valor;
			}

			if ($tipo_opcion == null) {
				$jsonGrafico["datos_grafico"][$propiedad][$opciones] = $valor;
			} else {
				$listaAuxiliar = explode(",", $tipo_opcion);
				switch (count($listaAuxiliar)) {
				case 1:
					$d1 = $listaAuxiliar[0];
					$jsonGrafico["datos_grafico"][$propiedad][$opciones][$d1] = $valor;
					break;
				case 2:
					$d1 = $listaAuxiliar[0];
					$d2 = $listaAuxiliar[1];
					$jsonGrafico["datos_grafico"][$propiedad][$opciones][$d1][$d2] = $valor;
					break;
				case 3:
					$d1 = $listaAuxiliar[0];
					$d2 = $listaAuxiliar[1];
					$d3 = $listaAuxiliar[2];
					$jsonGrafico["datos_grafico"][$propiedad][$opciones][$d1][$d2][$d3] = $valor;
					break;

				default:
					$d1 = $listaAuxiliar[0];
					$jsonGrafico["datos_grafico"][$propiedad][$opciones][$d1] = $valor;
					break;
				}
			}

		}

		$datosGraficoCategorias = DB::connection('reportes')->select("SELECT DISTINCT nombre_valor,orden_valor FROM `grafico_serie` WHERE cod_grafico =  " . $id . " ORDER BY orden_valor");

		$auxCategorias = array();

		foreach ($datosGraficoCategorias as $keyCat => $valueCat) {
			$auxCategorias[] = $valueCat->nombre_valor;
		}

		$jsonGrafico["datos_grafico"]["xAxis"]["categories"] = $auxCategorias;

		$datosGraficoSerieGrupo = DB::connection('reportes')->select("SELECT cod_grafico,cod_serie,serie FROM vw_grafico_serie WHERE cod_grafico = " . $id . " GROUP BY cod_grafico,cod_serie,serie ORDER BY orden");
		$i = 0;
		foreach ($datosGraficoSerieGrupo as $key => $value) {

			$datosGraficoSeriePropiedades = DB::connection('reportes')->select("SELECT * FROM vw_serie_propiedades WHERE cod_serie = " . $value->cod_serie);

			$jsonGrafico["datos_grafico"]['series'][$i]['name'] = $value->serie;

			foreach ($datosGraficoSeriePropiedades as $keyProp => $valueProp) {
				$propiedad = $valueProp->propiedad;
				$opciones = $valueProp->opciones;
				$tipo_opcion = $valueProp->tipo_opcion;
				$valor = $valueProp->valor;

				if ($valueProp->valor == 'true') {
					$valor = true;
				}

				if ($valueProp->valor == 'false') {
					$valor = false;
				}

				if ($valueProp->tipo_dato == 'I') {
					$valor = (double) $valor;
				}

				if ($opciones == null) {
					$jsonGrafico["datos_grafico"]['series'][$i][$propiedad] = $valor;
				} else {
					if ($tipo_opcion == null) {
						$jsonGrafico["datos_grafico"]['series'][$i][$propiedad][$opciones] = $valor;
					}
				}

			}

			$datosGraficoSerie = DB::connection('reportes')->select("SELECT * FROM vw_grafico_serie WHERE cod_serie = " . $value->cod_serie . " AND  cod_grafico = " . $id . " ORDER BY orden_valor");
			$j = 0;
			foreach ($datosGraficoSerie as $keySerie => $valSerie) {
				$name = $valSerie->nombre_valor;
				$y = ($valSerie->valor=='-')?'':(double) $valSerie->valor;
				$color = $valSerie->color;
				$url = $valSerie->url_enlace;
				$valor_porcentual = $valSerie->valor_porcentual;

				$jsonGrafico["datos_grafico"]['series'][$i]['data'][$j]['name'] = $name;
				$jsonGrafico["datos_grafico"]['series'][$i]['data'][$j]['y'] = $y;
				$jsonGrafico["datos_grafico"]['series'][$i]['data'][$j]['url'] = $url;
				if ($color) {
					$jsonGrafico["datos_grafico"]['series'][$i]['data'][$j]['color'] = $color;
				}

				if ($valor_porcentual) {
					$jsonGrafico["datos_grafico"]['series'][$i]['data'][$j]['porcentaje'] = $valor_porcentual;
				}

				if ($valSerie->cod_serie == 12) {
					$jsonGrafico["datos_grafico"]['series'][$i]['data'][$j]['value'] = $valSerie->orden_valor;
					$jsonGrafico["datos_grafico"]['series'][$i]['data'][$j]["hc-key"] = $valSerie->nombre_valor;
				}

				$j++;
			}

			$i++;
		}

		return response()->json($jsonGrafico['datos_grafico']);
	}

	public function detalleInstitucional() {
		$detalle = DB::connection('reportes')->select("SELECT * FROM detalle_institucional where gestion = 2021");
		return response()->json($detalle);
	}
	
	public function detalleOperacionesContratadas(Request $request) {
		$gestion = $request->input('gestion');
		$detalle = DB::connection('reportes')->select("SELECT
		financiador, tipo, nombre_convenio,
		ROUND(IFNULL(monto/1000000,0),0) as 'Expresado en millones de dólares',
		gestion,
		observacion
		FROM detalle_operaciones_contratadas WHERE gestion = '".$gestion."'");
		return response()->json($detalle);
	}
	
	public function detalleOperacionesContratadasAgencia(Request $request) {
		$agencia = $request->input('agencia');
		$detalle = DB::connection('reportes')->select("
		SELECT financiador, tipo, nombre_convenio,
		ROUND(IFNULL(monto/1000000,0),0) as 'Expresado en millones de dólares',
		gestion,
		observacion
		FROM detalle_operaciones_contratadas 
		WHERE codigo_financiador = '".$agencia."'
		ORDER BY gestion
		");
		return response()->json($detalle);
	}
	
	public function detalleDesembolso(Request $request) {
		$gestion = $request->input('gestion');
		$agencia = $request->input('agencia');
		if($gestion){
		    $detalle = DB::connection('reportes')->select("SELECT id, agencia, ROUND(IFNULL(monto,0),0) as 'Expresado en millones de dólares', gestion FROM detalle_desembolso_credito WHERE monto <> '0' AND gestion = '".$gestion."' order by agencia");
		    return response()->json($detalle);
		}
		if($agencia){
		    $detalle = DB::connection('reportes')->select("SELECT id, agencia, ROUND(IFNULL(monto,0),0) as 'Expresado en millones de dólares', gestion FROM detalle_desembolso_credito WHERE monto <> '0' AND agencia = '".$agencia."' order by gestion");
		    return response()->json($detalle);
		}
	}
	
	public function detalleTablaContratacion(Request $request) {
		
		$detalle = DB::connection('reportes')->select('
		select doc.financiador , ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2005" THEN doc.monto END)/1000000,0),0) "2005",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2006" THEN doc.monto END)/1000000,0),0) "2006",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2007" THEN doc.monto END)/1000000,0),0) "2007",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2008" THEN doc.monto END)/1000000,0),0) "2008",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2009" THEN doc.monto END)/1000000,0),0) "2009",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2010" THEN doc.monto END)/1000000,0),0) "2010",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2011" THEN doc.monto END)/1000000,0),0) "2011",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2012" THEN doc.monto END)/1000000,0),0) "2012",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2013" THEN doc.monto END)/1000000,0),0) "2013",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2014" THEN doc.monto END)/1000000,0),0) "2014",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2015" THEN doc.monto END)/1000000,0),0) "2015",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2016" THEN doc.monto END)/1000000,0),0) "2016",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2017" THEN doc.monto END)/1000000,0),0) "2017",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2018" THEN doc.monto END)/1000000,0),0) "2018",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2019" THEN doc.monto END)/1000000,0),0) "2019",
		ROUND(IFNULL(SUM(CASE WHEN doc.gestion = "2020" THEN doc.monto END)/1000000,0),0) "2020"
		from detalle_operaciones_contratadas doc
		group by doc.financiador
		order by doc.financiador
		');
		return response()->json($detalle);
	}
	
	public function gestiones()
	{
	    $listaGestion = Gestion::whereBetween('gestion',[2019,2021])->get();
	    return response()->json($listaGestion);
	}
	
	public function proyectos(Request $request)
	{
	    $texto = $request->input('texto');
	    $codTipoEntidad = $request->input('codTipoEntidad');
	    $codEntidad = $request->input('codEntidad');
	    $gestion = $request->input('gestion');
	    $sort = $request->input('sort');
	    $filter = $request->input('filter');
	    
	    $listaProyectos = DatosResumenGestion::query();
	    if(!empty($codTipoEntidad)){
		$listaProyectos->where('codigo_tipo_entidad', $codTipoEntidad);
	    }
	    if(!empty($codEntidad)){
		$listaProyectos->where('cod_entidad', $codEntidad);
	    }
	    if(!empty($texto)){
		$searchValues = preg_split('/\s+/', $texto, -1, PREG_SPLIT_NO_EMPTY);
		$listaProyectos->where(function ($query) use ($searchValues, $texto) {
		    $query->where(function($query) use ($searchValues){
			foreach ($searchValues as $value) {
		    	    $query->where('nombre_formal','LIKE','%'. $value. '%');
			}
		    })
		    ->orWhere('codigo_sisin','LIKE','%'. $texto. '%');
		});
	    }
	    $listaProyectos->where('gestion', $gestion);
	    
	    if(!empty($filter)){
		$filtro = json_decode($filter);
		
		$campo = $filtro[0];
		$valor = $filtro[2];
		$searchValues = preg_split('/\s+/', $valor, -1, PREG_SPLIT_NO_EMPTY);
		$listaProyectos->where(function($query) use ($searchValues, $campo){
			foreach ($searchValues as $value) {
		    	    $query->where($campo,'LIKE','%'. $value. '%');
			}
		    });
	    }
	    if(!empty($sort)){
		$propiedades = json_decode($sort);
		$orden = ($propiedades[0]->desc == 'true')?'desc':'asc';
		$listaProyectos->orderBy($propiedades[0]->selector, $orden);
	    } else {
		$listaProyectos->orderBy('prioridad_proyecto', 'desc');
	    }
	    
	    $listaProyectos->select(DB::raw('datos_resumen_gestion.*, (datos_resumen_gestion.ejecutado/datos_resumen_gestion.reprogramado) * 100 as porc_div'));
	    //dd($listaProyectos->toSql());
	    $datos = $listaProyectos->paginate(15)->toArray();
	    
	    $json = [];
	    foreach ($datos['data'] as $indice => $valor) {
	        if($valor['reprogramado'] > 0)
	            $porc_ejec_ppto = number_format(($valor['ejecutado']/$valor['reprogramado'])* 100, 2, '.', '');           
	        else 
	            $porc_ejec_ppto = 0;   
                $json[$indice]['codigo_sisin'] = $valor['codigo_sisin'];
                $json[$indice]['sigla_entidad'] = $valor['sigla_entidad'];
                $json[$indice]['nombre_formal'] = $valor['nombre_formal'];
                //$json[$indice]['grupo'] = $valor['grupo_recursos'];
                $json[$indice]['presupuesto'] = $valor['presupuesto'];
	        $json[$indice]['reprogramado'] = $valor['reprogramado'];
	        $json[$indice]['ejecutado'] = $valor['ejecutado'];
	        $json[$indice]['priorizado'] = $valor['prioridad_proyecto'];
	        $json[$indice]['porc_div']= $porc_ejec_ppto;
	        $json[$indice]['tipo_dato']= 'HTML';
	        if($valor['entidad']){
	                $json[$indice]['entidad'] = $valor['entidad'];
	        }
                $json[$indice]['url_proyecto'] = 'https://sisin.vipfe.gob.bo/bsn/ktr1/sbs_bd_reportes/mod_reportesFinancieros/estadoSituacionLista.php?codigo_sisin='.$valor['codigo_sisin'].'&gestion='.$valor['gestion'].'&cod_entidad='.$valor['cod_entidad'];
	    }
	    
	    $datos['data']= $json;
	    return response()->json($datos);
	}
	
	public function proyectosGeneral(Request $request)
	{
	    $texto = $request->input('texto');
	    $sort = $request->input('sort');
	    $filter = $request->input('filter');
	    $codDepartamento = $request->input('cod_departamento');
	    
	    $listaProyectos = VwListaProyectos::query();
	    
	    if(!empty($codDepartamento) && $codDepartamento != 'null'){
		$listaProyectos->where('cod_departamento',$codDepartamento);
	    }
	    
	    if(!empty($texto)){
		$searchValues = preg_split('/\s+/', $texto, -1, PREG_SPLIT_NO_EMPTY);
		$listaProyectos->where(function ($query) use ($searchValues, $texto) {
		    $query->where(function($query) use ($searchValues){
			foreach ($searchValues as $value) {
		    	    $query->where('nombre_formal','LIKE','%'. $value. '%');
			}
		    })
		    ->orWhere('codigo_sisin_formato','LIKE','%'. $texto. '%');
		});
	    }
	    
	    if(!empty($filter)){
		$filtro = json_decode($filter);
		if($filtro[1] == 'and'){
		    $resultado = array_filter($filtro,function($var){
		    return $var != 'and';
		    });
		    foreach($resultado as $res){
			$campo = $res[0];
    		        $valor = $res[2];
		        $searchValues = preg_split('/\s+/', $valor, -1, PREG_SPLIT_NO_EMPTY);
		        $listaProyectos->where(function($query) use ($searchValues, $campo){
				foreach ($searchValues as $value) {
		    	        $query->where($campo,'LIKE','%'. $value. '%');
			    }
			});
		    }
		
		} else {
		    $campo = $filtro[0];
		    $valor = $filtro[2];
		    $searchValues = preg_split('/\s+/', $valor, -1, PREG_SPLIT_NO_EMPTY);
		    $listaProyectos->where(function($query) use ($searchValues, $campo){
			foreach ($searchValues as $value) {
		    	    $query->where($campo,'LIKE','%'. $value. '%');
			}
		    });
		}
		
		
	    }
	    if(!empty($sort)){
		$propiedades = json_decode($sort);
		$orden = ($propiedades[0]->desc == 'true')?'desc':'asc';
		$listaProyectos->orderBy($propiedades[0]->selector, $orden);
	    } else {
		$listaProyectos->orderBy('marca_prioridad', 'desc');
	    }
	    
	    //$listaProyectos->select(DB::raw('rpw_inversion_entidad.*, entidad.sigla as sigla, sector_economico.sector_economico as sector_economico, clasif_estado_inversion.estado_inversion as estado_inversion'));
	    //$listaProyectos->join('entidad', 'rpw_inversion_entidad.cod_ee', '=', 'entidad.cod_entidad');
	    //$listaProyectos->join('sector_economico', 'rpw_inversion_entidad.cod_sector', '=', 'sector_economico.cod_sector_economico');
	    //$listaProyectos->join('clasif_estado_inversion', 'rpw_inversion_entidad.cod_estado_inversion', '=', 'clasif_estado_inversion.cod_estado_inversion');
	    $datos = $listaProyectos->paginate(15)->toArray();
	    $json = [];
	    foreach ($datos['data'] as $indice => $valor) {
                $json[$indice]['marca_prioridad'] = $valor['marca_prioridad'];
                $json[$indice]['codigo_sisin_formato'] = $valor['codigo_sisin_formato'];
                //$json[$indice]['codigo_sisin'] = $valor['codigo_sisin'];
                $json[$indice]['nombre_formal'] = $valor['nombre_formal'];
                $json[$indice]['fecha_inicio_estimada'] = $valor['fecha_inicio_estimada'];
	        $json[$indice]['fecha_fin_estimada'] = $valor['fecha_fin_estimada'];
	        $json[$indice]['abrev_entidad'] = $valor['abrev_entidad'];
	        $json[$indice]['sector_economico'] = $valor['sector_economico'];
	        $json[$indice]['departamento'] = $valor['departamento'];
	        $json[$indice]['municipio'] = $valor['municipio'];
                $json[$indice]['url_enlace'] = $valor['url_enlace'];
	    }
	    
	    $datos['data']= $json;
	    
	    return response()->json($datos);
	}
	
	

}
