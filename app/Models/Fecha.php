<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'referencia',
        'observaciones',
        'orden_compra_id'
    ];

    public function orden_compra(){
        return $this->belongsTo('App\Models\OrdenCompra','orden_compra_id');
    }

}
