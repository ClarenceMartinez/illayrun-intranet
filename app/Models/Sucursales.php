<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    use HasFactory;


    public function obtenerSucursalesActivasByEmpresa($empresa_id)
    {
        // echo $empresa_id;
    	return Sucursales::where('empresa_id', '=', $empresa_id)->where('estado', '=', 1)->get();
    }
}
