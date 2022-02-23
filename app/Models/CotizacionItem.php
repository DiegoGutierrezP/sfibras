<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'precioUnit',
        'precioTotal',
        'cotizacion_id'
    ];

    public function cotizacion(){
        return $this->belongsTo('App\Models\Cotizacion');
    }

}
