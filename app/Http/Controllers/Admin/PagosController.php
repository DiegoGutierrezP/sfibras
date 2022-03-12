<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagosController extends Controller
{
    public function getPagosOC($id){
        $oc = OrdenCompra::find($id);

        collect($oc->pagos)->map(function($item ){
            $item->file = $item->file?$item->file:null;
            return $item;
        });

        return response()->json([
            'res'=>true,
            'data'=>$oc->pagos
        ]);
    }

    public function addPagoOC(Request $request){

        $oc = OrdenCompra::find($request->id_OC);

        //se crea el pago
        $pago = $oc->pagos()->create([
            'monto'=>$request->pago_oc,
            'fecha_pago'=>$request->fecha_pago_oc,
            'moneda'=>$request->moneda,
            'tipo_pago'=>$request->forma_pago_oc
        ]);

        if($request->hasFile('file_pago_oc')){
            $file = $request->file('file_pago_oc');
            $nombreFile = 'filePag'.time().'.'.$file->guessExtension();
            $url = Storage::putFileAs('admin/filesOC',$request->file('file_pago_oc'),$nombreFile);

            $pago->file()->create([
                'url'=>$url,
                'tipo_archivo'=>$file->guessExtension()
            ]);
        }

        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'success','msg'=>'Pago registrado correctamente']
        ]);
    }
}
