<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = [
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
    ];

    public function scopeOfEmpresa($query, $empresa_id){
        $query->where('empresa_id', $empresa_id);
    }
    
}
