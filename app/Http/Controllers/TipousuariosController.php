<?php

namespace App\Http\Controllers;

use App\Models\tipousuarios;
use Illuminate\Http\Request;

class TipousuariosController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(tipousuarios $tipousuario)
    {
        return response()->json($tipousuario);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $obj = (new \App\Repos\TipoUsuarioRepo)->search();
        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;

        return response()->json($retorno);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $input = request()->all();
        $retorno = [];
        $retorno['status'] = false;


        if(!$request->has("tipousuario"))
        {
            $retorno['message'] = 'Ingrese el tipo usuario';
            return response()->json($retorno);
        }

        $tipousuarios = new tipousuarios();
        $tipousuarios->tipousuario = $input["tipousuario"];
        $tipousuarios->estado = 1;
        $tipousuarios->save();

        $retorno['status'] = true;

        $retorno['message'] = 'El Tipo se guardo correctamente';
        return response()->json($retorno);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tipousuarios  $tipousuarios
     * @return \Illuminate\Http\Response
     */
    public function show(tipousuarios $tipousuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipousuarios  $tipousuarios
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $retorno = [];
        $retorno['status'] = false;
        if (!$request->has("id"))
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
        }

        $input =json_decode(file_get_contents('php://input'),true);
        $lista = tipousuarios::find($input["id"]);
        $retorno['status'] = true;
        $retorno['lista'] = $lista;

        return response()->json($retorno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipousuarios  $tipousuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipousuarios $tipousuarios)
    {
        $input =json_decode(file_get_contents('php://input'),true);
        
        $retorno = [];
        $retorno['status'] = false;


        if(!$request->has("tipousuario"))
        {
            $retorno['message'] = 'Ingrese el tipo usuario';
            return response()->json($retorno);
            exit;
        }

        if(!$request->has("estado"))
        {
            $retorno['message'] = 'Selecciones Estado';
            return response()->json($retorno);
            exit;
        }


        $tipousuarios = tipousuarios::find($input["id"]);
        $tipousuarios->tipousuario = $input["tipousuario"];
        $tipousuarios->estado = $input["estado"];
        $tipousuarios->save();

        $retorno['status'] = true;

        $retorno['message'] = 'El Tipo de Usuario se actualizo correctamente';
        return response()->json($retorno);
    }

    public function updateV2(Request $request, tipousuarios $tipousuario)
    {
        $input = request()->all();
        
        $retorno = [];
        $retorno['status'] = false;

        if(!$request->has("tipousuario"))
        {
            $retorno['message'] = 'Ingrese el tipo usuario';
            return response()->json($retorno);
        }

        if(!$request->has("estado"))
        {
            $retorno['message'] = 'Selecciones Estado';
            return response()->json($retorno);
        }

        $tipousuario->tipousuario = $input["tipousuario"];
        $tipousuario->estado = $input["estado"];
        $tipousuario->save();

        $retorno['status'] = true;
        $retorno['message'] = 'El Tipo de Usuario se actualizo correctamente';
        return response()->json($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipousuarios  $tipousuarios
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $retorno = [];
        $retorno['status'] = false;

        $inputJSON = file_get_contents('php://input');
        $input = json_decode( $inputJSON, TRUE );

        if(!$request->has("id"))
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
        }


        $usuarios = tipousuarios::find($input["id"]);
        // $usuarios->delete();

        $usuarios->estado = 0;  
        $usuarios->save();
        $retorno['status'] = true;
        $retorno['message'] = 'El Tipo de Usuario se elimino correctamente';
        return response()->json($retorno);
    }

    public function delete(Request $request, tipousuarios $tipousuario){
        $tipousuario->estado = 0;  
        $tipousuario->save();
        $retorno['status'] = true;
        $retorno['message'] = 'El Tipo de Usuario se elimino correctamente';
        return response()->json($retorno);
    }
}
