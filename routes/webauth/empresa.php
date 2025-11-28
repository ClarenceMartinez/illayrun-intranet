<?php
use Illuminate\Support\Facades\Route;

Route::get('empresas', 'App\Http\Controllers\ViewController@empresasIndex');
Route::get('empresas/filter', 'App\Http\Controllers\EmpresasController@show')->name('empresas.filter');
Route::get('empresa/{empresa}', 'App\Http\Controllers\EmpresasController@find')->name('empresas.find');

Route::post('empresas', 'App\Http\Controllers\EmpresasController@store');
Route::put('empresa/{empresas}', 'App\Http\Controllers\EmpresasController@update');
Route::delete('empresa/{empresas}', 'App\Http\Controllers\EmpresasController@delete');