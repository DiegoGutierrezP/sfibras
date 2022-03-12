<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto',
        'fecha_pago',
        'moneda',
        'tipo_pago',
        'orden_compra_id'
    ];

    public function orden_compra(){
        return $this->belongsTo('App\Models\OrdenCompra','orden_compra_id');
    }

    public function file(){
        return $this->morphOne('App\Models\File','fileable');
    }
}
