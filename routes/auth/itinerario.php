<?php
use Illuminate\Support\Facades\Route;

Route::post('itinerario/index','App\Http\Controllers\ItinerarioController@index');
Route::get('itinerario/index_empresa','App\Http\Controllers\ItinerarioController@index_empresa');
Route::get('itinerario/index_sucursal','App\Http\Controllers\ItinerarioController@index_sucursal');
Route::get('itinerario/index_bus','App\Http\Controllers\ItinerarioController@index_bus');
Route::get('itinerario/index_chofer','App\Http\Controllers\ItinerarioController@index_chofer');
Route::get('itinerario/index_chofer2','App\Http\Controllers\ItinerarioController@index_chofer2');
Route::get('itinerario/index_asiento','App\Http\Controllers\ItinerarioController@index_asiento');
Route::get('itinerario/index_asiento','App\Http\Controllers\ItinerarioController@index_asiento');
Route::get('itinerario/index_terramoza','App\Http\Controllers\ItinerarioController@index_terramoza');
Route::get('itinerario/index_cliente','App\Http\Controllers\ItinerarioController@index_cliente');

Route::post('itinerario/edit','App\Http\Controllers\ItinerarioController@edit');
Route::put('itinerario/update','App\Http\Controllers\ItinerarioController@update');  //por tr
Route::delete('itinerario/destroy','App\Http\Controllers\ItinerarioController@destroy');
Route::post('itinerario/store','App\Http\Controllers\ItinerarioController@store');
Route::post('itinerario/busqueda','App\Http\Controllers\ItinerarioController@busqueda');
Route::get('itinerario/{itinerario}/asientos', 'App\Http\Controllers\ItinerarioController@getAsientos');
Route::get('itinerario/{itinerario}/manifiesto_pasajeros', 'App\Http\Controllers\ItinerarioController@getManifiestoPasajeros');
Route::get('itinerario/{itinerario}/croquis', 'App\Http\Controllers\ItinerarioController@getCroquis');
Route::get('itinerario/{itinerario}/manifiesto_ptoventa', 'App\Http\Controllers\ItinerarioController@getManifiestoPtoVenta');
Route::get('itinerario/{itinerario}/manifiesto_encomiendas', 'App\Http\Controllers\ItinerarioController@getManifiestoEncomiendas');

