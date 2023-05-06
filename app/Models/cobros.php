<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cobros extends Model
{
    use HasFactory;

    protected $fillable = ['nombres', 'apellidos','cino','contrato', 'nombre_user', 'apellido_user', 'usuario', 'comentarios', 'primera_fecha_vencida', 'suma_cuotas_vencidas', 'idcontrato', 'idclientes'];
}
