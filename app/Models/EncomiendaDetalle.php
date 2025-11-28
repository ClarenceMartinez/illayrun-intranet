<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncomiendaDetalle extends Model {

    protected $table = 'encomiendas_detalle';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['encomienda_id', 'cantidad', 'descripcion', 'peso', 'precio'];
}