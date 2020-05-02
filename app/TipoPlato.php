<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPlato extends Model
{
    protected $fillable = [
        'nombre','condicion'
    ];
}
