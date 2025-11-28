<?php
namespace App\Repos;

use App\Models\Ventas;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;

class VentaRepo {

    public function findVenta($itinerario_id, $n_asiento){
        return Ventas::query()->where('itinerario_id', $itinerario_id)->where('n_asiento', $n_asiento)->first();
    }
    
    public function create($params){
        return Ventas::create($params);
    }

    public function getPtoVentas($empresa_id, $itinerario_id){
        return Sucursal::ofEmpresa($empresa_id)->ofEstado(1)->select("id","nombre_comercial")->selectRaw("(SELECT COUNT(*) FROM ventas WHERE sucursal_id = sucursales.id AND itinerario_id = ? AND estado = ?) as conteo_ventas, (SELECT IFNULL(SUM(totalventa),0) FROM ventas WHERE sucursal_id = sucursales.id AND itinerario_id = ? AND estado = ?) as suma_ventas", [$itinerario_id, 1, $itinerario_id, 1])->get();
    }
    
}