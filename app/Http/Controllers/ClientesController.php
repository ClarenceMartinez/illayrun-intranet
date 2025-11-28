<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Repos\ClienteRepo;
use Illuminate\Http\Request;
use App\Repos\ReniecRepo;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $obj = (new ClienteRepo)->filter(request()->all());
        $retorno = [];

        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;
        return response()->json($retorno);
    }

    public function byempresa(Request $request)
    {
        //
        $input =json_decode(file_get_contents('php://input'),true);
        $retorno = [];
        $retorno['status']  = false;
        $empresa_id                 = $input['empresa_id'];
        
        if ($empresa_id == "")
        {
            $retorno['message'] = 'Por favor ingrese empresa id';
            return response()->json($retorno);
            exit;
        }

        $obj = Clientes::where("empresa_id", $empresa_id)->get();


        $retorno = [];
        $retorno['status']  = true;
        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;
            return response()->json($retorno);
    }

    public function findV2(Clientes $cliente){
        return response()->json($cliente);
    }

    public function find(){
        $clienteRepo = new \App\Repos\ClienteRepo();
        $params = request()->all();
        $cliente = $clienteRepo->findByDocumento($params['empresa_id'], $params['tipo_documento'], $params['numero_documento']);
        
        // Si no existe y es DNI
        if($cliente == null && $params['tipo_documento'] == 1){
            $response = (new ReniecRepo)->find($params['numero_documento']);
            if(isset($response->nombre)){
                return response()->json(['nombres'=>$response->nombres, 'paterno'=>$response->apellidoPaterno, 'materno'=>$response->apellidoMaterno]);
            }
        }

        return $cliente == null ? response()->json(['error'=>'Cliente no encontrado'], 404) : response()->json($cliente);
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
        $retorno['status']  = false;
        $empresa_id         = $input['empresa_id'];
        $sucursal_id        = $input['sucursal_id'];
        $nombres             = $input['nombres'];
        $paterno             = $input['paterno'];
        $materno             = $input['materno'];
        $tipo_documento     = $input['tipo_documento'];
        $numero_documento   = $input['numero_documento'];
        $telefono           = $input['telefono'];
        $nacionalidad          = $input['nacionalidad'];
        $email              = $input['email'];
        $fecha_nacimiento= $input['fecha_nacimiento'];
        $estado             = 1;



        if($empresa_id == "")
        {
            $retorno['message'] = 'Por favor ingrese empresa id';
            return response()->json($retorno);
        }

        if($sucursal_id == "")
        {
            $retorno['message'] = 'Por favor ingrese sucursal id';
            return response()->json($retorno);
        }

        if($nombres == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre';
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


        if($telefono == "")
        {
            $retorno['message'] = 'Por favor ingrese telefono';
            return response()->json($retorno);
        }

        if($nacionalidad == "")
        {
            $retorno['message'] = 'Por favor ingrese la nacionalidad';
            return response()->json($retorno);
        }


        if($email == "")
        {
            $retorno['message'] = 'Por favor ingrese correo';
            return response()->json($retorno);
        }


        if($fecha_nacimiento == "")
        {
            $retorno['message'] = 'Por favor ingrese fecha de nacimiento';
            return response()->json($retorno);
        }


        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
        }

        $obj = new Clientes();
        $obj->empresa_id                = $empresa_id;
        $obj->sucursal_id               = $sucursal_id;
        $obj->nombres                    = strtoupper($nombres);
        $obj->paterno                    = strtoupper($paterno);
        $obj->materno                    = strtoupper($materno);
        $obj->tipo_documento            = $tipo_documento;
        $obj->numero_documento          = strtoupper($numero_documento);
        $obj->telefono                  = $telefono;
        $obj->nacionalidad                 = strtoupper($nacionalidad);
        $obj->email                     = strtoupper($email);
        $obj->fecha_nacimiento       = strtoupper($fecha_nacimiento);
        $obj->estado                    = $estado;
        $obj->save();

        $retorno['status'] = true;

        $retorno['message'] = ' cliente se guardo correctamente';
        return response()->json($retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
        // echo "show";

        $obj = Clientes::All();


        $retorno = [];

        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;

        return response()->json($retorno);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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



        $lista = Clientes::where("id",$id)->get();

        $retorno['status'] = true;
        $retorno['lista'] = $lista;

        return response()->json($retorno);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        $input =json_decode(file_get_contents('php://input'),true);
        // echo "store";
        $retorno = [];
        $retorno['status']  = false;
        $id                 = $input['id'];
        $empresa_id         = $input['empresa_id'];
        $sucursal_id        = $input['sucursal_id'];
        $nombre             = $input['nombre'];
        $tipo_documento     = $input['tipo_documento'];
        $numero_documento   = $input['numero_documento'];
        $telefono           = $input['telefono'];
        $direccion          = $input['direccion'];
        $email              = $input['email'];
        $fecha_de_nacimiento= $input['fecha_nacimiento'];
        $estado             = 1;

        if($id == "")
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
        }

        if($empresa_id == "")
        {
            $retorno['message'] = 'Por favor ingrese empresa id';
            return response()->json($retorno);
        }

        if($sucursal_id == "")
        {
            $retorno['message'] = 'Por favor ingrese sucursal id';
            return response()->json($retorno);
        }

        if($nombre == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre';
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


        if($fecha_de_nacimiento == "")
        {
            $retorno['message'] = 'Por favor ingrese fecha de nacimiento';
            return response()->json($retorno);
        }


        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
        }

        $existeregistro = clientes::where ("numero_documento", $numero_documento)->where("empresa_id", $empresa_id)->where("estado",)->count();

        if($existeregistro > 0)

        {
           $retorno['message'] = "El numero de documento ingresado ya existe";
           echo json_encode($retorno);
           exit;
        }

        $obj = Clientes::find($id);
        $obj->empresa_id                = strtoupper($empresa_id);
        $obj->sucursal_id               = strtoupper($sucursal_id);
        $obj->nombre                    = strtoupper($nombre);
        $obj->tipo_documento            = $tipo_documento;
        $obj->numero_documento          = strtoupper($numero_documento);
        $obj->telefono                  = $telefono;
        $obj->direccion                 = strtoupper($direccion);
        $obj->email                     = strtoupper($email);
        $obj->fecha_de_nacimiento       = strtoupper($fecha_de_nacimiento);
        $obj->estado                    = $estado;
        $obj->save();

        $retorno['status'] = true;
        $retorno['message'] = ' cliente se actualizo correctamente';

        return response()->json($retorno);

    }

    public function updateV2(Request $request, Clientes $clientes)
    {
        $input = request()->all();
        // echo "store";
        $retorno = [];
        $retorno['status']  = false;

        $empresa_id         = $input['empresa_id'];
        $sucursal_id        = $input['sucursal_id'];
        $nombre             = $input['nombre'];
        $tipo_documento     = $input['tipo_documento'];
        $numero_documento   = $input['numero_documento'];
        $telefono           = $input['telefono'];
        $direccion          = $input['direccion'];
        $email              = $input['email'];
        $fecha_de_nacimiento= $input['fecha_nacimiento'];
        $estado             = 1;

        if($empresa_id == "")
        {
            $retorno['message'] = 'Por favor ingrese empresa id';
            return response()->json($retorno);
        }

        if($sucursal_id == "")
        {
            $retorno['message'] = 'Por favor ingrese sucursal id';
            return response()->json($retorno);
        }

        if($nombre == "")
        {
            $retorno['message'] = 'Por favor ingrese nombre';
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


        if($fecha_de_nacimiento == "")
        {
            $retorno['message'] = 'Por favor ingrese fecha de nacimiento';
            return response()->json($retorno);
        }


        if($estado == "")
        {
            $retorno['message'] = 'Por favor ingrese estado';
            return response()->json($retorno);
        }

        $existeregistro = clientes::where ("numero_documento", $numero_documento)->where("empresa_id", $empresa_id)->where("estado",)->count();

        if($existeregistro > 0)

        {
           $retorno['message'] = "El numero de documento ingresado ya existe";
           echo json_encode($retorno);
           exit;
        }

        
        $clientes->empresa_id                = strtoupper($empresa_id);
        $clientes->sucursal_id               = strtoupper($sucursal_id);
        $clientes->nombre                    = strtoupper($nombre);
        $clientes->tipo_documento            = $tipo_documento;
        $clientes->numero_documento          = strtoupper($numero_documento);
        $clientes->telefono                  = $telefono;
        $clientes->direccion                 = strtoupper($direccion);
        $clientes->email                     = strtoupper($email);
        $clientes->fecha_de_nacimiento       = strtoupper($fecha_de_nacimiento);
        $clientes->estado                    = $estado;
        $clientes->save();

        $retorno['status'] = true;
        $retorno['message'] = ' cliente se actualizo correctamente';

        return response()->json($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
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


        $obj = Clientes::find($id);
        $obj->estado = 0;
        $obj->update();
        // $obj->delete();

        $retorno['status'] = true;

        $retorno['message'] = 'El cliente se elimino correctamente';
        return response()->json($retorno);

    }

    public function delete(Clientes $clientes)
    {
        $retorno = [];

        $clientes->estado = 0;
        $clientes->update();

        $retorno['status'] = true;
        $retorno['message'] = 'El cliente se elimino correctamente';

        return response()->json($retorno);
    }
}
