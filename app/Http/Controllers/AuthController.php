<?php namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function login(){
        try {
            $retorno = [];
            $params = request()->all();

            $usuario = Usuario::where("estado", 1)->where('empresa', $params['empresa_id'])->where('codsucursal', $params['sucursal_id'])->where('numerodocumento', $params['usuario'])->where('clave', $params['password'])->first();

            if($usuario == null)
                throw new \Exception("El usuario y/o contraseña son incorrectos");


            $retorno['status'] = true;
            $retorno['message'] = 'Datos correctos, bienvenidos';
            Auth::login($usuario);
            
            return response()->json($retorno);

        } catch (\Exception $e) {
            return response()->json(['status'=>false, 'message' => $e->getMessage()]);
        }
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }

}