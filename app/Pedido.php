<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'fecha_hora','total','estado','direccion','celular','tipo_pago','nombre'
    ];
}
