<?php

namespace App\Http\Controllers\Paginaweb;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class PaginawebController extends ApiController
{
    public function menu(Request $request)
    {
 
        $menus = DB::connection('paginaweb')->select("select id_menu as id, nombre_enlace as titulo, '0' as parent, '0' as id_contenido, enlace as enlace 
        	from menu 
			where id_menu_padre = id_menu 
			AND id_estado = 'P'
			AND id_idioma = 1 
			AND id_menu_tipo = 1
			AND id_portal = 'PR'
			order by orden");
        foreach ($menus as $key => $value) {
        	if($value->enlace=='#')
        	{
        		$menus[$key]->id_contenido = "";
		       	$menus[$key]->ver = "";	
        	}
        	else
        	{
        		$url = $value->enlace;
		       	$partes = parse_url($url);
		       	parse_str($partes['query'], $vars);
		       	$menus[$key]->id_contenido = $vars['id'];
		       	$menus[$key]->ver = $vars['ver'];	
        	}
        	
    		$submenus = DB::connection('paginaweb')->select("select id_menu as id, nombre_enlace as titulo, id_menu_padre as parent, '0' as id_contenido, enlace as enlace 
        	from menu 
			where id_menu_padre = ".$menus[$key]->id.
			" AND id_estado = 'P'
			AND id_idioma = 1 
			AND id_menu_tipo = 1
			AND id_menu_padre <> id_menu 
			AND id_portal = 'PR'
			order by orden");
    		$menus[$key]->childrens = $submenus;

    		foreach ($submenus as $key1 => $value1) {
    			if($value1->enlace=='#')
	        	{
	        		$submenus[$key1]->id_contenido = "";
			       	$submenus[$key1]->ver = "";	
	        	}
	        	else
	        	{
	        		$url = $value1->enlace;
			       	$partes = parse_url($url);
			       	parse_str($partes['query'], $vars);
			       	$submenus[$key1]->id_contenido = $vars['id'];
			       	$submenus[$key1]->ver = $vars['ver'];	
	        	}
	    		$submenus2 = DB::connection('paginaweb')->select("select id_menu as id, nombre_enlace as titulo, id_menu_padre as parent, '0' as id_contenido, enlace as enlace 
	        	from menu 
				where id_menu_padre = ".$submenus[$key1]->id.
				" AND id_estado = 'P'
				AND id_idioma = 1 
				AND id_menu_tipo = 1
				AND id_menu_padre <> id_menu 
				AND id_portal = 'PR'
				order by orden");
	    		$submenus[$key1]->childrens = $submenus2;
	    		foreach ($submenus2 as $key2 => $value2) {
	        		if($value2->enlace=='#')
		        	{
		        		$submenus2[$key2]->id_contenido = "";
				       	$submenus2[$key2]->ver = "";	
		        	}
		        	else
		        	{
		        		$url = $value2->enlace;
				       	$partes = parse_url($url);
				       	parse_str($partes['query'], $vars);
				       	$submenus2[$key2]->id_contenido = isset($vars['id'])?$vars['id']:'';
				       	$submenus2[$key2]->ver = isset($vars['ver'])?$vars['ver']:'';	
		        	}
	        	}
	        }	
        	
        }
        return response()->json($menus);
    }

    public function banner(Request $request)
    {
        $banner = DB::connection('paginaweb')->select("SELECT id_banner as id,
		directorio||imagen_url as imagen, 
 		descripcion as texto, 
 		nombre as titulo FROM _getbannerscategoria(581,1) AS (id_banner integer, tipo varchar, nombre varchar, imagen_url varchar, texto_url varchar, ancho smallint, alto smallint, descripcion text, directorio varchar)");
        return response()->json($banner);
    }

    public function news(Request $request)
    {	
    	$datos = array();
        $noticias = DB::connection('paginaweb')->select("SELECT c.id_contenido  as id, c.id_grupo, c.fecha_publicacion as fecha_publicar, cmi.media as imagen,  c.titulo, c.descripcion as texto ,c.nro_visita
                FROM contenido c 
                LEFT JOIN contenido_media cmi ON cmi.id_grupo = c.id_grupo and cmi.tipo='imagen'
                WHERE c.id_categoria = 1542 OR c.id_categoria = 1543 OR c.id_categoria = 1578 OR c.id_categoria = 1577 AND c.id_estado = 'P' 
                ORDER BY c.fecha_publicacion desc LIMIT 5
                ");
        array_push($datos,$noticias);

        $documentos = DB::connection('paginaweb')->select("SELECT c.id_contenido  as id, c.id_grupo, c.fecha_publicacion as fecha_publicar, cmi.media as imagen,  c.titulo, c.descripcion as texto , cm.media as url, CASE WHEN cm.media is null THEN 'content' ELSE 'url' END as tipo
			FROM contenido c
			LEFT JOIN contenido_media cm ON cm.id_grupo = c.id_grupo and cm.tipo='documento'
			LEFT JOIN contenido_media cmi ON cmi.id_grupo = c.id_grupo and cmi.tipo='imagen'
			WHERE id_seccion = 338
			AND id_estado = 'P'  ORDER BY fecha_publicar DESC LIMIT 6 ");
        array_push($datos,$documentos);

        return response()->json($datos);
    }

    public function content($id)
    {
        $contenido = DB::connection('paginaweb')->select("select fecha_publicacion, id_contenido as id, titulo, descripcion as texto 
        	from contenido
        	where id_grupo = ".$id);

        $media = DB::connection('paginaweb')->select("select * from contenido_media where id_grupo=".$id);
        $contenido[0]->medias = $media;

        return response()->json($contenido);
    }

	public function categoria($id)
    {
        $categoria = DB::connection('paginaweb')->select("select id_categoria, titulo from categoria where id_grupo = ".$id);
        $categorias = DB::connection('paginaweb')->select("SELECT id_grupo as id, fecha_publicacion as fecha_publicar, imagen, titulo, descripcion as texto
		from contenido 
		where id_categoria =  ".$categoria[0]->id_categoria. " Order By fecha_registro");
		$lista['categoria'] = $categoria;
		$lista['categorias'] = $categorias;
        return response()->json($lista);
    }    

    public function noticias($pagina = 0)
    {
    	$limite = "6";
    	if ($pagina == 0) {
        	$rango = 0;
      	} else {
	        $rango = ($pagina) * $limite;
      	}

	    $limite=$limite . ' OFFSET ' . $rango;
	    $datos = array();
        $categorias = DB::connection('paginaweb')->select("SELECT c.id_contenido  as id, c.id_grupo, c.fecha_publicacion as fecha_publicar, cmi.media as imagen,  c.titulo, c.descripcion as texto ,c.nro_visita
                FROM contenido c 
                LEFT JOIN contenido_media cmi ON cmi.id_grupo = c.id_grupo and cmi.tipo='imagen'
                WHERE c.id_categoria = 1542 OR c.id_categoria = 1543 OR c.id_categoria = 1578 OR c.id_categoria = 1577 AND c.id_estado = 'P' 
                ORDER BY c.fecha_publicacion desc 
			LIMIT ".$limite);
        $total[0]['total'] = 2; 
        array_push($datos,$categorias);
        array_push($datos,$total);
        return response()->json($datos);
    }   
    
    public function medicamento(Request $request)
    {
	$texto = $request->input('texto');
	
	$medicamentos = DB::connection('paginaweb')->select("SELECT * FROM medicamento WHERE nombre_generico ilike '%".$texto."%' ORDER BY nombre_generico ASC");
        return response()->json($medicamentos);
    }
}
