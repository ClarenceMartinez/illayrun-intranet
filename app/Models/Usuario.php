<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table ="usuarios";

    protected $fillable = ['nombres','apellidos','email','telefono','fecha_nacimiento','isadmin','clave','tipousuario_id','numerodocumento'];

    protected $hidden = [];
}

// class tipousuarios extends Model
// {
//     use HasFactory;
//     protected $table ="tipo_usuarios";
// }
