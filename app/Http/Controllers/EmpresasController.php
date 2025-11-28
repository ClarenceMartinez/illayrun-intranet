<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\Sucursal as Sucursales;
use App\Repos\EmpresaRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
{
    public function find(Empresas $empresa){
        return response()->json($empresa);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = Empresas::All();


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

        $input = request()->all();
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $nombre_comercial    = $input['nombre_comercial'];
        $tipo_documento      = $input['tipo_documento'];
        $numero_documento    = $input['numero_documento'];
        $razon_social        = $input['razon_social'];
        $direccion           = $input['direccion'];
        $telefono_1          = $input['telefono_1'];
        $telefono_2          = $input['telefono_2'];
        $email               = $input['email'];
        $pais                = $input['pais'];
        $estado              = $input['estado'];
        $tipo_membresia      = $input['tipo_membresia'];
        $monto_membresia     = $input['monto_membresia'];


        if($nombre_comercial == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre comercial';
            return response()->json($retorno);
            exit;
        }

        if($tipo_documento == "")
        {
            $retorno['message'] = 'Por favor ingrese tipo documento';
            return response()->json($retorno);
            exit;
        }

        if($numero_documento == "")
        {
            $retorno['message'] = 'Por favor ingrese numero documento';
            return response()->json($retorno);
            exit;
        }


        if($razon_social == "")
        {
            $retorno['message'] = 'Por favor ingrese razon social';
            return response()->json($retorno);
            exit;
        }


        if($direccion == "")
        {
            $retorno['message'] = 'Por favor ingrese direccion';
            return response()->json($retorno);
            exit;
        }

        if($telefono_1 == "")
        {
            $retorno['message'] = 'Por favor ingrese telefono';
            return response()->json($retorno);
            exit;
        }

        if($email == "")
        {
            $retorno['message'] = 'Por favor ingrese correo';
            return response()->json($retorno);
            exit;
        }


        if($pais == "")
        {
            $retorno['message'] = 'Por favor ingrese pais';
            return response()->json($retorno);
            exit;
        }


        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
            exit;
        }

        if($tipo_membresia == "")
        {
            $retorno['message'] = 'Por favor ingrese membresia';
            return response()->json($retorno);
            exit;
        }

        if($monto_membresia == "")
        {
            $retorno['message'] = 'Por favor ingrese monto membresia';
            return response()->json($retorno);
            exit;
        }


        $existeregistro = Empresas::where("numero_documento", $numero_documento)->where("estado",1)->count();

        if($existeregistro > 0)

        {
           $retorno['message'] = "La empresa ingresado ya existe";
           return response()->json($retorno);
           exit;
        }

        $obj = new Empresas();
        $obj->nombre_comercial   = strtoupper($nombre_comercial);
        $obj->tipo_documento     = $tipo_documento;
        $obj->numero_documento   = strtoupper($numero_documento);
        $obj->razon_social       = strtoupper($razon_social);
        $obj->direccion          = strtoupper($direccion);
        $obj->telefono_1         = $telefono_1;
        $obj->telefono_2         = $telefono_2;
        $obj->email              = strtoupper($email);
        $obj->pais               = strtoupper($pais);
        $obj->estado             = $estado;
        $obj->tipo_membresia     = $tipo_membresia;
        $obj->monto_membresia    = $monto_membresia;
        $obj->save();

        $retorno['status'] = true;

        $retorno['message'] = 'La empresa se guardo correctamente';
            return response()->json($retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $retorno = [];
        $retorno['status']  = false;

        try {
            $obj = (new EmpresaRepo)->search(request()->all());

            $retorno = [];

            $retorno['TOTAL'] = count($obj);
            $retorno['LISTA'] = $obj;

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
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
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


            $lista = Empresas::where("id",$id)->get();

            $retorno['status'] = true;
            $retorno['lista'] = $lista;

            return response()->json($retorno);


        } catch (\Exception $e) {
            DB::rollback();
            $retorno['message']    = 'Ocurrio un problema por favor contacte con soporte';
            $retorno['status']     = false;
            return response()->json($retorno);
            exit;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Empresas $empresas)
    {
        try {
            $input = request()->all();
            $nombre_comercial    = $input['nombre_comercial'];
            $tipo_documento      = $input['tipo_documento'];
            $numero_documento    = $input['numero_documento'];
            $razon_social        = $input['razon_social'];
            $direccion           = $input['direccion'];
            $telefono_1          = $input['telefono_1'];
            $telefono_2          = $input['telefono_2'];
            $email               = $input['email'];
            $pais                = $input['pais'];
            $estado              = $input['estado'];
            $tipo_membresia      = $input['tipo_membresia'];
            $monto_membresia     = $input['monto_membresia'];

            if($nombre_comercial == "")
                throw new \Exception("Por favor ingrese nombre comercial");
    
            if($tipo_documento == "")
                throw new \Exception("Por favor ingrese tipo de documento");

            if($numero_documento == "")
                throw new \Exception('Por favor ingrese numero documento');
    
            if($razon_social == "")
                throw new \Exception('Por favor ingrese razon social');
    
            if($direccion == "")
                throw new \Exception('Por favor ingrese direccion');
    
            if($telefono_1 == "")
                throw new \Exception('Por favor ingrese telefono');

    
            if($email == "")
                throw new \Exception('Por favor ingrese correo');
    
            if($pais == "")
                throw new \Exception('Por favor ingrese pais');
    
            if($estado == "")
                throw new \Exception('Por favor ingrese estado');
    
            if($tipo_membresia == "")
                throw new \Exception('Por favor ingrese membresia');
    
            if($monto_membresia == "")
                throw new \Exception('Por favor ingrese monto membresia');

            $existeregistro = Empresas::where("numero_documento", $numero_documento)->where("estado",1)->where("id", "!=",$empresas->id)->count();
            
            if($existeregistro > 0)
                throw new \Exception('La empresa ingresada ya existe');    
    
            $empresas->nombre_comercial   = strtoupper($nombre_comercial);
            $empresas->tipo_documento     = $tipo_documento;
            $empresas->numero_documento   = strtoupper($numero_documento);
            $empresas->razon_social       = strtoupper($razon_social);
            $empresas->direccion          = strtoupper($direccion);
            $empresas->telefono_1         = $telefono_1;
            $empresas->telefono_2         = $telefono_2;
            $empresas->email              = strtoupper($email);
            $empresas->pais               = strtoupper($pais);
            $empresas->estado             = $estado;
            $empresas->tipo_membresia     = $tipo_membresia;
            $empresas->monto_membresia    = $monto_membresia;
            $empresas->save();
    
            $retorno['status'] = true;
            $retorno['message'] = 'La empresa se actualizo correctamente';

            return response()->json($retorno);

        } catch (\Exception $e) {
            return response()->json(['status'=>false, 'message'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\JsonResponse
     */

    public function delete(Empresas $empresas){
        $empresas->estado = 0;
        $empresas->update();

        return response()->json(['status'=>true, 'message'=>'La empresa se elimino correctamente']);
    }
    public function destroy(Empresas $empresas)
    {
        //
        $input = request()->all();
        // echo "store";
        $retorno = [];
        $retorno['status'] = false;
        $id                  = $input['id'];


        if($id == "")
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
            exit;
        }


        $obj = Empresas::find($id);
        $obj->estado = 0;
        $obj->update();
        // $obj->delete();

        $retorno['status'] = true;

        $retorno['message'] = 'La empresa se elimino correctamente';
            return response()->json($retorno);
            exit;

    }

    public function verifica(Request $request)
    {
        $retorno = [];
        $retorno['status'] = false;

        try
        {
            if (!$request->has("rucalias"))
            {
                $retorno['message'] = 'Por favor ingrese RUC o ALIAS';
                return response()->json($retorno);
            }

            $rucalias = $request->input('rucalias');
            $existeregistro = Empresas::where("numero_documento", $rucalias)->where("estado",1)->get();

            if(count($existeregistro) == 0)

            {
               $retorno['message'] = "La empresa ingresada no existe";
               return response()->json($retorno);
               exit;
            }

            $empresa_id     = $existeregistro[0]->id;
            $objSucursales  = new Sucursales();

            $info = $objSucursales->obtenerSucursalesActivasByEmpresa($empresa_id);
                if (count($info) > 0)
            {
                foreach ($info as $sucursales)
                {

                }
            }
            $retorno['status'] = true;
            $retorno['empresa_id']          = $empresa_id;
            $retorno['sucursales']['TOTAL'] = count($info);
            $retorno['sucursales']['LISTA'] = $info;
            $retorno['message'] = "Sucursales Activas";
            return response()->json($retorno);




                // $nombre_comercial   = $request->input("rucalias");
                // $obj                = $obj->where('nombre_comercial','like',  '%' . $nombre_comercial . '%' );
        }
        catch (\Exception $e)
        {

        }
    }
}
