<?php namespace App\Repos;

use App\Models\Destinos;

class DestinoRepo {

    public function search(){
        return Destinos::all();
    }
}