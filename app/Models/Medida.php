<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion_medida',
        'precio_medida'
    ];

    //relacion productos y medidas (muchos a muchos)
    public function productos(){
        return $this->belongsToMany('App\Models\Producto');
    }
}