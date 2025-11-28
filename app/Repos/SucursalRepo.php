<?php namespace App\Repos;

use App\Models\Sucursal;

class SucursalRepo {

    public function search($queryParams = []){
        $query = Sucursal::query();

        if(isset($queryParams['empresa_id']) && $queryParams['empresa_id'] > 0)
            $query->where('empresa_id', $queryParams['empresa_id']);

        if(isset($queryParams['estado']))
            $query->where('estado', $queryParams['estado']);

        return $query->get();
    }

}