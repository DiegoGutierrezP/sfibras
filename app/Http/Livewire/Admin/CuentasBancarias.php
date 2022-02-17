<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CuentasBancarias extends Component
{
    public $cuentasBancas = [];

    public function mount($cuentas = null){
        if(empty($cuentas[0])){
            $this->cuentasBancas[] = [
                'banco'=>'',
                'nro_cuenta'=>'',
                'tipo_cuenta'=>'soles'
            ];
        }else{
            foreach($cuentas as $c){
                $this->cuentasBancas[] = [
                    'banco'=>$c->banco,
                    'nro_cuenta'=>$c->numero_cuenta,
                    'tipo_cuenta'=>$c->tipo_cuenta
                ];
            }
        }

    }

    public function render()
    {
        return view('livewire.admin.cuentas-bancarias');
    }

    protected $validationAttributes = [
        'cuentasBancas.*.banco'=>'nombre del banco',
        'cuentasBancas.*.nro_cuenta'=>'nro de cuenta',
        'cuentasBancas.*.tipo_cuenta' => 'tipo de cuenta',
    ];

    public function addCuenta(){

        $this->validate([
            'cuentasBancas.*.banco'=>'required',
            'cuentasBancas.*.nro_cuenta'=>'required',
            'cuentasBancas.*.tipo_cuenta'=>'required'
        ]);

        $this->cuentasBancas[] = [
            'banco'=>'',
            'nro_cuenta'=>'',
            'tipo_cuenta'=>'soles'
        ];
    }
    public function removeCuenta($index){
        unset($this->cuentasBancas[$index]);//elimina
        $this->cuentasBancas = array_values($this->cuentasBancas);//ordena el array
    }
}
