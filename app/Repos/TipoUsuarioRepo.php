<?php namespace App\Repos;

use App\Models\tipousuarios;

class TipoUsuarioRepo {

    public function search($queryParams = []){
        return tipousuarios::all();
    }

}