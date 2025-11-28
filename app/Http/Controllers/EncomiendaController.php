<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateEncomiendaRequest;
use App\Http\Requests\UpdateEncomiendaRequest;
use App\Models\Encomienda;

class EncomiendaController extends Controller {

    public function search(){
        try {
            $params = request()->all();

            if(!isset($params['sucursal_destino']))
                throw new \Exception("Debes seleccionar la sucursal");

            if(!isset($params['fecha_envio']))
                throw new \Exception("Debes seleccionar la fecha");

            $result = Encomienda::query()->with(['detalle','remitente_tidodoc','consignado_tidodoc','sucursaldestino'=>function($query){
                $query->select('id','nombre_comercial');
            }, 'itinerario'=>function($query){
                $query->select('id','bus_id','fecha_partida','hora_partida','fecha_llegada','hora_llegada')->with(['bus'=>function($query){
                    $query->select('id', 'placa');
                }]);
            }])->where('sucursal_destino', $params['sucursal_destino'])->where('fecha_envio', $params['fecha_envio']);
            
            if(isset($params['keyword']) && $params['keyword'] !== ''){
                $keyword = '%'.$params['keyword'].'%';
                $result->where(function($query) use ($keyword){
                    $query->orWhere('remitente_nombres', 'LIKE', $keyword)
                        ->orWhere('remitente_paternos', 'LIKE', $keyword)
                        ->orWhere('remitente_maternos', 'LIKE', $keyword)
                        ->orWhere('remitente_numero_documento', 'LIKE', $keyword)
                        ->orWhere('consignado_nombres', 'LIKE', $keyword)
                        ->orWhere('consignado_paternos', 'LIKE', $keyword)
                        ->orWhere('consignado_maternos', 'LIKE', $keyword)
                        ->orWhere('consignado_numero_documento', 'LIKE', $keyword);
                });
            }


            $result = $result->get();

            return response()->json(['data'=>$result, 'status'=>true]);
    
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status'=>false]);
        }
    }

    public function create(CreateEncomiendaRequest $request){
        try {
            $params = $request->validated();
            $params['estado'] = 1;
            $detalle = $params['detalle'];
            unset($params['detalle']);
            $params['totalventa'] = array_reduce($detalle, function($c, $item){
                $c += $item['precio'];
                return $c;
            }, 0);
            $params['totaligv'] = ($params['comprobante']=='FACTURA') ? $params['totalventa'] * 0.18 : 0;
            $params['totalgravada'] = ($params['comprobante']=='FACTURA') ? $params['totalventa'] - $params['totaligv'] : $params['totalventa'];

            $encomienda = Encomienda::create($params);
            $encomienda->detalle()->createMany($detalle);

            return response()->json(['data'=>$encomienda->load('detalle'), 'message' => 'La encomienda se guardó correctamente', 'status'=>true]);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status'=>false, 'source'=>'front']);
        }
    }

    public function update(Encomienda $encomienda, UpdateEncomiendaRequest $request){
        try {
            $params = $request->validated();
            $detalle = $params['detalle'];
            $trashItems = $params['trashItems'];
            unset($params['detalle'], $params['trashItems']);

            $params['totalventa'] = array_reduce($detalle, function($c, $item){
                $c += $item['precio'];
                return $c;
            }, 0);
            $params['totaligv'] = ($params['comprobante']=='FACTURA') ? $params['totalventa'] * 0.18 : 0;
            $params['totalgravada'] = ($params['comprobante']=='FACTURA') ? $params['totalventa'] - $params['totaligv'] : $params['totalventa'];
            $encomienda->fill($params);
            $encomienda->save();

            // Elimina los items
            if(count($trashItems) > 0)
                $encomienda->detalle()->whereIn('id', $trashItems)->delete();

            // Actualizar los items
            foreach($detalle as $item){
                if($item['id'] > 0){
                    $encomienda->detalle()->where('id', $item['id'])->update(['cantidad'=>$item['cantidad'], 'descripcion'=>$item['descripcion'], 'peso'=>$item['peso'], 'precio'=>$item['precio']]);
                } else {
                    $encomienda->detalle()->create($item);
                }
            }

            return response()->json(['data'=>$encomienda->load('detalle'), 'message' => 'La encomienda se actualizó correctamente', 'status'=>true]);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status'=>false]);
        }
    }

    public function delete(Encomienda $encomienda){
        try {
            $encomienda->estado = 0;
            $encomienda->save();
            return response()->json(['message' => 'La encomienda se actualizó correctamente', 'status'=>true]);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status'=>false]);
        }
    }

}