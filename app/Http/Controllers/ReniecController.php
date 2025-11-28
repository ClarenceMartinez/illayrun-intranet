<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ReniecController extends Controller
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
        	
       		if (strlen($numero) < 8 || strlen($numero) > 8)
       		{
       			$json['mesage'] 	= 'El número debe ser DNI';
       			return response()->json($json);
       			
       		}

			$reniecRepo = new \App\Repos\ReniecRepo();
			$data = $reniecRepo->find($numero);
			
			if (isset($data->nombre))
			{
				$json['status'] 	= true;
				$json['mesage'] 	= 'Número de Documento correcto';
				$json['data'] = $data;

			}
			
			return response()->json($json);
        	
        } catch (\Exception $e) {
        	$json 				= [];
        	$json['status'] 	= true;
			$json['mesage'] 	= 'Algo Sucedio, comunicate con el Administrador';
			$json['data'] = $data;
			return response()->json($json);

        } 
    }
}