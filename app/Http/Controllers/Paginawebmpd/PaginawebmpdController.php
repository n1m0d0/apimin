<?php

namespace App\Http\Controllers\Paginawebmpd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\paginawebmpd\RegistroRendicion;
use App\Models\paginawebmpd\Evento;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroMail;

class PaginawebmpdController extends ApiController
{
    public function register(Request $request)
    {
	$secretkey = '6LfE_EgaAAAAAIn52y7C_4KWAMUsUK8YcNAkf30b';
	$recaptcha = $request->get('recaptcha');
	//dd($recaptcha);
	//$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$recaptcha.'&remoteip='.Request::ip();
	$data = $request->only('nombre','correo', 'telefono', 'cargo','institucion','cedula_identidad');
	$evento = Evento::where('vigente',1)->first();
	//$data['vigente'] = $evento->id; 
	
	$registro = RegistroRendicion::create($data);
	
	$email = $request->get('correo');
	$detalle = "<br/><br/><h3>Rendición Pública de Cuentas </h3>
	<p>El Ministerio de Planificación del Desarrollo le está invitando a una reunión de Zoom programada.<br/>
	
	<b>Tema:</b> ".$evento->titulo."<br/>
	<b>Descripción:</b> ".$evento->descripcion."<br/>
	<b>Cuándo:</b> ".$evento->horario."<br/>
	<br/>
	Para que pueda unirse al evento, le enviaremos en el transcurso de la semana un correo electrónico con el enlace para acceder al evento.
	</p><br/><br/>
	";
	Mail::to($email)->send(new RegistroMail($registro, $detalle));
	return response($registro, Response::HTTP_CREATED); 

    }
    
    public function tema()
    {
	$html = '
	<table>
	<tr><th>Tema:</th><td>AUDIENCIA DE RENDICIÓN PÚBLICA DE CUENTAS FINAL 2020</td></tr>
	<tr><th>Descripción:</th><td>F. Gabriela Mendoza Gumiel, Ministra de Planificación del Desarrollo tienen el agrado de invitar a la Audiencia de Rendición Pública de Cuentas Final 2020</td></tr>
	<tr><th>Hora:</th><td>19 feb. 2021 02:30 p. m. en La Paz</td></tr>
	
	</table>
	';
	return response($html, Response::HTTP_OK); 
    }
    
    public function evento(){
	$evento = Evento::where('vigente',1)->first();
	return response($evento, Response::HTTP_OK); 
    }
}
