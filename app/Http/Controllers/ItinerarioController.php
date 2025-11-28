<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItinerarioRequest;
use App\Http\Requests\UpdateItinerarioRequest;
use App\Models\Itinerario;
use Illuminate\Http\Request;

class ItinerarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $empresa_id     = $request->input('empresa_id');

        $retorno = [];
        $retorno['status'] = false;
        if ($empresa_id == "")
        {
            $retorno['message'] = 'Seleccione Empresa';
            return response()->json($retorno);
        }


        // $itinerario = Itinerario::all();
        $itinerario = Itinerario::where('empresa_id', $empresa_id);

        $retorno['TOTAL'] = $itinerario->count();
        $retorno['LISTA'] = $itinerario->get();
        $retorno['status'] = true;

        return response()->json($retorno);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function busqueda(Request $request)
    {
        $empresa_id     = $request->input('empresa_id');
        $sucursal_id    = $request->sucursal_id;
        $desde          = $request->desde;
        $hasta          = $request->hasta;
        $empresa_id     = $request->empresa_id;
        $estado         = trim($request->estado);

        $retorno = [];
        $retorno['status'] = false;

        $itinerario = Itinerario::query();

        if($empresa_id > 0)
            $itinerario->where('empresa_id', $empresa_id);

        if ($estado != '')
        {
            $itinerario = $itinerario->where('estado', $estado);
        }

        if ($sucursal_id > 0)
        {
            $itinerario = $itinerario->where('sucursal_id', $sucursal_id);
        }

        if (request()->has('sucursal_destino') && request()->input('sucursal_destino')  !== '')
        {
            $itinerario = $itinerario->where('sucursal_destino', request()->input('sucursal_destino'));
        }

        if (request()->has('sucursal_partida') && request()->input('sucursal_partida')  !== '')
        {
            $itinerario = $itinerario->where('sucursal_partida', request()->input('sucursal_partida'));
        }

        if ($desde != '')
        {
            $itinerario = $itinerario->where('fecha_partida','>=', $desde);
        }

        if ($hasta != '')
        {
            $itinerario = $itinerario->where('fecha_llegada','<=', $hasta);
        }



        $total      = $itinerario->count();
        $itinerario  = $itinerario->with(['bus'=>function($query){
            $query->select('id', 'placa', 'marca');
        }, 'origen', 'destino'])->get();

        $retorno['TOTAL'] = $total;
        $retorno['LISTA'] = $itinerario;
        $retorno['status'] = true;

        return response()->json($retorno);
    }

    public function index_empresa()
    {
        $input =json_decode(file_get_contents('php://input'),true);
         $obj_empresa = Itinerario::where("empresa_id",$input["empresa_id"])->get();
        return response()->json($obj_empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_sucursal()
    {
        $input =json_decode(file_get_contents('php://input'),true);
       $obj_empresa = Itinerario::where("sucursal_id",$input["sucursal_id"])->get();
        return response()->json($obj_empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_bus()
    {
        $input =json_decode(file_get_contents('php://input'),true);
       $obj_empresa = Itinerario::where("id_bus",$input["id_bus"])->get();
        return response()->json($obj_empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_chofer()
    {
        $input =json_decode(file_get_contents('php://input'),true);
       $obj_empresa = Itinerario::where("id_chofer",$input["id_chofer"])->get();
        return response()->json($obj_empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_chofer2()
    {
        $input =json_decode(file_get_contents('php://input'),true);
       $obj_empresa = Itinerario::where("id_chofer2",$input["id_chofer2"])->get();
        return response()->json($obj_empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index_terramoza()
    {
        $input =json_decode(file_get_contents('php://input'),true);
       $obj_empresa = Itinerario::where("id_terramoza",$input["id_terramoza"])->get();
        return response()->json($obj_empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_asiento()
    {
        $input =json_decode(file_get_contents('php://input'),true);
       $obj_empresa = Itinerario::where("id_asiento",$input["id_asiento"])->get();
        return response()->json($obj_empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_cliente()
    {
        $input =json_decode(file_get_contents('php://input'),true);
       $obj_empresa = Itinerario::where("id_cliente",$input["id_cliente"])->get();
        return response()->json($obj_empresa);
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
     * @param  CreateItinerarioRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateItinerarioRequest $request)
    {
        try {
            $params = $request->validated();
            $params['estado'] = 1;
            Itinerario::create($params);
            $retorno = [];
            $retorno['status'] = true;
            $retorno['message'] = 'El Itinerario se guardo correctamente';
            return response()->json($retorno);
        } catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status'=>false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Itinerario  $itinerario
     * @return \Illuminate\Http\Response
     */
    public function show(Itinerario $itinerario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Itinerario  $itinerario
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $input =json_decode(file_get_contents('php://input'),true);
        $retorno = [];
        $retorno['status']  = false;

        try {

            if (!$request->has("id"))
            {
                $retorno['message'] = 'Por favor ingrese empresa id';
                return response()->json($retorno);

            }
            $id = $request->input("id");


            $lista = Itinerario::with('embarques')->where("id",$id)->get();

            $retorno['status'] = true;
            $retorno['lista'] = $lista;

            return response()->json($retorno);


        } catch (\Exception $e) {
            DB::rollback();
            $retorno['message']    = 'Ocurrio un problema por favor contacte con soporte';
            $retorno['status']     = false;
            return response()->json($retorno);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Itinerario  $itinerario
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateItinerarioRequest $request, Itinerario $itinerario)
    {
        try {
            $params = $request->validated();
            $id = $params['id'];
            unset($params['id']);
            Itinerario::where('id', $id)->update($params);
            $retorno['status'] = true;
            $retorno['message'] = 'El Itinerario se actualizo correctamente';
            return response()->json($retorno);
        } catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status'=>false]);
        }



        $input =json_decode(file_get_contents('php://input'),true);


        $retorno            = [];
        $retorno['status']  = false;

        if(!$request->has("id"))
        {
            $retorno['message'] = 'Ingrese ID';
            return response()->json($retorno);
        }

        if(!$request->has("empresa_id"))
        {
            $retorno['message'] = 'Seleccione Empresa';
            return response()->json($retorno);
        }

        if(!$request->has("sucursal_id"))
        {
            $retorno['message'] = 'Seleccione sucursal';
            return response()->json($retorno);
        }

        if(!$request->has("bus_id"))
        {
            $retorno['message'] = 'Seleccione bus';
            return response()->json($retorno);
        }

        if(!$request->has("chofer_id"))
        {
            $retorno['message'] = 'Seleccione chofer';
            return response()->json($retorno);
        }


        if(!$request->has("chofer2_id"))
        {
            $retorno['message'] = 'Seleccione chofer';
            return response()->json($retorno);
        }

        if(!$request->has("terramoza_id"))
        {
            $retorno['message'] = 'Seleccione Terramoza';
            return response()->json($retorno);
        }

        if(!$request->has("terramoza2_id"))
        {
            $retorno['message'] = 'Seleccione Terramoza';
            return response()->json($retorno);
        }

         if(!$request->has("fecha_partida"))
        {
            $retorno['message'] = 'Seleccione Fecha Salida';
            return response()->json($retorno);
        }

        if(!$request->has("fecha_llegada"))
        {
            $retorno['message'] = 'Seleccione Fecha Llegada';
            return response()->json($retorno);
        }

        if(!$request->has("hora_partida"))
        {
            $retorno['message'] = 'Seleccione Hora Partida';
            return response()->json($retorno);
        }

        if(!$request->has("hora_llegada"))
        {
            $retorno['message'] = 'Seleccione Hora Llegada';
            return response()->json($retorno);
        }

        if(!$request->has("destino_id"))
        {
            $retorno['message'] = 'Seleccione Destino';
            return response()->json($retorno);
        }

        if(!$request->has("origen_id"))
        {
            $retorno['message'] = 'Seleccione Origen';
            return response()->json($retorno);
        }

        if(!$request->has("usuario_id"))
        {
            $retorno['message'] = 'Seleccione Usuario que procesa la operación';
            return response()->json($retorno);
        }


        if(!$request->has("sucursal_partida"))
        {
            $retorno['message'] = 'Seleccione Lugar de Partida';
            return response()->json($retorno);
        }

        if(!$request->has("sucursal_destino"))
        {
            $retorno['message'] = 'Seleccione Lugar de Llegada';
            return response()->json($retorno);
        }

        if(!$request->has("estado"))
        {
            $retorno['message'] = 'Seleccione estado';
            return response()->json($retorno);
        }






        $id                 = $request->input("id");
        $empresa_id         = $request->input("empresa_id");
        $sucursal_id        = $request->input("sucursal_id");
        $bus_id             = $request->input("bus_id");
        $chofer_id          = $request->input("chofer_id");
        $chofer2_id         = $request->input("chofer2_id");
        $terramoza_id       = $request->input("terramoza_id");
        $terramoza2_id      = $request->input("terramoza2_id");
        $fecha_partida      = $request->input("fecha_partida");
        $fecha_llegada      = $request->input("fecha_llegada");
        $usuario_id         = $request->input("usuario_id");
        $destino_id         = $request->input("destino_id");
        $sucursal_partida         = $request->input("sucursal_partida");
        $sucursal_destino         = $request->input("sucursal_destino");
        $estado                   = $request->input("estado");
        $origen_id                = $request->input("origen_id");
        $hora_partida             = $request->input("hora_partida");
        $hora_llegada             = $request->input("hora_llegada");

        if ($id == "")
        {
            $retorno['message'] = 'Ingrese ID';
            return response()->json($retorno);
        }

        if ($empresa_id == "")
        {
            $retorno['message'] = 'Seleccione Empresa';
            return response()->json($retorno);
        }


        if($sucursal_id== "")
        {
            $retorno['message'] = 'Seleccione sucursal';
            return response()->json($retorno);
        }

        if($bus_id == "")
        {
            $retorno['message'] = 'Seleccione bus';
            return response()->json($retorno);
        }

        if($chofer_id == "")
        {
            $retorno['message'] = 'Seleccione chofer';
            return response()->json($retorno);
        }


        if($chofer2_id != 0)
        {
            $retorno['message'] = 'Seleccione chofer 2';
            return response()->json($retorno);
        }

        if($terramoza_id == "")
        {
            $retorno['message'] = 'Seleccione Terramoza';
            return response()->json($retorno);
        }

        if($terramoza2_id == "")
        {
            $retorno['message'] = 'Seleccione Terramoza 2';
            return response()->json($retorno);
        }

         if($fecha_partida == "")
        {
            $retorno['message'] = 'Seleccione Fecha Salida';
            return response()->json($retorno);
        }

        if($fecha_llegada == "")
        {
            $retorno['message'] = 'Seleccione Fecha Llegada';
            return response()->json($retorno);
        }

        if($destino_id == "")
        {
            $retorno['message'] = 'Seleccione Destino';
            return response()->json($retorno);
        }

        if($usuario_id == "")
        {
            $retorno['message'] = 'Seleccione Usuario que procesa la operación';
            return response()->json($retorno);
        }


        if($sucursal_partida == "")
        {
            $retorno['message'] = 'Seleccione Lugar de Partida';
            return response()->json($retorno);
        }

        if($sucursal_destino == "")
        {
            $retorno['message'] = 'Seleccione Lugar de Llegada';
            return response()->json($retorno);
        }




        $rutas                      = Itinerario::find($id);
        $rutas->empresa_id          = $empresa_id;
        $rutas->sucursal_id         = $sucursal_id;
        $rutas->bus_id              = $bus_id;
        $rutas->chofer_id           = $chofer_id;
        $rutas->chofer2_id          = $chofer2_id;
        $rutas->terramoza_id        = $terramoza_id;
        $rutas->terramoza2_id       = $terramoza2_id;
        $rutas->fecha_partida       = $fecha_partida;
        $rutas->fecha_llegada       = $fecha_llegada;
        $rutas->destino_id          = $destino_id;
        $rutas->usuario_id          = $usuario_id;
        $rutas->sucursal_partida    = $sucursal_partida;
        $rutas->sucursal_destino    = $sucursal_destino;
        $rutas->estado              = $estado;
        $rutas->origen_id              = $origen_id;
        $rutas->hora_partida              = $hora_partida;
        $rutas->hora_llegada              = $hora_llegada;

        $rutas->save();

        $retorno['status'] = true;
        $retorno['message'] = 'El Itinerario se actualizo correctamente';
        return response()->json($retorno);
    }

    public function updateV2(UpdateItinerarioRequest $request, Itinerario $itinerario)
    {
        try {
            $params = $request->validated();
            $id = $params['id'];
            unset($params['id']);
            $itinerario->fill($params);
            $itinerario->save();
            $retorno['status'] = true;
            $retorno['message'] = 'El Itinerario se actualizo correctamente';
            return response()->json($retorno);
        } catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itinerario  $itinerario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode( $inputJSON, TRUE );

        $retorno            = [];
        $retorno['status']  = false;

        if(!$request->has("id"))
        {
            $retorno['message'] = 'Ingrese ID';
            return response()->json($retorno);
        }

        $id                 = $request->input("id");

        if ($id == "")
        {
            $retorno['message'] = 'Ingrese ID';
            return response()->json($retorno);
        }

        $usuarios = Itinerario::find($id);
        // $usuarios->delete();

        $usuarios->estado = 0;
        $usuarios->save();

        $retorno['status'] = true;

        $retorno['message'] = 'El Itinerario se elimino correctamente';
        return response()->json($retorno);
    }

    public function delete(Request $request, Itinerario $itinerario)
    {
        $itinerario->estado = 0;
        $itinerario->save();
        
        $retorno['status'] = true;
        $retorno['message'] = 'El Itinerario se elimino correctamente';
        return response()->json($retorno);
    }

    public function getAsientos(Itinerario $itinerario){
        $repo = new \App\Repos\ItinerarioRepo();
        return response()->json($repo->getAsientos($itinerario));
    }

    public function getManifiestoPasajeros(Itinerario $itinerario){
        $repo = new \App\Repos\ItinerarioRepo();
        return response()->json($repo->getManifiestoPasajeros($itinerario));
    }

    public function getManifiestoPtoVenta(Itinerario $itinerario){
        $repo = new \App\Repos\ItinerarioRepo();
        return response()->json($repo->getManifiestoPtoVenta($itinerario));
    }

    public function getCroquis(Itinerario $itinerario){
        $repo = new \App\Repos\ItinerarioRepo();
        return response()->json(['asientos'=>$repo->getCroquis($itinerario), 'itinerario'=>$itinerario->load('origen','destino','bus','sucursal')]);
    }

    public function getManifiestoEncomiendas(Itinerario $itinerario){
        $repo = new \App\Repos\ItinerarioRepo();
        return response()->json($repo->getManifiestoEncomiendas($itinerario));
    }
}
