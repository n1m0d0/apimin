<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiProfileController;
use App\Http\Controllers\ApiInstitutionController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiSystemController;
use App\Http\Controllers\ApiPermissionController;

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

Route::apiResource('users', ApiUserController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:1,1']);
Route::apiResource('profiles', ApiProfileController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:1,1']);
Route::apiResource('institutions', ApiInstitutionController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:1,1']);
Route::apiResource('systems', ApiSystemController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:1,1']);
Route::apiResource('permissions', ApiPermissionController::class)->middleware(['auth:api', 'checkInstitutions:1', 'checkPermissions:1,1']);

Route::any('/', function(){
    return response()->json([
        'error' => 'Bad Request'
    ], 400);
})->name('error');