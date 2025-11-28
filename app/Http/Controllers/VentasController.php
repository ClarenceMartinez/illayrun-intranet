<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\Itinerario;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter()
    {
        $params = request()->all();

        $itinerarios = Itinerario::query()
            ->join('buses as bus', 'bus.id', '=', 'itinerario.bus_id')
            ->join('destinos', 'destinos.id', '=', 'itinerario.destino_id')
            ->join('destinos as origen', 'origen.id', '=', 'itinerario.origen_id')
            ->leftJoin('usuarios as chofer', 'chofer.id', '=', 'itinerario.chofer_id')
            ->leftJoin('usuarios as chofer2', 'chofer2.id', '=', 'itinerario.chofer2_id')
            ->leftJoin('usuarios as terramoza', 'terramoza.id', '=', 'itinerario.terramoza_id')
            ->leftJoin('usuarios as terramoza2', 'terramoza2.id', '=', 'itinerario.terramoza2_id')
            ->leftJoin('sucursales as sucursal1', 'sucursal1.id', '=', 'itinerario.sucursal_partida')
            ->leftJoin('sucursales as sucursal2', 'sucursal2.id', '=', 'itinerario.sucursal_destino')
            ->select(
                [
                    'itinerario.*',
                    DB::raw("(SELECT COUNT(*) FROM " . Ventas::query()->getQuery()->from . "  WHERE itinerario_id = itinerario.id AND estado = 1 AND tipo = 'V') AS vendidos"),
                    DB::raw("(SELECT COUNT(*) FROM " . Ventas::query()->getQuery()->from . "  WHERE itinerario_id = itinerario.id AND estado = 1 AND tipo = 'R') AS reservados"),
                    DB::raw('bus.placa AS bus_placa'),
                    DB::raw('CONCAT(chofer.nombres, " ", chofer.apellidos) AS chofer1_nombres'),
                    DB::raw('CONCAT(chofer2.nombres, " ", chofer2.apellidos) AS chofer2_nombres'),
                    DB::raw('CONCAT(terramoza.nombres, " ", terramoza.apellidos) AS terramoza_nombres'),
                    DB::raw('CONCAT(terramoza2.nombres, " ", terramoza2.apellidos) AS terramoza2_nombres'),
                    DB::raw('sucursal1.nombre_comercial AS sucursal_partida_nombre'),
                    DB::raw('sucursal2.nombre_comercial AS sucursal_destino_nombre'),
                    DB::raw('destinos.nombre AS destino_nombre'),
                    DB::raw('origen.nombre AS origen_nombre'),
                    DB::raw('(SELECT COUNT(*) FROM asientos WHERE bus_id = itinerario.bus_id AND estado = 1) AS capacidad'),
                    DB::raw('0 AS encomiendas'),
                    DB::raw('0 AS bloqueados'),
                    DB::raw("IF(CONCAT(itinerario.fecha_partida, ' ', itinerario.hora_partida) > NOW(), 1, 0) AS habilitado_compra")
                ]
            );

        if(isset($params['destino_id']) && $params['destino_id'] > 0)
            $itinerarios->ofDestino($params['destino_id']);

        if(isset($params['sucursal_id']) && $params['sucursal_id'] > 0)
            $itinerarios->ofSucursal($params['sucursal_id']);

        if(isset($params['fecha']))
            $itinerarios->fromFechaPartida($params['fecha']);
        
        $itinerarios = $itinerarios->activos()->get();

        return response()->json(['status'=>true, 'LISTA'=>$itinerarios]);
    }


    public function create()
    {
        DB::beginTransaction();
        try {
            $clienteRepo = new \App\Repos\ClienteRepo();
            $ventaRepo = new \App\Repos\VentaRepo();
    
            $client_params = request()->all([
                'empresa_id',
                'sucursal_id',
                'tipo_documento',
                'numero_documento',
                'nombres',
                'paterno',
                'materno',
                'fecha_nacimiento',
                'sexo',
                'telefono',
                'email',
                'nacionalidad',
                'es_nino'
            ]);
    
            $cliente = $clienteRepo->findByDocumento($client_params['empresa_id'], $client_params['tipo_documento'], $client_params['numero_documento']);
    
            if($cliente === null)
                $cliente = $clienteRepo->create($client_params);
    
            $venta_params = request()->all([
                'empresa_id',
                'sucursal_id',
                'itinerario_id',
                'embarque_origen_id',
                'embarque_destino_id',
                'fecha_venta',
                'tipo',
                'fecha_reserva',
                'n_asiento',
                'comprobante',
                'correlativo',
                'totalpago'
            ]);
            
            $venta_params['totalventa'] = $venta_params['totalpago'];
            $venta_params['fecha_venta'] = date('Y-m-d');
            $venta_params['cliente_id'] = $cliente->id;
            $venta_params['estado'] = 1;
    
            $venta = $ventaRepo->findVenta($venta_params['itinerario_id'], $venta_params['n_asiento']);
    
            if ($venta !== null)
                throw new \Exception("El asiento seleccionado ya fue vendido/reservado");
    
            $nueva_venta = $ventaRepo->create($venta_params);
            DB::commit();
    
            return response()->json($nueva_venta);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['error'=>$e->getMessage()], 422);
        }
    }

    public function getPtoVentas(){
        try {
            $empresa_id = request()->input('empresa_id');
            $itinerario_id = request()->input('itinerario_id');
            $ventaRepo = new \App\Repos\VentaRepo();
            return response()->json( $ventaRepo->getPtoVentas($empresa_id, $itinerario_id) );
        } catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 422);
        }
    }

}
