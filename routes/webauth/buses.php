<?php
use Illuminate\Support\Facades\Route;

Route::get('buses','App\Http\Controllers\ViewController@busesIndex');
Route::get('buses/filter','App\Http\Controllers\BusesController@index');

Route::put('bus/{bus}','App\Http\Controllers\BusesController@update');
Route::delete('bus/{bus}','App\Http\Controllers\BusesController@destroy');
Route::post('buses','App\Http\Controllers\BusesController@create');
Route::post('bus/{bus}/asientos','App\Http\Controllers\BusesController@saveAsientos');

/*
Route::get('caracteristicas_buses','App\Http\Controllers\CaracteristicasBusesController@index');
Route::put('caracteristicas_buses/update','App\Http\Controllers\CaracteristicasBusesController@update');
Route::post('caracteristicas_buses/edit','App\Http\Controllers\CaracteristicasBusesController@edit');
Route::delete('caracteristicas_buses/destroy','App\Http\Controllers\CaracteristicasBusesController@destroy');
Route::post('caracteristicas_buses/store','App\Http\Controllers\CaracteristicasBusesController@store');
Route::post('caracteristicas_buses/bybus','App\Http\Controllers\CaracteristicasBusesController@bybus');
*/


Route::get('caracteristicasbasesbuses','App\Http\Controllers\ViewController@caracteristicasBusBase');
Route::get('caracteristicasbasesbuses/filter','App\Http\Controllers\CaracteristicasBusesBaseController@index')->name('caracteristicasbasesbuses.filter');
Route::get('caracteristicabasebus/{item}','App\Http\Controllers\CaracteristicasBusesBaseController@find');
Route::post('caracteristicasbasesbuses','App\Http\Controllers\CaracteristicasBusesBaseController@store')->name('caracteristicasbasesbuses.store');
Route::put('caracteristicabasebus/{item}','App\Http\Controllers\CaracteristicasBusesBaseController@updateV2');
Route::delete('caracteristicabasebus/{item}','App\Http\Controllers\CaracteristicasBusesBaseController@delete');
