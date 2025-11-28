<?php

namespace App\Http\Controllers;

use App\Models\asientos;
use Illuminate\Http\Request;

class AsientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $params = request()->all();

        //
        $obj = Asientos::query();

        if (isset($params['bus_id']) && $params['bus_id'] > 0)
            $obj->ofBus($params['bus_id']);

        $obj = $obj->get();

        $retorno = [];

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
        //

        $input =json_decode(file_get_contents('php://input'),true);
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $bus_id              = $input['bus_id'];
        $numero              = $input['numero'];
        $estado              = $input['estado'];

        if($bus_id == "")
        {
            $retorno['message'] = 'Por favor ingrese bus id';
            return response()->json($retorno);
            exit;
        }

        if($numero == "")
        {
            $retorno['message'] = 'Por favor ingrese numero';
            return response()->json($retorno);
            exit;
        }


        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
            exit;
        }

        $existeregistro = Asientos::where("bus_id", $bus_id)->where("numero", $numero)->where("estado",1)->count();

        if($existeregistro > 0)

        {
           $retorno['message'] = "El asiento ingresado ya existe";
           return response()->json($retorno);
           exit;
        }

        $obj = new Asientos();
        $obj->bus_id             =$bus_id;
        $obj->numero             =strtoupper($numero);
        $obj->estado             =$estado;
        $obj->save();

        $retorno['status'] = true;

        $retorno['message'] = 'El asiento se guardo correctamente';
        return response()->json($retorno);
        exit;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asientos  $destinos
     * @return \Illuminate\Http\Response
     */
    public function show(Asientos $asientos)
    {
        //
        $obj = Asientos::All();


        $retorno = [];

        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;
            return response()->json($retorno);
            exit;


    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asientos  $asientos
     * @return \Illuminate\Http\Response
     */
    public function edit(Asientos $asientos)
    {

        //

        $input =json_decode(file_get_contents('php://input'),true);
        $retorno = [];
        $retorno['status']  = false;
        $id                 = $input['id'];

        if ($id == "")
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
            exit;
        }



        $lista = Asientos::where("id",$id)->get();

            $retorno['status'] = true;
            $retorno['lista'] = $lista;

            return response()->json($retorno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asientos  $asientos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asientos $asientos)
    {
        //
        $input =json_decode(file_get_contents('php://input'),true);
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $id               = $input['id'];
        $bus_id           = $input['bus_id'];
        $numero           = $input['numero'];
        $estado           = $input['estado'];


        if($id == "")
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
            exit;
        }

        if($bus_id == "")
        {
            $retorno['message'] = 'Por favor ingrese bus id';
            return response()->json($retorno);
            exit;
        }


        if($numero == "")
        {
            $retorno['message'] = 'Por favor ingrese numero';
            return response()->json($retorno);
            exit;
        }


        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
            exit;
        }

        $existeregistro = Asientos::where("id", "!=",$id)->where("bus_id", $bus_id)->where("numero", $numero)->where("estado",1)->count();
        if($existeregistro > 0)

        {
           $retorno['message'] = "El asiento ingresado ya existe";
           return response()->json($retorno);
           exit;
        }


        $obj = Asientos::find($id);
        $obj = Asientos::find($id);

        if(isset($obj->estado) and !empty($obj->estado))
        {
        $obj->estado = 0;
        $obj->update();
        }

        $obj->id         = $id;
        $obj->bus_id     = $bus_id;
        $obj->numero     = strtoupper($numero);
        $obj->estado     = $estado;
        $obj->save();


        $retorno['status'] = true;

        $retorno['message'] = 'El asiento se actualizo correctamente';
            return response()->json($retorno);
            exit;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asientos  $asientos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asientos $asientos)
    {
        //
        $input =json_decode(file_get_contents('php://input'),true);
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $id                = $input['id'];


        if($id == "")
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
            exit;
        }


        $obj = Asientos::find($id);
        if(isset($obj->estado) and !empty($obj->estado))
        {
        $obj->estado = 0;
        $obj->update();

        }

        $retorno['status'] = true;

        $retorno['message'] = 'el asiento se elimino correctamente';
            return response()->json($retorno);
            exit;
    }
}


