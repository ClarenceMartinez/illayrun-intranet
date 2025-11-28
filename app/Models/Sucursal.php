<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';


    public function obtenerSucursalesActivasByEmpresa($empresa_id)
    {
        // echo $empresa_id;
    	return Sucursal::where('empresa_id', '=', $empresa_id)->where('estado', '=', 1)->get();
    }

    public function scopeOfEmpresa($query, $empresa_id){
        $query->where('empresa_id', $empresa_id);
    }

    public function scopeOfEstado($query, $estado){
        $query->where('estado', $estado);
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }
    public function provincia(){
        return $this->belongsTo(Provincia::class, 'provincia_id', 'id');
    }
    public function distrito(){
        return $this->belongsTo(Distrito::class, 'distrito_id', 'id');
    }
}
