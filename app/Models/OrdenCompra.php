<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'fecha_inicio',
        'fecha_final',
        'fecha_entrega',
        'estado_orden',
        'estado_pago',
        'moneda',
        'precio_venta',
        'precio_total_igv',
        'cliente_id'
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
}
