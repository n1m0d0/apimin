<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiProfileController;
use App\Http\Controllers\ApiInstitutionController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiSystemController;
use App\Http\Controllers\ApiPermissionController;
use App\Http\Controllers\Sispro\SisproController;
use App\Http\Controllers\Sisin\SisinController;
use App\Http\Controllers\Sisin\ProcedureController;
use App\Http\Controllers\Sisfin\SisfinController;
use App\Http\Controllers\Paginaweb\PaginawebController;
use App\Http\Controllers\Reportes\ReportesController;
use App\Http\Controllers\Sisplan\SisplanController;
use App\Http\Controllers\Paginawebmpd\PaginawebmpdController;
use App\Http\Controllers\Login\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', [ApiAuthController::class, "login"]);

Route::get('logout', [ApiAuthController::class, "logout"])->middleware('auth:api');
Route::get('getUser', [ApiAuthController::class, "getUSer"])->middleware('auth:api');

Route::apiResource('users', ApiUserController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:8,5']);
Route::apiResource('profiles', ApiProfileController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:8,5']);
Route::apiResource('institutions', ApiInstitutionController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:8,5']);
Route::apiResource('systems', ApiSystemController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:8,5']);
Route::apiResource('permissions', ApiPermissionController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:8,5']);

Route::any('/', function(){
    return response()->json([
        'error' => 'Bad Request'
    ], 400);
})->name('error');

/* old routes */

//SISPRO
//Route::resource('sispro/proyecto', 'Sispro\SisproController', ['only' => 'show']);
Route::get('sispro/proyecto', [SisproController::class, 'show']);

//SISIN
/*Route::name('proyecto.sisin')->get('sisin/proyecto/{codigo}', 'Sisin\SisinController@proyecto');
Route::name('lista.proyectos.sisin')->post('sisin/listaproyectos', 'Sisin\SisinController@listaProyectos');
Route::name('presupuesto.sisin')->get('sisin/presupuesto/{codigo}', 'Sisin\SisinController@presupuesto');
Route::name('cierre.sisin')->get('sisin/cierre/{gestion}', 'Sisin\SisinController@cierre');
Route::name('sisin.gestionTipoEntidad')->get('sisin/gestionTipoEntidad', 'Sisin\ProcedureController@gestionTipoEntidad');
Route::name('sisin.gestionEntidad')->get('sisin/gestionEntidad', 'Sisin\ProcedureController@gestionEntidad');*/
Route::name('proyecto.sisin')->get('sisin/proyecto/{codigo}', [SisinController::class, 'proyecto']);
Route::name('lista.proyectos.sisin')->post('sisin/listaproyectos', [SisinController::class, 'listaProyectos']);
Route::name('presupuesto.sisin')->get('sisin/presupuesto/{codigo}', [SisinController::class, 'presupuesto']);
Route::name('cierre.sisin')->get('sisin/cierre/{gestion}', [SisinController::class, 'cierre']);
Route::name('sisin.gestionTipoEntidad')->get('sisin/gestionTipoEntidad', [ProcedureController::class, 'gestionTipoEntidad']);
Route::name('sisin.gestionEntidad')->get('sisin/gestionEntidad', [ProcedureController::class, 'gestionEntidad']);

//Sistema de Seguimiento
/*Route::name('seguimiento.sisin')->get('sisin/ejecucionMesSisin/{gestion}/{mes}', 'Sisin\SisinController@ejecucionMesSisin');
Route::name('seguimiento.monto_original')->get('sisin/montoOriginal/{codInversion}', 'Sisin\SisinController@montoOriginal');
Route::name('seguimiento.fecha_original')->get('sisin/fechaOriginal/{codInversion}/{cambioFecha}/{cambioFechaCosto}', 'Sisin\SisinController@fechaOriginal');
Route::name('seguimiento.monto_ajustado')->get('sisin/montoAjustado/{codInversion}/{cambioCosto}/{cambioFechaCosto}', 'Sisin\SisinController@montoAjustado');
Route::name('seguimiento.nro_modificacion')->get('sisin/nroModificacion/{codInversion}/{cambio}/{cambioFechaCosto}', 'Sisin\SisinController@nroModificacion');
Route::name('seguimiento.ejecucion_mes_sector')->get('sisin/ejecucionMesSectorSisin/{gestion}/{mes}/{sector}', 'Sisin\SisinController@ejecucionMesSectorSisin');*/
Route::name('seguimiento.sisin')->get('sisin/ejecucionMesSisin/{gestion}/{mes}', [SisinController::class, 'ejecucionMesSisin']);
Route::name('seguimiento.monto_original')->get('sisin/montoOriginal/{codInversion}', [SisinController::class, 'montoOriginal']);
Route::name('seguimiento.fecha_original')->get('sisin/fechaOriginal/{codInversion}/{cambioFecha}/{cambioFechaCosto}', [SisinController::class, 'fechaOriginal']);
Route::name('seguimiento.monto_ajustado')->get('sisin/montoAjustado/{codInversion}/{cambioCosto}/{cambioFechaCosto}', [SisinController::class, 'montoAjustado']);
Route::name('seguimiento.nro_modificacion')->get('sisin/nroModificacion/{codInversion}/{cambio}/{cambioFechaCosto}', [SisinController::class, 'nroModificacion']);
Route::name('seguimiento.ejecucion_mes_sector')->get('sisin/ejecucionMesSectorSisin/{gestion}/{mes}/{sector}', [SisinController::class, 'ejecucionMesSectorSisin']);

//SISFIN
/*Route::name('convenio.sisfin')->get('sisfin/convenio/{convenio}', 'Sisfin\SisfinController@convenio');
Route::name('convenio.datosSisfin')->get('sisfin/datosConvenio/{codigoSisfin}', 'Sisfin\SisfinController@datosConvenio');*/
Route::name('convenio.sisfin')->get('sisfin/convenio/{convenio}', [SisfinController::class, 'convenio']);
Route::name('convenio.datosSisfin')->get('sisfin/datosConvenio/{codigoSisfin}', [SisfinController::class, 'datosConvenio']);

//PAGINA WEB
/*Route::name('menu.paginaweb')->get('paginaweb/news/menu', 'Paginaweb\PaginawebController@menu');
Route::name('newsbanner.paginaweb')->get('paginaweb/news/banner', 'Paginaweb\PaginawebController@banner');
Route::name('news.paginaweb')->get('paginaweb/news', 'Paginaweb\PaginawebController@news');
Route::name('newscontent.paginaweb')->get('paginaweb/news/content/{id}', 'Paginaweb\PaginawebController@content');
Route::name('newscategoria.paginaweb')->get('paginaweb/news/categoria/{id}', 'Paginaweb\PaginawebController@categoria');
Route::name('newscategoria.paginaweb')->get('paginaweb/news/noticias/{pagina?}', 'Paginaweb\PaginawebController@noticias');
Route::name('medicamento')->get('paginaweb/medicamento', 'Paginaweb\PaginawebController@medicamento');*/
Route::name('menu.paginaweb')->get('paginaweb/news/menu', [PaginawebController::class, 'menu']);
Route::name('newsbanner.paginaweb')->get('paginaweb/news/banner', [PaginawebController::class, 'banner']);
Route::name('news.paginaweb')->get('paginaweb/news', [PaginawebController::class, 'news']);
Route::name('newscontent.paginaweb')->get('paginaweb/news/content/{id}', [PaginawebController::class, 'content']);
Route::name('newscategoria.paginaweb')->get('paginaweb/news/categoria/{id}', [PaginawebController::class, 'categoria']);
Route::name('newscategoria.paginaweb')->get('paginaweb/news/noticias/{pagina?}', [PaginawebController::class, 'noticias']);
Route::name('medicamento')->get('paginaweb/medicamento', [PaginawebController::class, 'medicamento']);

//REPORTES
/*Route::name('gestion.reportes')->get('reportes/gestion', 'Reportes\ReportesController@gestion');
Route::name('grafico.reportes')->get('reportes/grafico/{id}', 'Reportes\ReportesController@grafico');

Route::name('seguimiento.ejecucion_mes_sector2')->get('sisin/ejecucionMesSectorSisin/{gestion}/{mes}/{sector}', 'Sisin\SisinController@ejecucionMesSectorSisin');

Route::name('grafico.detalleInstitucional')->get('reportes/detalleInstitucional', 'Reportes\ReportesController@detalleInstitucional');
Route::name('grafico.detalleOperacionesContratadas')->get('reportes/detalleOperacionesContratadas', 'Reportes\ReportesController@detalleOperacionesContratadas');
Route::name('grafico.detalleOperacionesContratadasAgencia')->get('reportes/detalleOperacionesContratadasAgencia', 'Reportes\ReportesController@detalleOperacionesContratadasAgencia');
Route::name('grafico.detalleDesembolso')->get('reportes/detalleDesembolso', 'Reportes\ReportesController@detalleDesembolso');
Route::name('grafico.detalleTablaContratacion')->get('reportes/detalleTablaContratacion', 'Reportes\ReportesController@detalleTablaContratacion');
Route::name('reportes.gestion')->get('reportes/gestion', 'Reportes\ReportesController@gestiones');
Route::name('reportes.proyectos')->get('reportes/proyectos', 'Reportes\ReportesController@proyectos');
Route::name('reportes.proyectosGeneral')->get('reportes/proyectosGeneral', 'Reportes\ReportesController@proyectosGeneral');*/
Route::name('gestion.reportes')->get('reportes/gestion', [ReportesController::class, 'gestion']);
Route::name('grafico.reportes')->get('reportes/grafico/{id}', [ReportesController::class, 'grafico']);

Route::name('seguimiento.ejecucion_mes_sector2')->get('sisin/ejecucionMesSectorSisin/{gestion}/{mes}/{sector}', [SisinController::class, 'ejecucionMesSectorSisin']);

Route::name('grafico.detalleInstitucional')->get('reportes/detalleInstitucional', [ReportesController::class, 'detalleInstitucional']);
Route::name('grafico.detalleOperacionesContratadas')->get('reportes/detalleOperacionesContratadas', [ReportesController::class, 'detalleOperacionesContratadas']);
Route::name('grafico.detalleOperacionesContratadasAgencia')->get('reportes/detalleOperacionesContratadasAgencia', [ReportesController::class, 'detalleOperacionesContratadasAgencia']);
Route::name('grafico.detalleDesembolso')->get('reportes/detalleDesembolso', [ReportesController::class, 'detalleDesembolso']);
Route::name('grafico.detalleTablaContratacion')->get('reportes/detalleTablaContratacion', [ReportesController::class, 'detalleTablaContratacion']);
Route::name('reportes.gestion')->get('reportes/gestion', [ReportesController::class, 'gestiones']);
Route::name('reportes.proyectos')->get('reportes/proyectos', [ReportesController::class, 'proyectos']);
Route::name('reportes.proyectosGeneral')->get('reportes/proyectosGeneral', [ReportesController::class, 'proyectosGeneral']);

//SISPLAN
/*Route::name('proyectosPriorizados')->get('sisplan/proyectosPriorizados/{codigo}', 'Sisplan\SisplanController@proyectosPriorizados');*/
Route::name('proyectosPriorizados')->get('sisplan/proyectosPriorizados/{codigo}', [SisplanController::class, 'proyectosPriorizados']);

//PAGINA WEB MPD
/*Route::name('registro')->post('paginawebmpd/registro', 'Paginawebmpd\PaginawebmpdController@register');
Route::name('tema')->get('paginawebmpd/tema', 'Paginawebmpd\PaginawebmpdController@tema');
Route::name('evento')->get('paginawebmpd/evento', 'Paginawebmpd\PaginawebmpdController@evento');

Route::post('paginaweb/login','Login\LoginController@login')->name('login');
Route::get('paginaweb/hospitales','Login\LoginController@hospitales')->name('hospitales');
Route::get('paginaweb/departamentos','Login\LoginController@departamentos')->name('departamentos');
Route::get('paginaweb/personal','Login\LoginController@personal')->name('personal');*/

Route::name('registro')->post('paginawebmpd/registro', [PaginawebmpdController::class, 'register']);
Route::name('tema')->get('paginawebmpd/tema', [PaginawebmpdController::class, 'tema']);
Route::name('evento')->get('paginawebmpd/evento', [PaginawebmpdController::class, 'evento']);

Route::post('paginaweb/login', [LoginController::class, 'login'])->name('login');
Route::get('paginaweb/hospitales', [LoginController::class, 'hospitales'])->name('hospitales');
Route::get('paginaweb/departamentos', [LoginController::class, 'departamentos'])->name('departamentos');
Route::get('paginaweb/personal', [LoginController::class, 'personal'])->name('personal');