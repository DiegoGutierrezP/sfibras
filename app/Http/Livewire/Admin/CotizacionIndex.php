<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;

class CotizacionIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $cotizaciones = Cotizacion::paginate(10);
        return view('livewire.admin.cotizacion-index',compact('cotizaciones'));
    }
}
