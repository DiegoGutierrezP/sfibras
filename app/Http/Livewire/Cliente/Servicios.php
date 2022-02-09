<?php

namespace App\Http\Livewire\Cliente;

use Livewire\Component;

class Servicios extends Component
{
    public $servicio;

    public function render()
    {
        return view('livewire.cliente.servicios');
    }
}
