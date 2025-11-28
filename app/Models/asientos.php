<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asientos extends Model
{
    use HasFactory;
    protected $table = "asientos";

    public function scopeOfBus($query, $bus_id){
        $query->where('bus_id', $bus_id);
    }

    public function scopeOfEstado($query, $estado){
        $query->where('estado', $estado);
    }
}
