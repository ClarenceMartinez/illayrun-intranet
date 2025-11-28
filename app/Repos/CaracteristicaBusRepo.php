<?php
namespace App\Repos;

use App\Models\caracteristicas_buses_base;

class CaracteristicaBusRepo {

    public function search(){
        return caracteristicas_buses_base::all();
    }


}