<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerario extends Model
{
    use HasFactory;
    protected $table ="itinerario";

    protected $fillable = [
        'empresa_id',
        'sucursal_id',
        'bus_id',
        'chofer_id',
        'chofer2_id',
        'terramoza_id',
        'terramoza2_id',
        'fecha_partida',
        'fecha_llegada',
        'hora_partida',
        'hora_llegada',
        'origen_id',
        'destino_id',
        'usuario_id',
        'sucursal_partida',
        'sucursal_destino',
        'estado'
    ];

    public function scopeActivos($query){
        $query->where('itinerario.estado', 1);
    }

    public function scopeOfDestino($query, $destino_id){
        $query->where('itinerario.destino_id', $destino_id);
    }

    public function scopeOfSurcusal($query, $sucursal_id){
        $query->where('itinerario.sucursal_id', $sucursal_id);
    }

    public function scopeFromFechaPartida($query, $fecha){
        $query->whereRaw('itinerario.fecha_partida = ? ', [$fecha]);
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'sucursal_id', 'id');
    }

    public function ventas(){
        return $this->hasMany(Ventas::class, 'itinerario_id', 'id');
    }

    public function bus(){
        return $this->hasOne(Bus::class, 'id', 'bus_id');
    }

    public function chofer(){
        return $this->hasOne(Usuario::class, 'id', 'chofer_id');
    }

    public function copiloto(){
        return $this->hasOne(Usuario::class, 'id', 'chofer2_id');
    }

    public function origen(){
        return $this->belongsTo(Destinos::class, 'origen_id', 'id');
    }

    public function destino(){
        return $this->belongsTo(Destinos::class, 'destino_id', 'id');
    }

    public function embarques(){
        return $this->hasMany(ItinerarioEmbarque::class, 'itinerario_id', 'id');
    }
}
