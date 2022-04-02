<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\miEmpresaRequest;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MiEmpresaController extends Controller
{

    public function __construct()
    {
         //aplicacion de middleware para proteger rutas
        $this->middleware('can:p.admin.miEmpresa.edit')->only('edit','update');
    }

    public function index()
    {
        $empresa = Empresa::find(1);
        return view('admin.miEmpresa.index',compact('empresa'));
    }


    /* public function create()
    {
        return view('admin.miEmpresa.create');
    } */


    /* public function store(miEmpresaRequest $request)
    {
        if($request->hasFile('fileLogo')){
            $imagen = $request->file('fileLogo');
            $nombreImg = Str::slug($request->razon_social).'logo'.time().'.'.$imagen->guessExtension();
            $url = Storage::putFileAs('admin',$request->file('fileLogo'),$nombreImg);
             $request->merge([
                'logo' => $url,
            ]);
        }
        if($request->hasFile('fileFirma')){
            $imagen = $request->file('fileFirma');
            $nombreImg = Str::slug($request->razon_social).'Firma'.time().'.'.$imagen->guessExtension();
            $url = Storage::putFileAs('admin',$request->file('fileFirma'),$nombreImg);
             $request->merge([
                'firma_titular' => $url,
            ]);
        }

        $emp = Empresa::create($request->all());

        $cuentas=[];
        foreach($request->cuentasBancas as $cuenta){
            if(!is_null($cuenta['banco']) && !is_null($cuenta['nro_cuenta']) ){
                $cuentas[]= ['banco'=>$cuenta['banco'],'tipo_cuenta'=>$cuenta['tipo_cuenta'],'numero_cuenta'=>$cuenta['nro_cuenta'] ];
            }
        }
        if(!empty($cuentas)){
            $emp->cuentas_bancarias()->createMany($cuentas);
        }

        return redirect()->route('admin.miEmpresa.index')->with('msg-sweet','Se registro la empresa correctamente');
    } */



    public function edit(Empresa $miEmpresa)
    {
        $empresa = new Empresa();
        $empresa= $miEmpresa;
        return view('admin.miEmpresa.edit',compact('empresa'));
    }


    public function update(miEmpresaRequest $request, Empresa $miEmpresa)
    {

        if($request->hasFile('fileLogo')){
            $imagen = $request->file('fileLogo');
            $nombreImg = Str::slug($request->razon_social).'logo'.time().'.'.$imagen->guessExtension();
            $url = Storage::putFileAs('admin',$request->file('fileLogo'),$nombreImg);

            if($miEmpresa->logo){
                Storage::delete($miEmpresa->logo);
            }

             $request->merge([
                'logo' => $url,
            ]);
        }
        if($request->hasFile('fileFirma')){
            $imagen = $request->file('fileFirma');
            $nombreImg = Str::slug($request->razon_social).'Firma'.time().'.'.$imagen->guessExtension();
            $url = Storage::putFileAs('admin',$request->file('fileFirma'),$nombreImg);

            if($miEmpresa->firma_titular){
                Storage::delete($miEmpresa->firma_titular);
            }

             $request->merge([
                'firma_titular' => $url,
            ]);
        }

        $miEmpresa->update($request->all());

        $cuentas=[];
        foreach($request->cuentasBancas as $cuenta){
            if(!is_null($cuenta['banco']) && !is_null($cuenta['nro_cuenta']) ){
                $cuentas[]= ['banco'=>$cuenta['banco'],'tipo_cuenta'=>$cuenta['tipo_cuenta'],'numero_cuenta'=>$cuenta['nro_cuenta'] ];
            }
        }

        foreach($miEmpresa->cuentas_bancarias as $cb){
            $cb->delete();
        }

        if(!empty($cuentas)){
            $miEmpresa->cuentas_bancarias()->createMany($cuentas);
        }


        return redirect()->route('admin.miEmpresa.index')->with('msg-sweet','Los datos se actualizaron correctamente');

    }

    /* public function destroy($id)
    {
        try{
            $empresa = Empresa::find($id);
            if($empresa->logo){
                Storage::delete($empresa->logo);
            }
            if($empresa->firma_titular){
                Storage::delete($empresa->firma_titular);
            }
            $empresa->delete();
            return response()->json([
                'response' => true,
                'type'=>'success',
                'message' => 'La empresa se elimino correctamente',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'type'=>'error',
                'message' => 'Ocurrio un error : '. $e,
            ]);
        }

    } */
}
