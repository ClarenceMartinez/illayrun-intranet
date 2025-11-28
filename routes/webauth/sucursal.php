<?php
use Illuminate\Support\Facades\Route;

Route::get('sucursales', 'App\Http\Controllers\ViewController@sucursalesIndex');
Route::get('sucursales/filter', 'App\Http\Controllers\SucursalesController@show')->name('sucursales.filter');
Route::get('sucursal/{sucursal}', 'App\Http\Controllers\SucursalesController@find')->name('sucursales.find');

Route::post('sucursales', 'App\Http\Controllers\SucursalesController@store')->name('sucursales.store');
Route::put('sucursal/{sucursal}', 'App\Http\Controllers\SucursalesController@updateV2');
Route::delete('sucursal/{sucursal}', 'App\Http\Controllers\SucursalesController@delete');