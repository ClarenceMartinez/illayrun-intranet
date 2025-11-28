<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    use HasFactory;
    protected $table = "asientos";

    protected $fillable = [ 'bus_id', 'numero', 'piso', 'fila', 'columna', 'estado', ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function scopeOfBus($query, $bus_id){
        $query->where('bus_id', $bus_id);
    }

    public function scopeOfEstado($query, $estado){
        $query->where('estado', $estado);
    }
}
