<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    protected $fillable = [
        'nombre', 'tipo','imagen','fecha'
    ];
}
