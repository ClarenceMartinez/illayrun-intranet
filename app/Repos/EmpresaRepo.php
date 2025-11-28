<?php namespace App\Repos;

use App\Models\Empresas;

class EmpresaRepo {

    public function search($queryParams = []){
        $query = Empresas::query();

        if (isset($queryParams['nombre_comercial']) && $queryParams['nombre_comercial'] !== '')
            $query->where('nombre_comercial','like',  '%' . $queryParams['nombre_comercial'] . '%' );

        if (isset($queryParams['ruc']) && $queryParams['ruc'] !== '')
            $query->where('numero_documento','like',  '%' . $queryParams['ruc'] . '%' );
        
        if (isset($queryParams['estado']))
            $query->where('estado', $queryParams['estado']);

        if (isset($queryParams['tipo_membresia']) && $queryParams['tipo_membresia'] !== '')
            $query->where('tipo_membresia','like',  '%' . $queryParams['tipo_membresia'] . '%' );

        return $query->get();
    }

}