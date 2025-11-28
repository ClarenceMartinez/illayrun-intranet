<?php
use Illuminate\Support\Facades\Route;

Route::get('tipo_usuarios', 'App\Http\Controllers\ViewController@tipousuariosIndex');
Route::get('tipo_usuarios/filter', 'App\Http\Controllers\TipousuariosController@index')->name('tipo_usuarios.filter');
Route::get('tipo_usuario/{tipousuario}', 'App\Http\Controllers\TipousuariosController@find')->name('tipo_usuarios.find');

Route::post('tipo_usuarios', 'App\Http\Controllers\TipousuariosController@store')->name('tipo_usuarios.store');
Route::put('tipo_usuario/{tipousuario}', 'App\Http\Controllers\TipousuariosController@updateV2');
Route::delete('tipo_usuario/{tipousuario}', 'App\Http\Controllers\TipousuariosController@delete');