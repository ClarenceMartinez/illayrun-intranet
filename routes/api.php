<?php
use Illuminate\Support\Facades\Route;

// Route::resource('empresas','EmpresasController');
Route::resource('empresas','App\Http\Controllers\EmpresasController');
Route::post('empresas/store','App\Http\Controllers\EmpresasController@store');
Route::post('empresas/edit','App\Http\Controllers\EmpresasController@edit');
Route::post('empresas/show','App\Http\Controllers\EmpresasController@show');
Route::post('empresas/verifica','App\Http\Controllers\EmpresasController@verifica');

Route::resource('sucursales','App\Http\Controllers\SucursalesController');
Route::post('sucursales/store','App\Http\Controllers\SucursalesController@store');
Route::post('sucursales/edit','App\Http\Controllers\SucursalesController@edit');
Route::post('sucursales/byempresa','App\Http\Controllers\SucursalesController@byempresa');
Route::post('sucursales/show','App\Http\Controllers\SucursalesController@show');


// Route::resource('usuarios','App\Http\Controllers\UsuariosController');
Route::Get('usuarios/index','App\Http\Controllers\UsuariosController@index');
Route::Get('usuarios/edit','App\Http\Controllers\UsuariosController@edit');
Route::put('usuarios/update','App\Http\Controllers\UsuariosController@update');
Route::delete('usuarios/destroy','App\Http\Controllers\UsuariosController@destroy');
Route::post('usuarios/store','App\Http\Controllers\UsuariosController@store');
Route::post('usuarios/login','App\Http\Controllers\UsuariosController@login');
Route::post('usuarios/byempresa','App\Http\Controllers\UsuariosController@byempresa');

Route::post('usuarios/edit','App\Http\Controllers\UsuariosController@edit');

// Route::resource('clientes','App\Http\Controllers\ClientesController');


Route::Get('clientes/index','App\Http\Controllers\ClientesController@index');
Route::put('clientes/update','App\Http\Controllers\ClientesController@update');
Route::delete('clientes/destroy','App\Http\Controllers\ClientesController@destroy');
Route::post('clientes/store','App\Http\Controllers\ClientesController@store');
Route::post('clientes/edit','App\Http\Controllers\ClientesController@edit');
Route::put('clientes/update','App\Http\Controllers\ClientesController@update');
Route::post('clientes/byempresa','App\Http\Controllers\ClientesController@byempresa');
Route::get('cliente','App\Http\Controllers\ClientesController@find');


Route::resource('destinos','App\Http\Controllers\DestinosController');
Route::post('destinos/store','App\Http\Controllers\DestinosController@store');
Route::post('destinos/edit','App\Http\Controllers\DestinosController@edit');
Route::put('destinos/update','App\Http\Controllers\DestinosController@update'); // por tarbajar

// Route::post('usuarios/edit','App\Http\Controllers\UsuariosController@edit');


Route::Get('tipousuarios/index','App\Http\Controllers\TipousuariosController@index');
Route::post('tipousuarios/edit','App\Http\Controllers\TipousuariosController@edit');
Route::put('tipousuarios/update','App\Http\Controllers\TipousuariosController@update');
Route::delete('tipousuarios/destroy','App\Http\Controllers\TipousuariosController@destroy');
Route::post('tipousuarios/store','App\Http\Controllers\TipousuariosController@store');



Route::Get('rutas/index','App\Http\Controllers\RutasController@index');
Route::post('rutas/edit','App\Http\Controllers\RutasController@edit');
Route::put('rutas/update','App\Http\Controllers\RutasController@update');
Route::delete('rutas/destroy','App\Http\Controllers\RutasController@destroy');
Route::post('rutas/store','App\Http\Controllers\RutasController@store');

Route::resource('asientos','App\Http\Controllers\AsientosController');
Route::post('asientos/store','App\Http\Controllers\AsientosController@store');
Route::post('asientos/edit','App\Http\Controllers\AsientosController@edit');

Route::post('sunat/consulta','App\Http\Controllers\SunatController@consulta');
Route::post('reniec/consulta','App\Http\Controllers\ReniecController@consulta');



foreach (glob(__DIR__."/auth/*.php") as $filename){
    require $filename; 
}

Route::group(['middleware'=>'auth:sanctum'], function(){

    Route::get('/usuario', 'App\Http\Controllers\UsuariosController@getInfo');
    Route::put('/usuario', 'App\Http\Controllers\UsuariosController@updateProfile');

});