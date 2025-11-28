<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SucursalesController extends Controller
{
    public function find(Sucursal $sucursal){
        return response()->json($sucursal);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $params = request()->all();
        $obj = Sucursal::with('departamento','provincia','distrito')->get();


        $retorno = [];

        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;
            return response()->json($retorno);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
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
        $empresa_id        = $input['empresa_id'];
        $nombre_comercial  = $input['nombre_comercial'];
        $tipo_documento    = $input['tipo_documento'];
        $numero_documento  = $input['numero_documento'];
        $razon_social      = $input['razon_social'];
        $telefono          = $input['telefono'];
        $direccion         = $input['direccion'];
        $email             = $input['email'];
        $departamento      = $input['departamento'];
        $provincia         = $input['provincia'];
        $distrito          = $input['distrito'];
        $latitud           = $input['latitud'];
        $longitud          = $input['longitud'];

        if($empresa_id == "")
        {
            $retorno['message'] = 'Por favor ingrese el id';
            return response()->json($retorno);
        }

        if($nombre_comercial == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre comercial';
            return response()->json($retorno);
        }

        if($tipo_documento == "")
        {
            $retorno['message'] = 'Por favor ingrese tipo de documento';
            return response()->json($retorno);
        }

        if($numero_documento == "")
        {
            $retorno['message'] = 'Por favor ingrese numero de documento';
            return response()->json($retorno);
        }

        if($razon_social == "")
        {
            $retorno['message'] = 'Por favor ingrese la razon social';
            return response()->json($retorno);
        }

        if($telefono == "")
        {
            $retorno['message'] = 'Por favor ingrese telefono';
            return response()->json($retorno);
        }

        if($direccion == "")
        {
            $retorno['message'] = 'Por favor ingrese direccion';
            return response()->json($retorno);
        }

        if($email == "")
        {
            $retorno['message'] = 'Por favor ingrese correo';
            return response()->json($retorno);
        }

        if($departamento == "")
        {
            $retorno['message'] = 'Por favor ingrese departamento';
            return response()->json($retorno);
        }

        if($provincia == "")
        {
            $retorno['message'] = 'Por favor ingrese id provincia';
            return response()->json($retorno);
        }

        if($distrito == "")
        {
            $retorno['message'] = 'Por favor ingrese id distrito';
            return response()->json($retorno);
        }

        if($latitud == "")
        {
            $retorno['message'] = 'Por favor ingrese latitud';
            return response()->json($retorno);
        }

        if($longitud == "")
        {
            $retorno['message'] = 'Por favor ingrese longitud';
            return response()->json($retorno);
        }

        $existeregistro = Sucursal::where("nombre_comercial", $nombre_comercial)->where('empresa_id', $empresa_id)->where("estado",1)->count();

        if($existeregistro > 0)

        {
           $retorno['message'] = "La sucursal ingresado ya existe";
           return response()->json($retorno);
           exit;
        }

        $existeregistro = Sucursal::where("nombre_comercial", $nombre_comercial)->where('empresa_id', $empresa_id)->where("estado",1)->count();

        if($existeregistro > 0)

        {
           $retorno['message'] = "La Sucursal ingresado ya existe";
           return response()->json($retorno);
           exit;
        }

        $obj =new Sucursal ();
        $obj->empresa_id        = $empresa_id;
        $obj->nombre_comercial  = strtoupper($nombre_comercial);
        $obj->tipo_documento    = $tipo_documento;
        $obj->numero_documento  = strtoupper($numero_documento);
        $obj->razon_social      = strtoupper($razon_social);
        $obj->telefono          = $telefono;
        $obj->direccion         = strtoupper($direccion);
        $obj->email             = strtoupper($email);
        $obj->departamento_id   = strtoupper($departamento);
        $obj->provincia_id      = strtoupper($provincia);
        $obj->distrito_id       = strtoupper($distrito);
        $obj->latitud           = $latitud;
        $obj->longitud          = $longitud;
        $obj->save();


        $retorno['status'] = true;

        $retorno['message'] = 'La sucursal se guardo correctamente';
            return response()->json($retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sucursales  $sucursal
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $params = request()->all();
        $retorno = [];
        $retorno['status']  = false;

        try {
            $obj = Sucursal::query();

            if(!isset($params['empresa_id']) && auth()->check() && auth()->user()->isadmin !== 1)
                $params['empresa_id'] = auth()->user()->empresa;

            if (isset($params["empresa_id"]) && $params["empresa_id"] > 0)
                $obj->where('empresa_id', $params["empresa_id"] );

            if (isset($params["nombre_comercial"]) && $params["nombre_comercial"] !== '')
                $obj->where('nombre_comercial', 'LIKE', '%' . $params["nombre_comercial"] . '%');

            if (isset($params["ruc"]) && $params["ruc"] !== '')
                $obj->where('numero_documento', 'LIKE', '%' . $params["ruc"] . '%');
            
            if (isset($params["estado"]) && $params["estado"] !== '')
                $obj->where('estado', $params['estado']);

            if(isset($params['with_relations']))
                $obj->with('departamento','provincia','distrito');

            $retorno = [];
            $retorno['TOTAL'] = $obj->count();
            $retorno['LISTA'] = $obj->get();

            return response()->json($retorno);


        } catch (\Exception $e) {
             DB::rollback();
            $retorno['message']    = 'Ocurrio un problema por favor contacte con soporte';
            $retorno['status']     = false;
            return response()->json($retorno);

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sucursales  $sucursal
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $retorno = [];
        $retorno['status']  = false;

        try {
            
            if (!$request->has("id"))
            {
                $retorno['message'] = 'Por favor ingrese empresa id';
                return response()->json($retorno);

            }
            $id = $request->input("id");
            

            $lista = Sucursal::where("id",$id)->get();

            $retorno['status'] = true;
            $retorno['lista'] = $lista;

            return response()->json($retorno);


        } catch (\Exception $e) {
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        //
        $input =json_decode(file_get_contents('php://input'),true);
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $id                = $input['id'];
        $empresa_id        = $input['empresa_id'];
        $nombre_comercial  = $input['nombre_comercial'];
        $tipo_documento    = $input['tipo_documento'];
        $numero_documento  = $input['numero_documento'];
        $razon_social      = $input['razon_social'];
        $telefono          = $input['telefono'];
        $direccion         = $input['direccion'];
        $email             = $input['email'];
        $departamento_id   = $input['departamento'];
        $provincia_id      = $input['distrito'];
        $distrito_id       = $input['distrito'];
        $latitud           = $input['latitud'];
        $longitud          = $input['longitud'];

        if($empresa_id == "")
        {
            $retorno['message'] = 'Por favor ingrese id empresa';
            return response()->json($retorno);
        }

        if($nombre_comercial == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre comercial';
            return response()->json($retorno);
        }

        if($tipo_documento == "")
        {
            $retorno['message'] = 'Por favor ingrese tipo documento';
            return response()->json($retorno);
        }

        if($numero_documento == "")
        {
            $retorno['message'] = 'Por favor ingrese numero documento';
            return response()->json($retorno);
        }

        if($razon_social == "")
        {
            $retorno['message'] = 'Por favor ingrese razon social';
            return response()->json($retorno);
        }

        if($telefono == "")
        {
            $retorno['message'] = 'Por favor ingrese telefono';
            return response()->json($retorno);
        }

        if($direccion == "")
        {
            $retorno['message'] = 'Por favor direccion';
            return response()->json($retorno);
        }

        if($email == "")
        {
            $retorno['message'] = 'Por favor ingrese email';
            return response()->json($retorno);
        }

        if($departamento_id == "")
        {
            $retorno['message'] = 'Por favor ingrese id departamento';
            return response()->json($retorno);
        }

        if($provincia_id == "")
        
        {
            $retorno['message'] = 'Por favor ingrese id provincia';
            return response()->json($retorno);
        }

        if($distrito_id == "")
        {
            $retorno['message'] = 'Por favor ingrese distrito';
            return response()->json($retorno);
        }

        if($latitud == "")
        {
            $retorno['message'] = 'Por favor ingrese latitud';
            return response()->json($retorno);
        }

        if($longitud == "")
        {
            $retorno['message'] = 'Por favor ingrese longitud';
            return response()->json($retorno);
        }

        $existeregistro = Sucursal::where("nombre_comercial", $nombre_comercial)->where("estado",1)->where("id", "!=",$id)->count();
        if($existeregistro > 0)

        {
           $retorno['message'] = "La sucursal ingresada ya existe";
           return response()->json($retorno);
        }
        
        $obj = Sucursal::find($id);
        $obj->empresa_id        = $empresa_id;
        $obj->nombre_comercial  = strtoupper($nombre_comercial);
        $obj->tipo_documento    = $tipo_documento;
        $obj->numero_documento  = strtoupper($numero_documento);
        $obj->razon_social      = strtoupper($razon_social);
        $obj->telefono          = $telefono;
        $obj->direccion         = strtoupper($direccion);
        $obj->email             = strtoupper($email);
        $obj->departamento_id   = $departamento_id;
        $obj->provincia_id      = $provincia_id;
        $obj->distrito_id       = $distrito_id;
        $obj->latitud           = $latitud;
        $obj->longitud          = $longitud;
        
        $obj->save();

        $retorno['status'] = true;

        $retorno['message'] = 'La sucursal se actualizo correctamente';
            return response()->json($retorno);
            
    }

    public function updateV2(Request $request, Sucursal $sucursal)
    {
        //
        $input = request()->all();
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $empresa_id        = $input['empresa_id'];
        $nombre_comercial  = $input['nombre_comercial'];
        $tipo_documento    = $input['tipo_documento'];
        $numero_documento  = $input['numero_documento'];
        $razon_social      = $input['razon_social'];
        $telefono          = $input['telefono'];
        $direccion         = $input['direccion'];
        $email             = $input['email'];
        $departamento_id   = $input['departamento'];
        $provincia_id      = $input['provincia'];
        $distrito_id       = $input['distrito'];
        $latitud           = $input['latitud'];
        $longitud          = $input['longitud'];

        if($empresa_id == "")
        {
            $retorno['message'] = 'Por favor ingrese id empresa';
            return response()->json($retorno);
        }

        if($nombre_comercial == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre comercial';
            return response()->json($retorno);
        }

        if($tipo_documento == "")
        {
            $retorno['message'] = 'Por favor ingrese tipo documento';
            return response()->json($retorno);
        }

        if($numero_documento == "")
        {
            $retorno['message'] = 'Por favor ingrese numero documento';
            return response()->json($retorno);
        }

        if($razon_social == "")
        {
            $retorno['message'] = 'Por favor ingrese razon social';
            return response()->json($retorno);
        }

        if($telefono == "")
        {
            $retorno['message'] = 'Por favor ingrese telefono';
            return response()->json($retorno);
        }

        if($direccion == "")
        {
            $retorno['message'] = 'Por favor direccion';
            return response()->json($retorno);
        }

        if($email == "")
        {
            $retorno['message'] = 'Por favor ingrese email';
            return response()->json($retorno);
        }

        if($departamento_id == "")
        {
            $retorno['message'] = 'Por favor ingrese id departamento';
            return response()->json($retorno);
        }

        if($provincia_id == "")
        
        {
            $retorno['message'] = 'Por favor ingrese id provincia';
            return response()->json($retorno);
        }

        if($distrito_id == "")
        {
            $retorno['message'] = 'Por favor ingrese distrito';
            return response()->json($retorno);
        }

        if($latitud == "")
        {
            $retorno['message'] = 'Por favor ingrese latitud';
            return response()->json($retorno);
        }

        if($longitud == "")
        {
            $retorno['message'] = 'Por favor ingrese longitud';
            return response()->json($retorno);
        }

        $existeregistro = Sucursal::where("nombre_comercial", $nombre_comercial)->where("estado",1)->where("id", "!=",$sucursal->id)->count();
        if($existeregistro > 0)

        {
           $retorno['message'] = "La sucursal ingresada ya existe";
           return response()->json($retorno);
        }
        
        $sucursal->empresa_id        = $empresa_id;
        $sucursal->nombre_comercial  = strtoupper($nombre_comercial);
        $sucursal->tipo_documento    = $tipo_documento;
        $sucursal->numero_documento  = strtoupper($numero_documento);
        $sucursal->razon_social      = strtoupper($razon_social);
        $sucursal->telefono          = $telefono;
        $sucursal->direccion         = strtoupper($direccion);
        $sucursal->email             = strtoupper($email);
        $sucursal->departamento_id   = $departamento_id;
        $sucursal->provincia_id      = $provincia_id;
        $sucursal->distrito_id       = $distrito_id;
        $sucursal->latitud           = $latitud;
        $sucursal->longitud          = $longitud;
        $sucursal->save();

        $retorno['status'] = true;
        $retorno['message'] = 'La sucursal se actualizo correctamente';
        return response()->json($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Sucursal $sucursal)
    {
          //
          $input =json_decode(file_get_contents('php://input'),true);
          // echo "store";
          $retorno = [];
          $retorno['status'] = false;
          $id                  = $input['id'];
          

          if($id == "")
          {
              $retorno['message'] = 'Por favor ingrese id';
              return response()->json($retorno);

          }


          $obj = Sucursal::find($id);
          $obj->estado = 0;
          $obj->update();
        // $obj->delete();

          $retorno['status'] = true;

          $retorno['message'] = 'La sucursal se elimino correctamente';
              return response()->json($retorno);


    }

    public function delete(Sucursal $sucursal)
    {
        $retorno = [];
        $retorno['status'] = false;

        $sucursal->estado = 0;
        $sucursal->update();

        $retorno['status'] = true;
        $retorno['message'] = 'La sucursal se elimino correctamente';
        return response()->json($retorno);
    }

        public function byEmpresa () 
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

            $lista = Sucursal::with('departamento','provincia','distrito')->where("empresa_id",$id)->get();

            // $retorno['status'] = true;
            // $retorno['lista'] = $lista;

            $retorno['TOTAL'] = count($lista);
            $retorno['LISTA'] = $lista;
            return response()->json($retorno);
        }
}