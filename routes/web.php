<?php

use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::get('/', 'App\Http\Controllers\Frontend\WelcomeController@index')->name('welcome');

//Consulta frontend
Route::get('solicitudes/get-all-frontend', 'App\Http\Controllers\SolicitudController@getAllFrontend')->name('solicitudes.get-all-frontend');
Route::get('solicitud/{id}/detalle', 'App\Http\Controllers\SolicitudController@showFrontend')->name('solicitudes.show-frontend');
Route::get('solicitud/captura', 'App\Http\Controllers\SolicitudController@createFrontend')->name('solicitudes.create-frontend');


Route::group(['middleware' => ['auth']], function () {

    Route::get('dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('home');

    Route::group(['middleware' => ['role:admin']], function () {


        //Módulo de usuarios
        Route::put('cuentas-usuario/update-password/{id}', 'App\Http\Controllers\CuentasUsuarioController@updatePassword')->name('cuentas-usuario.update-password');
        Route::get('cuentas-usuario/contrasenia/{id}', 'App\Http\Controllers\CuentasUsuarioController@cambiarContrasenia')->name('cuentas-usuario.cambiar-contrasenia');
        Route::get('cuentas-usuario/get-all', 'App\Http\Controllers\CuentasUsuarioController@getAll')->name('cuentas-usuario.get-all');
        Route::resource('cuentas-usuario', 'App\Http\Controllers\CuentasUsuarioController',['except'=>'']);

        Route::get('solicitudes/get-all', 'App\Http\Controllers\SolicitudController@getAll')->name('solicitudes.get-all');
        Route::resource('solicitudes', 'App\Http\Controllers\SolicitudController',['except'=>'']);



        Route::group([ 'prefix' => 'catalogos'], function () {
            Route::get('/', 'App\Http\Controllers\Catalogos\CatalogoController@index')->name('catalogos.index');
        });
    });

});

Route::view('home', 'home')->middleware('auth');
