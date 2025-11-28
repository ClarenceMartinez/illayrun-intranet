<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    public function __invoke(){
        return response()->json([
            'departamentos' => Departamento::all(),
            'provincias' => Provincia::all(),
            'distritos' => Distrito::all()
        ]);
    }
}


