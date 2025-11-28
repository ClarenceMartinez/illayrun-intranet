<?php namespace App\Repos;

class ReniecRepo {


    public function find($numero){
        $ruta = "https://api.apis.net.pe/v1/dni?numero=".$numero;
        $consulta 			= file_get_contents($ruta);
        return json_decode($consulta);
    }

}