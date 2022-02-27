<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;

class CotizacionIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search = '';
    public $readyToLoad = false;
    public $cant='10';

    protected $listeners = ['render'];

    public function updatingSearch(){
        $this->resetPage();
    }
    public function updatingCant(){
        $this->resetPage();
    }

    public function render()
    {
        if($this->readyToLoad){
            $cotizaciones = Cotizacion::where('codigoCoti','like','%'.$this->search.'%')
                        ->orWhere('clienteNombre','like','%'.$this->search.'%')
                        ->orderBy('id','desc')
                        ->paginate($this->cant);
        }else{
            $cotizaciones = [];
        }

        return view('livewire.admin.cotizacion-index',compact('cotizaciones'));
    }
    public function loadCotis(){
        $this->readyToLoad = true;
    }
}
