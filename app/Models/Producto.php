<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion_producto',
        'precio'
    ];

    public function orden_detalle(){
        return $this->belongsTo('App\Models\OrdenDetalle');
    }

    //relacion productos y medidas (muchos a muchos)
    public function medidas(){
        return $this->belongsToMany('App\Models\Medida');
    }

}
