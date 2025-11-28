<?php
use Illuminate\Support\Facades\Route;

Route::view('/perfil', 'perfil/index');
Route::post('/perfil', 'App\Http\Controllers\PerfilController@update');


