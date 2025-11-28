<?php

namespace App\Http\Controllers;

use App\Models\caracteristicas_buses_base;
use Illuminate\Http\Request;

class CaracteristicasBusesBaseController extends Controller
{
    public function find(caracteristicas_buses_base $item){
        return response()->json($item);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $obj = caracteristicas_buses_base::all();
        
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


        if(!$request->has("nombre_caracteristica"))
        {
            $retorno['message'] = 'Ingrese caracteristica del Bus';
            return response()->json($retorno);
        }

        $caracteristicas_buses_base = new caracteristicas_buses_base();
        $caracteristicas_buses_base->nombre_caracteristica = $input["nombre_caracteristica"];
        $caracteristicas_buses_base->estado = 1; 
        $caracteristicas_buses_base->save();

        $retorno['status'] = true;
        $retorno['message'] = 'La caracteristica se guardo correctamente';

        return response()->json($retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\caracteristicas_buses_base  $caracteristicas_buses_base
     * @return \Illuminate\Http\Response
     */
    public function show(caracteristicas_buses_base $caracteristicas_buses_base)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\caracteristicas_buses_base  $caracteristicas_buses_base
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        if (!$request->has("id"))
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
        }

        $input =json_decode(file_get_contents('php://input'),true);
        $lista = caracteristicas_buses_base::find($input["id"]);
        
        $retorno['status'] = true;
        $retorno['lista'] = $lista;

        return response()->json($retorno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\caracteristicas_buses_base  $caracteristicas_buses_base
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, caracteristicas_buses_base $caracteristicas_buses_base)
    {
        $input =json_decode(file_get_contents('php://input'),true);


        $retorno = [];
        $retorno['status'] = false;


        if(!$request->has("id"))
        {
            $retorno['message'] = 'Ingrese el ID de la Caracteristica';
            return response()->json($retorno);
            exit;
        }

        if(!$request->has("nombre_caracteristica"))
        {
            $retorno['message'] = 'Ingrese nombre caracteristica';
            return response()->json($retorno);
            exit;
        }

        if(!$request->has("estado"))
        {
            $retorno['message'] = 'Seleccione estado';
            return response()->json($retorno);
            exit;
        }
        

        $caracteristicas_buses_base = caracteristicas_buses_base::find($input["id"]);
        $caracteristicas_buses_base->nombre_caracteristica = $input["nombre_caracteristica"];
        $caracteristicas_buses_base->estado  = $input["estado"];   
        $caracteristicas_buses_base->save();

        $retorno['status'] = true;

        $retorno['message'] = 'La caracteristica se actualizo correctamente';
        return response()->json($retorno);
    }

    public function updateV2(Request $request, caracteristicas_buses_base $item)
    {
        $input = request()->all();

        $retorno = [];
        $retorno['status'] = false;

        if(!$request->has("nombre_caracteristica"))
        {
            $retorno['message'] = 'Ingrese nombre caracteristica';
            return response()->json($retorno);
        }

        if(!$request->has("estado"))
        {
            $retorno['message'] = 'Seleccione estado';
            return response()->json($retorno);
        }
        

        $item->nombre_caracteristica = $input["nombre_caracteristica"];
        $item->estado  = $input["estado"];   
        $item->save();

        $retorno['status'] = true;
        $retorno['message'] = 'La caracteristica se actualizo correctamente';
        return response()->json($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\caracteristicas_buses_base  $caracteristicas_buses_base
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



        $usuarios = caracteristicas_buses_base::find($input["id"]);

        $usuarios->estado = 0;  
        $usuarios->save();

        $retorno['status'] = false;
        $retorno['message'] = 'La caracteristica se elimino correctamente';
        return response()->json($retorno);
    }

    public function delete(Request $request, caracteristicas_buses_base $item)
    {
        $retorno = [];
        $retorno['status'] = false;

        $item->estado = 0;  
        $item->save();

        $retorno['status'] = true;
        $retorno['message'] = 'La caracteristica se elimino correctamente';
        return response()->json($retorno);
    }
}
