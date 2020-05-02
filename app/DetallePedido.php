<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $fillable=[
        'pedido_id','plato_id','cantidad','precio', 'entrada_sopa','tipo','comentario'
    ];
}
