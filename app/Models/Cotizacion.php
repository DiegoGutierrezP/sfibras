<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'codigoCoti',
        'fechaEmision',
        'diasExpiracion',
        'fechaExpiracion',
        'tiempoEntrega',
        'formaPago',
        'tipoMoneda',
        'valorDolar',
        'referenciaCoti',
        'introCoti',
        'conclusionCoti',
        'precioNetoCoti',
        'descuentoCoti',
        'precioSubTotalCoti',
        'precioIgvCoti',
        'precioEnvioCoti',
        'precioTotalCoti',
        'clienteNombre',
        'clienteDni',
        'clienteRuc',
        'clienteTelefono',
        'cliente_id',
        'estado'
    ];

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }

    public function items(){
        return $this->hasMany('App\Models\CotizacionItem');
    }
    public function orden_compra(){
        return $this->hasOne('App\Models\OrdenCompra');
    }
}
