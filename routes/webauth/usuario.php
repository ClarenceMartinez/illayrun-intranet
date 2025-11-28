<?php
use Illuminate\Support\Facades\Route;

Route::get('usuarios', 'App\Http\Controllers\ViewController@usuariosIndex');
Route::get('usuarios/filter', 'App\Http\Controllers\UsuariosController@index')->name('usuarios.filter');
Route::get('usuario/{usuario}', 'App\Http\Controllers\UsuariosController@find')->name('usuarios.find');

Route::post('usuarios', 'App\Http\Controllers\UsuariosController@store')->name('usuarios.store');
Route::put('usuario/{usuario}', 'App\Http\Controllers\UsuariosController@updateV2');
Route::delete('usuario/{usuario}', 'App\Http\Controllers\UsuariosController@delete');