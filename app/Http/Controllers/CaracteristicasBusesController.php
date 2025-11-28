<?php

namespace App\Http\Controllers;

use App\Models\caracteristicas_buses;
use Illuminate\Http\Request;

class CaracteristicasBusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = caracteristicas_buses::all();
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


        if(!$request->has("id_buses"))
        {
            $retorno['message'] = 'Ingrese el ID del Bus';
            return response()->json($retorno);
            exit;
        }

        if(!$request->has("caracteristicas"))
        {
            $retorno['message'] = 'Ingrese el ID caracteristica del Bus';
            return response()->json($retorno);
            exit;
        }



        $id_buses                   = $input['id_buses'];
        $caracteristicas    = $input['caracteristicas'];

        if (count($caracteristicas))
        {

            $basex = caracteristicas_buses::where("id_buses", $input["id_buses"]);
            $basex->delete();

            foreach ($caracteristicas as $key => $caracteristica)
            {
                $caracteristicas_buses = new caracteristicas_buses();
                $caracteristicas_buses->id_buses = $input["id_buses"];
                $caracteristicas_buses->id_caracteristicas_base = $key;
                $caracteristicas_buses->estado = $caracteristica;
                $caracteristicas_buses->save();

            }
        }

        $retorno['status'] = true;
        $retorno['message'] = 'La caracteristica se guardo correctamente';
        return response()->json($retorno);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\caracteristicas_buses  $caracteristicas_buses
     * @return \Illuminate\Http\Response
     */
    public function show(caracteristicas_buses $caracteristicas_buses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\caracteristicas_buses  $caracteristicas_buses
     * @return \Illuminate\Http\Response
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
        $lista = caracteristicas_buses::find($input["id"]);


        $retorno['status'] = true;
        $retorno['lista'] = $lista;

        return response()->json($retorno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\caracteristicas_buses  $caracteristicas_buses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, caracteristicas_buses $caracteristicas_buses)
    {
        $input =json_decode(file_get_contents('php://input'),true);


        $retorno = [];
        $retorno['status'] = false;


        if(!$request->has("id_buses"))
        {
            $retorno['message'] = 'Ingrese el ID del Bus';
            return response()->json($retorno);
            exit;
        }

        if(!$request->has("caracteristicas"))
        {
            $retorno['message'] = 'Ingrese el ID caracteristica del Bus';
            return response()->json($retorno);
            exit;
        }



        $id_buses                   = $input['id_buses'];
        $caracteristicas    = $input['caracteristicas'];

        if (count($caracteristicas))
        {

            $basex = caracteristicas_buses::where("id_buses", $input["id_buses"]);
            $basex->delete();

            foreach ($caracteristicas as $key => $caracteristica)
            {
                $caracteristicas_buses = new caracteristicas_buses();
                $caracteristicas_buses->id_buses = $input["id_buses"];
                $caracteristicas_buses->id_caracteristicas_base = $key;
                $caracteristicas_buses->estado = 1;
                $caracteristicas_buses->save();

            }
        }

        $retorno['status'] = true;
        $retorno['message'] = 'La caracteristica se actualizo correctamente';
        return response()->json($retorno);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\caracteristicas_buses  $caracteristicas_buses
     * @return \Illuminate\Http\Response
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

        $usuarios = caracteristicas_buses::find($input["id"]);

        $usuarios->estado = 0;
        $usuarios->save();

        $retorno['status'] = true;
        $retorno['message'] = 'La caracteristica se elimino correctamente';
        return response()->json($retorno);

    }

    public function byBus(Request $request)
    {

        $bus_id         = $request->bus_id;

        $retorno = [];
        $retorno['status'] = false;


        if ($bus_id == "")
        {
            $retorno['message'] = 'Seleccione Bus';
            return response()->json($retorno);
        }

        $info = caracteristicas_buses::select('caracteristicas_buses.id', 'caracteristicas_buses_bases.nombre_caracteristica', 'id_buses', 'caracteristicas_buses.estado')->where("id_buses", $bus_id)->join('caracteristicas_buses_bases', 'caracteristicas_buses_bases.id', '=', 'caracteristicas_buses.id_caracteristicas_base')->get();


        $retorno['status'] = true;
        $retorno['lista'] = $info;

        return response()->json($retorno);
    }
}
