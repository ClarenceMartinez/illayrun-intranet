<?php
namespace App\Repos;

use App\Models\Itinerario;
use App\Models\Asiento;
use App\Models\Clientes;
use App\Models\Ventas;
use App\Models\Encomienda;
use App\Models\EncomiendaDetalle;
use Illuminate\Support\Facades\DB;

class ItinerarioRepo {

    public function getAsientos(Itinerario $itinerario){
        $asientos = Asiento::query()->ofBus($itinerario->bus_id)->ofEstado(1)->select(['id','numero','piso','fila','columna']);
        $ventas = Ventas::query()->where('itinerario_id', $itinerario->id)->select(['venta_id','n_asiento','estado','tipo']);

        $query = DB::query()->fromSub($asientos, 'a')->leftJoinSub($ventas, 'v', 'v.n_asiento', '=', 'a.id')->select(DB::raw('v.venta_id, v.estado as venta_estado, v.n_asiento, a.numero, a.piso, a.fila, a.columna, a.id as asiento_id, v.tipo as venta_tipo'))->get();
        
        return $query;
    }

    public function getManifiestoPasajeros(Itinerario $itinerario){

        $itinerario = $itinerario->load(['sucursal', 'bus', 'chofer'=>function($query){
            $query->select('id','nombres','apellidos');
        }, 'copiloto', 'origen' => function($query){
            $query->select('id','nombre','abrev');
        }, 'destino' => function($query){
            $query->select('id','nombre','abrev');
        }, 'ventas'=>function($query){
            $query->select('venta_id','itinerario_id','cliente_id','comprobante','correlativo','n_asiento','totalpago')->with(['cliente'=>function($query){
                $query->select('id','nombres','paterno','materno','fecha_nacimiento','tipo_documento','numero_documento');
            }, 'asiento'=>function($query){
                $query->select('id','numero');
            }]);
        }]);

        return ['itinerario' => $itinerario];
    }

    public function getManifiestoEncomiendas(Itinerario $itinerario){
        $itinerario = $itinerario->load(['sucursal', 'bus', 'chofer'=>function($query){
            $query->select('id','nombres','apellidos');
        }, 'copiloto', 'origen' => function($query){
            $query->select('id','nombre','abrev');
        }, 'destino' => function($query){
            $query->select('id','nombre','abrev');
        }]);

        $encomiendas = Encomienda::where('itinerario_id', $itinerario->id)->where('estado', 1)->select('id', 'correlativo', 'totalventa', 'consignado_paternos', 'consignado_maternos', 'consignado_nombres', 'consignado_tipo_documento', 'consignado_numero_documento');

        $encomienda_detalle = EncomiendaDetalle::query()->whereRaw('encomienda_id IN (SELECT id FROM encomiendas WHERE itinerario_id = ?)', [$itinerario->id]);

        $results = DB::query()->fromSub($encomiendas, 'e')->joinSub($encomienda_detalle, 'ed', 'e.id', '=', 'ed.encomienda_id')->selectRaw('e.id,e.correlativo,e.totalventa,e.consignado_paternos,e.consignado_maternos,e.consignado_nombres,e.consignado_tipo_documento,e.consignado_numero_documento, ed.cantidad, ed.descripcion')->get();

        $itinerario->encomiendas = $results;

        return ['itinerario' => $itinerario];
    }

    public function getManifiestoPtoVenta(Itinerario $itinerario){

        $itinerario = $itinerario->load(['sucursal', 'bus', 'chofer'=>function($query){
            $query->select('id','nombres','apellidos');
        }, 'copiloto', 'origen' => function($query){
            $query->select('id','nombre','abrev');
        }, 'destino' => function($query){
            $query->select('id','nombre','abrev');
        }]);


        $ventas = $itinerario->ventas()->with(['cliente'=>function($query){
            $query->select('id','nombres','paterno','materno','fecha_nacimiento','tipo_documento','numero_documento','telefono');
        }, 'asiento'=>function($query){
            $query->select('id','numero');
        }, 'punto_venta'=>function($query){
            $query->select('id','nombre_comercial');
        }])->get();

        $ptos = [];

        foreach($ventas as $venta){
            if(!isset($ptos[$venta->punto_venta->id]))
                $ptos[$venta->punto_venta->id] = ["id"=>$venta->punto_venta->id, "nombre_comercial"=>$venta->punto_venta->nombre_comercial];

            $ptos[$venta->punto_venta->id]["ventas"][] = $venta;
        }

        return ['itinerario' => $itinerario, 'ptos' => $ptos];
    }

    public function getCroquis(Itinerario $itinerario){
        $asientos = Asiento::ofBus($itinerario->bus_id)->ofEstado(1)->select(['id','numero','piso','fila','columna']);
        $ventas = Ventas::where('itinerario_id', $itinerario->id)->select(['venta_id','n_asiento','estado','cliente_id']);
        $clientes = Clientes::ofEmpresa($itinerario->empresa_id)->select(['id','nombres','paterno','materno','tipo_documento','numero_documento']);

        $query = DB::query()->fromSub($asientos, 'a')
            ->leftJoinSub($ventas, 'v', 'v.n_asiento', '=', 'a.id')
            ->leftJoinSub($clientes, 'c', 'c.id', '=', 'v.cliente_id')
            ->select(DB::raw('v.venta_id, v.estado as asiento_estado, v.n_asiento, a.numero, a.piso, a.fila, a.columna, a.id as asiento_id, c.nombres as cliente_nombres, c.paterno as cliente_paterno, c.materno as cliente_materno, c.tipo_documento as cliente_tipo_documento, c.numero_documento as cliente_numero_documento'))->get();
        
        return ['itinerario'=>$itinerario->load('origen','destino','bus','sucursal'), 'asientos'=>$query];
    }

}