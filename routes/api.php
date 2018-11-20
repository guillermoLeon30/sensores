<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'Auth\LoginController@apiLogin');

Route::get('/sensor/data', 'EquipoController@apiDataSensor'); // Mover con el middleware de seguridad
Route::post('/sensor', 'EquipoController@apiStore');

Route::group(['middleware' => 'auth:api'], function (){
  Route::get('/equipos', 'EquipoController@apiIndex');
});
