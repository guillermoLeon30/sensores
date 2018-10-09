<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function (){
  Route::resource('categorias', 'categoriasController')->only(['index', 'store']);
  Route::group(['prefix'  =>  'categorias'], function (){
    Route::post('activar', 'categoriasController@activar');
    Route::post('desactivar', 'categoriasController@desactivar');
  });

  Route::resource('empresas', 'empresaController')->only(['index', 'store']);
  Route::group(['prefix'  =>  'empresas'], function (){
    Route::post('activar', 'empresaController@activar');
    Route::post('desactivar', 'empresaController@desactivar');
    Route::get('registro/{empresa}', 'empresaController@registros');
  });

  Route::resource('user', 'userController');

  Route::resource('equipo', 'equipoController');
  Route::group(['prefix' => 'equipo'], function (){
    Route::get('{equipo}/sensores', 'equipoController@sensores');
  });

  Route::resource('sensor', 'sensorController');
});

