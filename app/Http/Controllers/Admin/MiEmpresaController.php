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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('admin.miEmpresa.index',compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.miEmpresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(miEmpresaRequest $request)
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $miEmpresa)
    {
        $empresa = new Empresa();
        $empresa= $miEmpresa;
        return view('admin.miEmpresa.show',compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $miEmpresa)
    {
        $empresa = new Empresa();
        $empresa= $miEmpresa;
        return view('admin.miEmpresa.edit',compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        return response()->json([
            'success' => true,
             'message' => $empresa,
         ]);
    }
}
