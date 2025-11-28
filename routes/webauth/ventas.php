<?php
use Illuminate\Support\Facades\Route;

// Ventas
Route::get('ventas', 'App\Http\Controllers\ViewController@ventasIndex');
Route::get('ventas/filter', 'App\Http\Controllers\VentasController@filter');
Route::get('ventas/ptoventas', 'App\Http\Controllers\VentasController@getPtoVentas');
Route::post('ventas', 'App\Http\Controllers\VentasController@create');