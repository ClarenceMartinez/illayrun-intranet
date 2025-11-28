<?php
use Illuminate\Support\Facades\Route;

Route::get('/itinerarios', 'App\Http\Controllers\ViewController@itinerariosIndex');
Route::get('/itinerarios/filter','App\Http\Controllers\ItinerarioController@busqueda');
Route::get('itinerario/{itinerario}/asientos', 'App\Http\Controllers\ItinerarioController@getAsientos');
Route::get('itinerario/{itinerario}/reporte/{reporte}', [\App\Http\Controllers\PdfController::class, 'itinerarioReporte']);

Route::post('itinerarios','App\Http\Controllers\ItinerarioController@store');
Route::put('itinerario/{itinerario}','App\Http\Controllers\ItinerarioController@updateV2'); 
Route::delete('itinerario/{itinerario}','App\Http\Controllers\ItinerarioController@delete'); 

