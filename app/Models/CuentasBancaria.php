<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasBancaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'banco',
        'tipo_cuenta',
        'numero_cuenta',
    ];

    public function empresa(){
        return $this->belongsTo('App\Models\Empresa');
    }
}
