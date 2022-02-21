<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'dni',
        'ruc',
        'direccion',
        'telefono',
        'email'
    ];

    public function ordenes_compras(){
        return $this->hasMany('App\Models\OrdenCompra');
    }

}
