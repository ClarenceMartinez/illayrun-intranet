<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';

    protected $primaryKey = 'venta_id';

    protected $fillable = [
        'empresa_id',
        'sucursal_id',
        'cliente_id',
        'itinerario_id',
        'embarque_origen_id',
        'embarque_destino_id',
        'fecha_venta',
        'tipo',
        'fecha_reserva',
        'n_asiento',
        'comprobante',
        'correlativo',
        'totalpago',
        'totalventa'
    ];

    use HasFactory;

    public function cliente(){
        return $this->belongsTo(Clientes::class, 'cliente_id', 'id');
    }

    public function asiento(){
        return $this->belongsTo(Asiento::class, 'n_asiento', 'id');
    }

    public function punto_venta(){
        return $this->belongsTo(Sucursal::class, 'sucursal_id', 'id');
    }
}
