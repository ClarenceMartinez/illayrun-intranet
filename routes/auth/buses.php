<?php
use Illuminate\Support\Facades\Route;

Route::get('buses','App\Http\Controllers\BusesController@index');
Route::put('bus/{bus}','App\Http\Controllers\BusesController@update');
Route::delete('bus/{bus}','App\Http\Controllers\BusesController@destroy');
Route::post('buses','App\Http\Controllers\BusesController@create');
Route::post('bus/{bus}/asientos','App\Http\Controllers\BusesController@saveAsientos');

Route::get('caracteristicas_buses','App\Http\Controllers\CaracteristicasBusesController@index');
Route::put('caracteristicas_buses/update','App\Http\Controllers\CaracteristicasBusesController@update');
Route::post('caracteristicas_buses/edit','App\Http\Controllers\CaracteristicasBusesController@edit');
Route::delete('caracteristicas_buses/destroy','App\Http\Controllers\CaracteristicasBusesController@destroy');
Route::post('caracteristicas_buses/store','App\Http\Controllers\CaracteristicasBusesController@store');
Route::post('caracteristicas_buses/bybus','App\Http\Controllers\CaracteristicasBusesController@bybus');


Route::get('caracteristicas_buses_base','App\Http\Controllers\CaracteristicasBusesBaseController@index');
Route::post('caracteristicas_buses_base/edit','App\Http\Controllers\CaracteristicasBusesBaseController@edit');
Route::put('caracteristicas_buses_base/update','App\Http\Controllers\CaracteristicasBusesBaseController@update');
Route::delete('caracteristicas_buses_base/destroy','App\Http\Controllers\CaracteristicasBusesBaseController@destroy');
Route::post('caracteristicas_buses_base/store','App\Http\Controllers\CaracteristicasBusesBaseController@store');