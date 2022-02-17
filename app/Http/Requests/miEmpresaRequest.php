<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class miEmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'razon_social'=>'required',
            'ruc'=>'required|digits:11',
            'direccion'=>'required',
            'celular'=>'required',
            'email'=>'required|email',
            //'cuentasBancas.*.banco'=>'required',
            //'cuentasBancas.*.nro_cuenta'=>'required',
            'fileLogo'=>'nullable|image|mimes:jpeg,jpg,png,bmp|max:2048',
            'fileFirma'=>'nullable|image|mimes:jpeg,jpg,png,bmp|max:2048'

        ];
    }
    public function attributes()
    {
        return[
            'cuentasBancas.*.banco'=>'nombre del banco',
            'cuentasBancas.*.nro_cuenta'=>'numero de cuenta',
        ];
    }
}
