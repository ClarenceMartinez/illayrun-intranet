<?php
use Illuminate\Support\Facades\Route;

Route::get('clientes', 'App\Http\Controllers\ViewController@clientesIndex');
Route::get('clientes/filter', 'App\Http\Controllers\ClientesController@index')->name('clientes.filter');
Route::get('clientes/find', 'App\Http\Controllers\ClientesController@find');
Route::get('cliente/{cliente}', 'App\Http\Controllers\ClientesController@findV2')->name('clientes.find');

Route::post('clientes', 'App\Http\Controllers\ClientesController@store')->name('clientes.store');
Route::put('cliente/{cliente}', 'App\Http\Controllers\ClientesController@updateV2');
Route::delete('cliente/{cliente}', 'App\Http\Controllers\ClientesController@delete');