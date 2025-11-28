<?php namespace App\Repos;

use App\Models\Bus;

class BusRepo {

    public function create( $params){
        $bus = new Bus;
        $bus->fill($params);
        $bus->save();

        if(count($params['caracteristicas']) > 0){
            foreach($params['caracteristicas'] as $c){
                $bus->caracteristicas()->create([
                    'id_caracteristicas_base' => $c['id'],
                    'estado' => 1
                ]);
            }
        }

        return $bus;
    }
    
    public function delete(Bus $bus){
        $bus->estado = 0;
        $bus->save();
    }
    
    public function filter($params){
        return Bus::with(['caracteristicas', 'asientos'=>function($query){
            $query->orderByRaw('piso, numero');
        }])->get();
    }

    public function search(){
        return Bus::get();
    }

    public function update(Bus $bus, $params){
        $bus->fill($params);
        $bus->save();

        $bus->caracteristicas()->delete();
        
        if(count($params['caracteristicas']) > 0){
            foreach($params['caracteristicas'] as $c){
                $bus->caracteristicas()->create([
                    'id_caracteristicas_base' => $c['id'],
                    'estado' => 1
                ]);
            }
        }
    }

    public function saveAsientos(Bus $bus, $params){
        if(isset($params['removedPots']) && count($params['removedPots']) > 0)
            $bus->asientos()->whereIn('id', $params['removedPots'])->delete();

        foreach($params['asientos'] as $asiento){
            if($asiento['id'] > 0){
                $updated = $asiento;
                unset($updated['id']);
                $bus->asientos()->where('id', $asiento['id'])->update($updated);
            } else {
                $bus->asientos()->create($asiento);
            }
        }
    }
}