<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [ApiUserController::class, "register"])->name("user.register");

Route::post('/login', [ApiUserController::class, "login"])->name("user.login");

Route::get('/logout', [ApiUserController::class, "logout"])->name("user.logout")->middleware('auth:api');
