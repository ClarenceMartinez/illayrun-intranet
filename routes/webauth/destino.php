<?php
use Illuminate\Support\Facades\Route;

Route::get('destinos', 'App\Http\Controllers\ViewController@destinosIndex');
Route::get('destinos/filter', 'App\Http\Controllers\DestinosController@index')->name('destinos.filter');
Route::get('destino/{destino}', 'App\Http\Controllers\DestinosController@find')->name('destinos.find');

Route::post('destinos', 'App\Http\Controllers\DestinosController@store')->name('destinos.store');
Route::put('destino/{destino}', 'App\Http\Controllers\DestinosController@updateV2');
Route::delete('destino/{destino}', 'App\Http\Controllers\DestinosController@delete');