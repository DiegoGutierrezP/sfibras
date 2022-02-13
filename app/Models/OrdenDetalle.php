<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'cantidad',
        'unidad_medida',
        'valor_unitario',
        'estado',
        'orden_compra_id',
        'producto_id'
    ];

    public function orden_compra(){
        return $this->belongsTo('App\Models\OrdenCompra','orden_compra_id');
    }

    public function producto(){
        return $this->hasOne('App\Models\Producto');
    }
}
