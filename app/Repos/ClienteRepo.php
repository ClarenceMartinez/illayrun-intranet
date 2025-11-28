<?php
namespace App\Repos;

use App\Models\Clientes;

class ClienteRepo {

    public function filter($queryParams = []){
        $query = Clientes::query();

        if(isset($queryParams['tipo_documento']) && $queryParams['tipo_documento'] !== '')
            $query->where('tipo_documento', $queryParams['tipo_documento']);

        if(isset($queryParams['numero_documento']) && $queryParams['numero_documento'] !== '')
            $query->where('numero_documento', $queryParams['numero_documento']);

        return $query->get();
    }

    public function findByDocumento($empresa_id, $tipo_documento, $numero_documento){
        return Clientes::query()->where('empresa_id', $empresa_id)->where('tipo_documento', $tipo_documento)->where('numero_documento', $numero_documento)->first();
    }

    public function create($params){
        return Clientes::create($params);
    }

}