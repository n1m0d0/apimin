<?php

namespace App\Http\Controllers\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
	$username = $request->input('username');

	$password = $request->input('password');	
	
	if($username  && $password){
	    $token = sha1(uniqid(rand(),true));
	    $user = DB::connection('paginaweb')->select("SELECT * FROM public.user WHERE usuario =  '".$username."' AND clave = '".md5(md5($password))."'");
	    if($user){
		if ($user[0]->clave == md5(md5($password))) {
	            $json= ['codigo'=>1,'mensaje'=>'Usuario autenticado',
                        'token'=>$token
                    ];
                    
	                    $user = DB::connection('paginaweb')->update(DB::RAW("UPDATE  public.user SET token = '".$token."' WHERE usuario= '".$username."' AND clave = '".md5(md5($password))."'"));
                    } else {
                        $json= ['codigo'=>0,'mensaje'=>'Usuario/Clave incorrectos'];
                    }
	    
	    }else {
	        $json= ['codigo'=>0,'mensaje'=>'Usuario/Clave incorrectos'];
	    }
    	    
	    
	}else {
    	    $json= ['codigo'=>0,'mensaje'=>'Usuario/Clave incorrectos'];
	}
	
	return response()->json($json);
    }
    
    public function logout(Request $request)
    {
	$token = $request->input('token');

	$user = DB::connection('paginaweb')->select("SELECT * FROM public.user WHERE token =  '".$token."' ");
	
	$json='';
	
	return response()->json($json);
    }
    
    
    public function departamentos(Request $request)
    {
    
	$lista = DB::connection('paginaweb')->select("SELECT * FROM departamento ");
        return response()->json($lista);
    }

    public function hospitales(Request $request)
    {
	$codigo = $request->input('codigo');
	$lista = DB::connection('paginaweb')->select("SELECT * FROM establecimiento_salud WHERE departamento_id='".$codigo."'");
        return response()->json($lista);
    }
    
    public function personal(Request $request)
    {
	$departamento = $request->input('departamento');
	$hospital = $request->input('hospital');
	$lista = DB::connection('paginaweb')->select("SELECT * FROM personal WHERE departamento_id = '".$departamento."' and establecimiento_salud_id = '".$hospital."'");
        return response()->json($lista);
    }
    
    
}