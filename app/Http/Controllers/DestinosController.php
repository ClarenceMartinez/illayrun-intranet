<?php

namespace App\Http\Controllers;

use App\Models\Destinos;
use Illuminate\Http\Request;

class DestinosController extends Controller
{
    public function find(Destinos $destino)
    {
        return response()->json($destino);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obj = Destinos::All();


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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = request()->all();
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $nombre              = $input['nombre'];
        $estado              = $input['estado'];
        $abrev               = $input['abrev'];

        if($nombre == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre';
            return response()->json($retorno);
        }

        if($abrev == "")
        {
            $retorno['message'] = 'Por favor ingrese la abrev';
            return response()->json($retorno);
        }

        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
        }

        $existeregistro = Destinos::where("nombre", $nombre)->where("estado",1)->count();

        if($existeregistro > 0)

        {
           $retorno['message'] = "El destino ingresado ya existe";
           echo json_encode($retorno);
           exit;
        }

        $obj = new Destinos();
        $obj->nombre             =strtoupper($nombre);
        $obj->abrev              =strtoupper($abrev);
        $obj->estado             =$estado;
        $obj->save();

        $retorno['status'] = true;

        $retorno['message'] = 'El destino se guardo correctamente';
        return response()->json($retorno);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destinos  $destinos
     * @return \Illuminate\Http\Response
     */
    public function show(Destinos $destinos)
    {
        //
        $obj = Destinos::All();


        $retorno = [];

        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;
            return response()->json($retorno);


    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\destinos  $destinos
     * @return \Illuminate\Http\Response
     */
    public function edit(Destinos $destinos)
    {
        $input =json_decode(file_get_contents('php://input'),true);
        $retorno = [];
        $retorno['status']  = false;
        $id                 = $input['id'];
        
        if ($id == "")
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
        }

        $lista = Destinos::where("id",$id)->get();

        $retorno['status'] = true;
        $retorno['lista'] = $lista;

        return response()->json($retorno);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destinos  $destinos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destinos $destinos)
    {
        //
        $input =json_decode(file_get_contents('php://input'),true);
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $nombre           = $input['nombre'];
        $abrev            = $input['abrev'];
        $estado           = $input['estado'];
        $id               = $input['id'];

        if($id == "")
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
        }
       

        if($nombre == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre';
            return response()->json($retorno);
        }

        if($abrev == "")
        {
            $retorno['message'] = 'Por favor ingrese el abrev';
            return response()->json($retorno);
        }

        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
        }

        $existeregistro = Destinos::where("nombre", $nombre)->where("estado",1)->where("id", "!=",$id)->count();
        if($existeregistro > 0)

        {
           $retorno['message'] = "El destino ingresada ya existe";
           echo json_encode($retorno);
           exit;
        }


        $obj = Destinos::find($id);
        $obj->nombre     = strtoupper($nombre);
        $obj->abrev      = strtoupper($abrev);
        $obj->estado     = $estado;
        $obj->save();

        $retorno['status'] = true;

        $retorno['message'] = 'El destino se actualizo correctamente';
            return response()->json($retorno);

    }

    public function updateV2(Request $request, Destinos $destino)
    {
        //
        $input = request()->all();
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $nombre           = $input['nombre'];
        $abrev            = $input['abrev'];
        $estado           = $input['estado'];
       
        if($nombre == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre';
            return response()->json($retorno);
        }

        if($abrev == "")
        {
            $retorno['message'] = 'Por favor ingrese el abrev';
            return response()->json($retorno);
        }

        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
        }

        $existeregistro = Destinos::where("nombre", $nombre)->where("estado",1)->where("id", "!=",$destino->id)->count();
        if($existeregistro > 0)

        {
           $retorno['message'] = "El destino ingresada ya existe";
           echo json_encode($retorno);
           exit;
        }

        $destino->nombre     = strtoupper($nombre);
        $destino->abrev      = strtoupper($abrev);
        $destino->estado     = $estado;
        $destino->save();
        $retorno['status'] = true;
        $retorno['message'] = 'El destino se actualizo correctamente';
        return response()->json($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destinos  $destinos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destinos $destinos)
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
        }


        $obj = Destinos::find($id);
        $obj->estado = 0;
        $obj->update();
        // $obj->delete();

        $retorno['status'] = true;

        $retorno['message'] = 'el destino se elimino correctamente';
            return response()->json($retorno);

    }

    public function delete(Destinos $destino)
    {
        $retorno = [];
        $retorno['status'] = false;

        $destino->estado = 0;
        $destino->update();

        $retorno['status'] = true;
        $retorno['message'] = 'el destino se elimino correctamente';
        return response()->json($retorno);
    }
}



