<?php
use Illuminate\Support\Facades\Route;

// Ventas
Route::get('ventas/index', 'App\Http\Controllers\VentasController@index');
Route::get('ventas/ptoventas', 'App\Http\Controllers\VentasController@getPtoVentas');
Route::post('ventas', 'App\Http\Controllers\VentasController@create');