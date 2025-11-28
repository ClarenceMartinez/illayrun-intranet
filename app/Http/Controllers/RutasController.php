<?php

namespace App\Http\Controllers;

use App\Models\rutas;
use Illuminate\Http\Request;

class RutasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = rutas::all();
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode( $inputJSON, TRUE );

        $retorno = [];
        $retorno['status'] = false;

        $rutas              = new rutas();
        $rutas->buses_id    = $input["buses_id"];
        $rutas->origen_id   = $input["origen_id"];
        $rutas->destino_id  = $input["destino_id"];
        $rutas->estado      = 1;//$input["estado"];
        // $rutas->created_at  = $input["created_at"];
        // $rutas->updated_at  = $input["updated_at"];
        $rutas->save();

        $retorno['status'] = true;

        $retorno['message'] = 'La Ruta se guardo correctamente';
        return response()->json($retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rutas  $rutas
     * @return \Illuminate\Http\Response
     */
    public function show(rutas $rutas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rutas  $rutas
     * @return \Illuminate\Http\Response
     */
    public function edit(rutas $rutas)
    {
        $input =json_decode(file_get_contents('php://input'),true);
        $obj = rutas::find($input["id"]);
        // return response()->json($obj);

        $retorno['status'] = true;
        $retorno['lista'] = $obj;

        return response()->json($retorno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rutas  $rutas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rutas $rutas)
    {
        $input =json_decode(file_get_contents('php://input'),true);

        $retorno = [];
        $retorno['status'] = false;

        $rutas = rutas::find($input["id"]);
        $rutas->buses_id = $input["buses_id"];
        $rutas->origen_id = $input["origen_id"];
        $rutas->destino_id = $input["destino_id"];
        $rutas->estado  = $input["estado"];
        // $rutas->created_at  = $input["created_at"];
        // $rutas->updated_at  = $input["updated_at"];
        $rutas->save();


        $retorno['status'] = true;

        $retorno['message'] = 'La Ruta se actualizo correctamente';
        return response()->json($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rutas  $rutas
     * @return \Illuminate\Http\Response
     */
    public function destroy(rutas $rutas)
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode( $inputJSON, TRUE );

        $retorno = [];
        $retorno['status'] = false;

        $usuarios = rutas::find($input["id"]);
        // $usuarios->delete();

        $usuarios->estado = 0;
        $usuarios->save();

        $retorno['status'] = true;

        $retorno['message'] = 'La Ruta se desactivo correctamente';
        return response()->json($retorno);
    }
}
