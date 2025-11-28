<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PerfilController extends Controller
{
    public function update(){
        $params = request()->all(['nombres','apellidos','email','telefono','fecha_nacimiento','numerodocumento']);
        $user = auth()->user();
        $user->fill($params);
        $user->save();

        $retorno = [];
        $retorno['status'] = true;
        $retorno['message'] = 'Datos actualizados correctamente';

        return response()->json($retorno);
    }
}
