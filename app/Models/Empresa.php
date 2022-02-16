<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon_social',
        'logo',
        'ruc',
        'direccion',
        'telefono',
        'celular',
        'email',
        'firma_titular',
    ];

    public function cuentas_bancarias(){
        return $this->hasMany('App\Models\CuentasBancaria');
    }
}
