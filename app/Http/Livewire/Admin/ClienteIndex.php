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
    public $nombre, $ruc,$dni,$direccion,$cliente_id;

    protected $listeners = ['delete'];

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

    protected $rules = [
        'nombre'=>'required',
        'ruc' => 'nullable|digits:11',
        'dni'=>'nullable|digits:8',
        'direccion'=>'required'
    ];

    public function resetValues(){
        $this->reset(['nombre','ruc','dni','direccion','cliente_id']);
        $this->resetValidation();//reseteamos las validaciones
    }

    public function edit( $id)
    {

        $this->resetValues();
        $cliente = Cliente::find($id);
        $this->cliente_id = $id;
        $this->nombre = $cliente->nombre;
        $this->ruc = $cliente->ruc;
        $this->dni = $cliente->dni;
        $this->direccion = $cliente->direccion;


        $this->emit('modalEdit');

    }
    public function update(){
        $data = $this->validate();

        if($this->cliente_id){
            $cliente = Cliente::find($this->cliente_id);
            $cliente->update([
                'nombre'=>$this->nombre,
                'dni'=>$this->dni ? $this->dni : null,
                'ruc'=>$this->ruc? $this->ruc : null,
                'direccion'=>$this->direccion
            ]);

            session()->flash('msginfo', 'Cliente Updated Successfully.');
        }

        $this->emit('closeModalCliente');
    }

     public function create()
    {
        $this->resetValues();
        $this->emit('modalCreate');
    }

    public function store(){
        $data = $this->validate();

        Cliente::create($data);

        session()->flash('msginfo', 'Cliente registrado correctamente.');

        $this->emit('closeModalCliente');
    }

    public function delete(Cliente $cliente){
        $cliente->delete();

        session()->flash('msginfo', 'Cliente eliminado correctamente.');
    }
}
