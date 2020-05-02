<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sopa extends Model
{
    protected $fillable = [
        'nombre', 'imagen','fecha'
    ];
}
