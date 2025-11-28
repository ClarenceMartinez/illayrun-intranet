<?php
use Illuminate\Support\Facades\Route;

Route::get('/tipodocumentos', function(){
    return response()->json(\App\Models\TipoDocumento::get());
});