<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
use Livewire\Component;

use Livewire\WithPagination;

class ClienteIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";/* los estilos de la paginacion cambian estilo de tailwind a boostrap */

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $clientes = Cliente::where('nombre','like','%'.$this->search.'%')
        ->orWhere('dni','like','%'.$this->search.'%')
        ->orWhere('ruc','like','%'.$this->search.'%')
        ->paginate(10);

        return view('livewire.admin.cliente-index',compact('clientes'));
    }
}
