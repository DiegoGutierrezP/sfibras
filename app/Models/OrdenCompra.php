<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigoOC',
        'fechaRegistroOC',
        'observaciones',
        'fechaInicioTrabajo',
        'fechaFinalTrabajo',
        'fechaEntrega',
        'entregaEstimada',
        'formaPago',
        'tipoMoneda',
        'valorDolar',
        'estadoPedido',
        'estadoPago',
        'precioNetoOC',
        'descuentoOC',
        'precioSubTotalOC',
        'precioIgvOC',
        'precioEnvioOC',
        'precioTotalOC',
        'cliente_id',
        'cotizacion_id '
    ];

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }

    public function pagos(){
        return $this->hasMany('App\Models\Pago');
    }

    public function orden_detalles(){
        return $this->hasMany('App\Models\OrdenDetalle');
    }
    public function cotizacion(){
        return $this->belongsTo('App\Models\Cotizacion');
    }
}
