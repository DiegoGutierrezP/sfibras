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
    public $updateMode = false;
    public $nombre, $ruc,$dni,$direccion;
    public $readyButton;

   /*  protected $listeners = ['edit']; */

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

    public function edit( $id)
    {
        //$this->reset(['nombre','ruc','dni','direccion']);

        $this->updateMode = true;
        $cliente = Cliente::find($id);
        $this->nombre = $cliente->nombre;
        $this->ruc = $cliente->ruc;
        $this->dni = $cliente->dni;
        $this->direccion = $cliente->direccion;

        //$this->readyButton = true;

        //dd($cliente);

        $this->emit('modalEdit');

    }
     public function create()
    {
        $this->reset(['nombre','ruc','dni','direccion']);
        $this->emit('modalCreate');
    }
}
