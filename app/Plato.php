<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    protected $fillable = [
        'tipo_plato_id','sopa_id','bebida_id','entrada_id','nombre','precio','fecha', 'imagen'
    ];
}
