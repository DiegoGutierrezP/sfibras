<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CotizacionIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search = '';
    public $readyToLoad = false;
    public $cant='10',$estado='';

    protected $listeners = ['render'];

    public function updatingSearch(){
        $this->resetPage();
    }
    public function updatingCant(){
        $this->resetPage();
    }
    public function updatingEstado(){
        $this->resetPage();
    }

    public function render()
    {
        if($this->readyToLoad){

            DB::statement('call pa_verificarEstadoCotizacion()');//procedimiento almacenado que modifica el estado comparando las fechas

            if($this->estado == ''){
                $cotizaciones = Cotizacion::where('codigoCoti','like','%'.$this->search.'%')
                        ->orWhere('clienteNombre','like','%'.$this->search.'%')
                        ->orderBy('id','desc')
                        ->paginate($this->cant);
            }else{
                $cotizaciones = Cotizacion::where('estado','=',$this->estado)
                ->where(function($query) {
                    $query->where('codigoCoti','like','%'.$this->search.'%')
                          ->orWhere('clienteNombre','like','%'.$this->search.'%');
                })
                ->paginate($this->cant);
            }

        }else{
            $cotizaciones = [];
        }

        return view('livewire.admin.cotizacion-index',compact('cotizaciones'));
    }
    public function loadCotis(){
        $this->readyToLoad = true;
    }
}
