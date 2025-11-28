<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItinerarioEmbarque extends Model
{
    use HasFactory;
    protected $table ="itinerario_embarque";

    protected $fillable = [
        'itinerario_id',
        'sucursal_id',
        'hora'
    ];

    public function itinerario(){
        return $this->belongsTo(Itinerario::class, 'itinerario_id', 'id');
    }
}
