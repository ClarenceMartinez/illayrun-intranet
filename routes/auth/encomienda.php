<?php
use Illuminate\Support\Facades\Route;

Route::get('encomiendas', 'App\Http\Controllers\ViewController@encomiendasIndex')->name('encomiendas');
Route::get('encomiendas/filter', 'App\Http\Controllers\EncomiendaController@search');
Route::post('encomiendas', 'App\Http\Controllers\EncomiendaController@create');
Route::put('encomienda/{encomienda}', 'App\Http\Controllers\EncomiendaController@update');
Route::delete('encomienda/{encomienda}', 'App\Http\Controllers\EncomiendaController@delete');