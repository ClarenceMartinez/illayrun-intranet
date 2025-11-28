<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bus extends Model
{
    use HasFactory;
    protected $table ="buses";

    protected $fillable = [ 'empresa_id', 'usuario', 'tuc', 'fecha_emision_tuc', 'fecha_vencimiento_tuc', 'citv', 'ultimo_citv', 'soat', 'fecha_emision_soat', 'fecha_vencimiento_soat', 'tarjeta_propiedad', 'tiv_fisico', 'tiv_electronica', 'fecha_emision_tiv', 'fecha_vencimiento_tiv', 'marca', 'placa', 'carroceria_original', 'categoria', 'estado', 'pad'];

    public function getCreatedAtAttribute($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public function caracteristicas(){
        return $this->hasMany(caracteristicas_buses::class, 'id_buses', 'id');
    }

    public function asientos(){
        return $this->hasMany(Asiento::class, 'bus_id', 'id');
    }
}
