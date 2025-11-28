<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SunatController extends Controller
{
    public function consulta(Request $request)
    {
       	try
       	{

			$json 				= [];
			$json['status'] 	= false;
			$json['mesage'] 	= 'Este RUC no existe en la SUNAT';
       		if (!$request->has("numero"))
       		{
       			return response()->json($json);
       		}

        	$numero = $request->input("numero");
        	$ruta = "https://api.apis.net.pe/v1/ruc?numero=".$numero;
			$consulta 			= file_get_contents($ruta);

	        // $ruta 	= config('const.api_sunat') . '?numero='.$numero;
	        // $response = Http::get($ruta);
	        // return response()->json($response);
			

			$data = json_decode($consulta);
			
			if (isset($data->nombre))
			{
				$json['status'] 	= true;
				$json['mesage'] 	= 'Número de Documento correcto';
				$json['data'] = $data;

			}
			
			return response()->json($json);
        	
        } catch (Exception $e) {
        	$json 				= [];
        	$json['status'] 	= true;
			$json['mesage'] 	= 'Algo Sucedio, comunicate con el Administrador';
			$json['data'] = $data;
			return response()->json($json);

        } 
    }
}