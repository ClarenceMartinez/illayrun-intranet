<?php namespace App\Repos;

use App\Models\Usuario;

class UsuarioRepo {

    public function search(){
        return Usuario::all();
    }
}