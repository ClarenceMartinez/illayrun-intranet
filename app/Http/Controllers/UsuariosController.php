<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    
    const NAME_MODULE    = 'Usuarios';

    public function getInfo(){
        return response()->json(['status'=>true, 'data' => auth()->user()]);
    }

    public function find(Usuario $usuario){
        return response()->json($usuario);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if($req->input('estado') != "" && $req->input('desde') != "" && $req->input('hasta') != "" && $req->input('usuario') != "" && $req->input('tipo_usuario') != "")
        {
            $obj = Usuario::where("estado",$req->input('estado'))->where('created_at', '>=', $req->input("desde")." 00:00:00")->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('id',$req->input("usuario"))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') == "" && $req->input('hasta') == "" && $req->input('usuario') == "" && $req->input('tipo_usuario') == "")
        {

            $obj = Usuario::all();

        }else if($req->input('estado') == "" && $req->input('desde') == "" && $req->input('hasta') != "" && $req->input('usuario') == "" && $req->input('tipo_usuario') == "")
        {
            $obj = Usuario::where('updated_at', '<=', $req->input("hasta")." 23:59:59")->get();

        }else if($req->input('estado') == "" && $req->input('desde') != "" && $req->input('hasta') == "" && $req->input('usuario') == "" && $req->input('tipo_usuario') == "")
        {
            $obj = Usuario::where('created_at', '>=', $req->input("desde")." 00:00:00")->get();

        }else if($req->input('estado') != "" && $req->input('desde') == "" && $req->input('hasta') == "" && $req->input('usuario') == "" && $req->input('tipo_usuario') == "")
        {
            $obj = Usuario::where("estado",$req->input('estado'))->get();

        }else if($req->input('estado') == "" && $req->input('desde') == "" && $req->input('hasta') == "" && $req->input('usuario') != "" && $req->input('tipo_usuario') == ""){
            $obj = Usuario::where('id',$req->input("usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') == "" && $req->input('hasta') == "" && $req->input('usuario') == "" && $req->input('tipo_usuario') != "")
        {
            $obj = Usuario::where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') != "" && $req->input('hasta') == "" && $req->input('usuario') == "" && $req->input('tipo_usuario') == "")
        {
            $obj = Usuario::where("estado",$req->input('estado'))->where('created_at', '>=', $req->input("desde")." 00:00:00")->get();

        }else if($req->input('estado') != "" && $req->input('desde') == "" && $req->input('hasta') == "" && $req->input('usuario') != "" && $req->input('tipo_usuario') == "")
        {
            $obj = Usuario::where("estado",$req->input('estado'))->where('id',$req->input("usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') == "" && $req->input('hasta') == "" && $req->input('usuario') == "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') != "" && $req->input('hasta') == "" && $req->input('usuario') != "" && $req->input('tipo_usuario') == ""){
            $obj = Usuario::where('created_at', '>=', $req->input("desde")." 00:00:00")->where('id',$req->input("usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') != "" && $req->input('hasta') == "" && $req->input('usuario') == "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where('created_at', '>=', $req->input("desde")." 00:00:00")->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') == "" && $req->input('hasta') != "" && $req->input('usuario') != "" && $req->input('tipo_usuario') == ""){
            $obj = Usuario::where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('id',$req->input("usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') == "" && $req->input('hasta') != "" && $req->input('usuario') == "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') == "" && $req->input('hasta') == "" && $req->input('usuario') != "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where('id',$req->input("usuario"))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') != "" && $req->input('hasta') == "" && $req->input('usuario') != "" && $req->input('tipo_usuario') == ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('created_at', '>=', $req->input("desde")." 00:00:00")->where('id',$req->input("usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') != "" && $req->input('hasta') == "" && $req->input('usuario') == "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('created_at', '>=', $req->input("desde")." 00:00:00")->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') == "" && $req->input('hasta') != "" && $req->input('usuario') != "" && $req->input('tipo_usuario') == ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('id',$req->input("usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') == "" && $req->input('hasta') != "" && $req->input('usuario') == "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') == "" && $req->input('hasta') == "" && $req->input('usuario') != "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('id',$req->input("usuario"))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') != "" && $req->input('hasta') != "" && $req->input('usuario') != "" && $req->input('tipo_usuario') == ""){
            $obj = Usuario::where('created_at', '>=', $req->input("desde")." 00:00:00")->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('id',$req->input("usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') != "" && $req->input('hasta') != "" && $req->input('usuario') == "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where('created_at', '>=', $req->input("desde")." 00:00:00")->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') == "" && $req->input('hasta') != "" && $req->input('usuario') != "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('id',$req->input("usuario"))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') != "" && $req->input('hasta') == "" && $req->input('usuario') != "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where('created_at', '>=', $req->input("desde")." 00:00:00")->where('id',$req->input("usuario"))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') == "" && $req->input('desde') != "" && $req->input('hasta') != "" && $req->input('usuario') != "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where('created_at', '>=', $req->input("desde")." 00:00:00")->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('id',$req->input("usuario"))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') == "" && $req->input('hasta') != "" && $req->input('usuario') != "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('id',$req->input("usuario"))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') != "" && $req->input('hasta') == "" && $req->input('usuario') != "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('created_at', '>=', $req->input("desde")." 00:00:00")->where('id',$req->input("usuario"))->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') != "" && $req->input('hasta') != "" && $req->input('usuario') == "" && $req->input('tipo_usuario') != ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('created_at', '>=', $req->input("desde")." 00:00:00")->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('tipousuario_id',$req->input("tipo_usuario"))->get();

        }else if($req->input('estado') != "" && $req->input('desde') != "" && $req->input('hasta') != "" && $req->input('usuario') != "" && $req->input('tipo_usuario') == ""){
            $obj = Usuario::where("estado",$req->input('estado'))->where('created_at', '>=', $req->input("desde")." 00:00:00")->where('updated_at', '<=', $req->input("hasta")." 23:59:59")->where('id',$req->input("usuario"))->get();

        }else{

            $obj = Usuario::all();
        }

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

        $idLast = 0;
        // DB::beginTransaction();
        $retorno['message']    = 'Su ' . self::NAME_MODULE . ' se ha registrado satisfactoriamente.';
        $retorno['status']     = false;

        try
        {
            if (!$request->has("numerodocumento"))
            {
                $retorno['message']    = 'El campo Numero de Documento es requerido';
                return response()->json($retorno);
            }

            if (!$request->has("nombres"))
            {
                $retorno['message']    = 'Ingrese Nombre';
                return response()->json($retorno);
            }

            if (!$request->has("apellidos"))
            {
                $retorno['message']    = 'Ingrese Apellidos';
                return response()->json($retorno);
            }

            if (!$request->has("clave"))
            {
                $retorno['message']    = 'Ingrese clave';
                return response()->json($retorno);
            }

            if (!$request->has("tipousuario_id"))
            {
                $retorno['message']    = 'Ingrese tipousuario ';
                return response()->json($retorno);
            }

            if (!$request->has("email"))
            {
                $retorno['message']    = 'Ingrese email';
                return response()->json($retorno);
            }


            if (!$request->has("empresa"))
            {
                $retorno['message']    = 'Seleccione Empresa';
                $retorno['status']     = false;

                return response()->json($retorno);
            }


            if (!$request->has("sucursal"))
            {
                $retorno['message']    = 'Seleccione Sucursal';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

            $usuarios = new Usuario();
            $usuarios->nombres              = $request->input("nombres"); 
            $usuarios->apellidos            = $request->input("apellidos");
            $usuarios->clave                = $request->input("clave");
            $usuarios->tipousuario_id       = $request->input("tipousuario_id");
            $usuarios->email                = $request->input("email");
            // $usuarios->email_verified_at    = $request->input("email_verified_at");       
            $usuarios->estado               = 1;
            $usuarios->numerodocumento      = $request->input("numerodocumento"); 
            $usuarios->empresa              = $request->input("empresa");       
            $usuarios->codsucursal          = $request->input("sucursal");
            $usuarios->save();


            $retorno['status']     = true;
            return response()->json($retorno);
            exit;
        }
        catch (\Exception $e)
        {
            DB::rollback();
            $retorno['message']    = 'Ocurrio un problema por favor contacte con soporte';
            $retorno['status']     = false;
            return response()->json($retorno);
            exit;
        }




        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sucursales  $sucursales
     * @return \Illuminate\Http\Response
     */
    public function show(sucursales $sucursales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sucursales  $sucursales
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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

        $lista = Usuario::find($input["id"]);
        
        $retorno['status'] = true;
        $retorno['lista'] = $lista;

        return response()->json($retorno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sucursales  $sucursales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuarios)
    {
        //
        $input =json_decode(file_get_contents('php://input'),true);
        $retorno = [];
        
         if (!$request->has("id"))
        {
            $retorno['message']    = 'El campo ID es requerido';
            $retorno['status']     = false;

            return response()->json($retorno);
        }

        if (!$request->has("numerodocumento"))
            {
                $retorno['message']    = 'El campo Numero de Documento es requerido';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

            if (!$request->has("empresa"))
            {
                $retorno['message']    = 'Seleccione Empresa';
                $retorno['status']     = false;

                return response()->json($retorno);
            }


            if (!$request->has("sucursal"))
            {
                $retorno['message']    = 'Seleccione Sucursal';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

        $usuarios = Usuario::find($input["id"]);
        $usuarios->nombres = $input["nombres"]; 
        $usuarios->apellidos = $input["apellidos"];
        $usuarios->clave = $input["clave"];
        $usuarios->tipousuario_id = $input["tipousuario_id"];
        $usuarios->email = $input["email"];
        $usuarios->codsucursal = $input["sucursal"];
        $usuarios->email_verified_at = $input["email_verified_at"];       
        $usuarios->estado = $input["estado"];       
        $usuarios->save();

        $retorno['status'] = true;

        $retorno['message'] = 'El usuario se actualizo correctamente';
            return response()->json($retorno);
            exit;

    }

    public function updateV2(Request $request, Usuario $usuario)
    {
        //
        $input = request()->all();
        $retorno = [];

        if (!$request->has("numerodocumento"))
            {
                $retorno['message']    = 'El campo Numero de Documento es requerido';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

            if (!$request->has("empresa"))
            {
                $retorno['message']    = 'Seleccione Empresa';
                $retorno['status']     = false;

                return response()->json($retorno);
            }


            if (!$request->has("sucursal"))
            {
                $retorno['message']    = 'Seleccione Sucursal';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

        $usuario->nombres = $input["nombres"]; 
        $usuario->apellidos = $input["apellidos"];
        $usuario->clave = $input["clave"];
        $usuario->tipousuario_id = $input["tipousuario_id"];
        $usuario->email = $input["email"];
        $usuario->telefono = $input["telefono"];
        $usuario->fecha_nacimiento = $input["fecha_nacimiento"];
        $usuario->codsucursal = $input["sucursal"];
        $usuario->estado = $input["estado"];       
        $usuario->save();

        $retorno['status'] = true;
        $retorno['message'] = 'El usuario se actualizo correctamente';
        return response()->json($retorno);
    }

    public function updateProfile(){
        $params = request()->all();
        $usuario = auth()->user();

        $usuario->nombres = isset($params["nombres"]) ? $params['nombres'] : '';
        $usuario->apellidos = isset($params["apellidos"]) ? $params['apellidos'] : '';
        $usuario->email = isset($params["email"]) ? $params['email'] : '';
        $usuario->telefono = isset($params["telefono"]) ? $params['telefono'] : '';
        $usuario->fecha_nacimiento = isset($params["fecha_nacimiento"]) ? $params['fecha_nacimiento'] : '';
        $usuario->numerodocumento = isset($params["numerodocumento"]) ? $params['numerodocumento'] : '';

        $usuario->save();
        return response()->json(['status'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuarios)
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode( $inputJSON, TRUE );


        $usuarios = Usuario::find($input["id"]);
        // $usuarios->delete();

        $usuarios->estado = 0;  
        $usuarios->save();

        $retorno['status'] = true;

        $retorno['message'] = 'Se ha eliminado el usuario correctamente';
        return response()->json($retorno);
        exit;
        
    }

    public function delete(Usuario $usuario)
    {
        $retorno = [];
        $usuario->estado = 0;  
        $usuario->save();
        $retorno['status'] = true;
        $retorno['message'] = 'Se ha eliminado el usuario correctamente';
        return response()->json($retorno);
    }

    public function login(Request $request)
    {

        try
        {
            if (!$request->has("empresa_id"))
            {
                $retorno['message']    = 'empresa_id';
                $retorno['status']     = false;

                return response()->json($retorno);
            }


            if (!$request->has("sucursal_id"))
            {
                $retorno['message']    = 'sucursal_id';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

            if (!$request->has("usuario"))
            {
                $retorno['message']    = 'Ingrese usuario';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

            if (!$request->has("password"))
            {
                $retorno['message']    = 'Ingrese password';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

            $empresa        = $request->input('empresa_id');
            $codsucursal    = $request->input('sucursal_id');
            $numerodocumento= $request->input('usuario');
            $clave          = $request->input('password');

            $info = Usuario::where("estado", 1)->where('empresa', '=', $empresa)->where('codsucursal', '=', $codsucursal)->where('numerodocumento',$numerodocumento)->where('clave',$clave)->first();

            // echo '<pre>';
            // print_r($info);
            // echo '</pre>';
            if (!isset($info->id))
            {
                $retorno['message']    = 'El usuario y/o Password son Incorrectos';
                $retorno['status']     = false;

                return response()->json($retorno);
            }

            $info->tokens()->delete();
            
            $token = $info->createToken('token_fronted');
            $info->token = $token->plainTextToken;

            $retorno['status'] = true;
            $retorno['message'] = 'Datos correctos, bienvenidos';
            $retorno['usuario'] = $info;

            return response()->json($retorno);
        }
        catch (\Exception $e)
        {
            
        }
    }

    public function byempresa(Request $req)
    {
        

        $empresa = $req->input('empresa');
        $obj = Usuario::where("empresa", $empresa)->get();
       

        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;

        return response()->json($retorno);
    }
}
