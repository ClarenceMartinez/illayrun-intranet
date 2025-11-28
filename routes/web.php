<?php

use Illuminate\Support\Facades\Route;

Route::post('/empresas/verifica', 'App\Http\Controllers\EmpresasController@verifica')->name('empresas.verifica');

Route::group(['middleware'=>'guest'], function(){
    Route::view('/login', 'login.index')->name('login');
    Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('do-login');
});

Route::group(['middleware'=>'auth'], function(){
    Route::view('/', 'panel.panel');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('do-logout');

    Route::post('sunat/consulta','App\Http\Controllers\SunatController@consulta')->name('sucursales.sunat');
    Route::post('reniec/consulta','App\Http\Controllers\ReniecController@consulta')->name('clientes.reniec');

    require(dirname(__FILE__).'/webauth/buses.php');
    require(dirname(__FILE__).'/webauth/cliente.php');
    require(dirname(__FILE__).'/webauth/destino.php');
    require(dirname(__FILE__).'/webauth/encomienda.php');
    require(dirname(__FILE__).'/webauth/empresa.php');
    require(dirname(__FILE__).'/webauth/itinerario.php');
    require(dirname(__FILE__).'/webauth/perfil.php');
    require(dirname(__FILE__).'/webauth/sucursal.php');
    require(dirname(__FILE__).'/webauth/tipo_usuarios.php');
    require(dirname(__FILE__).'/webauth/usuario.php');
    require(dirname(__FILE__).'/webauth/ventas.php');
});