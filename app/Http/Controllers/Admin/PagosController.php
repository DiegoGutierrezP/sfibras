<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrdenCompra;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

        DB::statement('call pa_verificarPagos_OC('.$request->id_OC.')');

        if($request->hasFile('file_pago_oc')){
            $file = $request->file('file_pago_oc');
            $nombreFile = 'filePag'.time().'.'.$file->guessExtension();
            $url = Storage::putFileAs('admin/filesOC',$request->file('file_pago_oc'),$nombreFile);

            $pago->file()->create([
                'url'=>$url,
                'tipo_archivo'=>$file->getMimeType()
            ]);
        }

        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'success','msg'=>'Pago registrado correctamente']
        ]);
    }
    public function updatePagoOC(Request $request){

        $pago = Pago::find($request->id_pago_oc);

        $pago->update([
            'monto'=>$request->pago_oc,
            'fecha_pago'=>$request->fecha_pago_oc,
            'moneda'=>$request->moneda,
            'tipo_pago'=>$request->forma_pago_oc,
        ]);

        DB::statement('call pa_verificarPagos_OC('.$pago->orden_compra->id.')');

        if($request->hasFile('file_pago_oc')){
            $file = $request->file('file_pago_oc');
            $nombreFile = 'filePag'.time().'.'.$file->guessExtension();
            $url = Storage::putFileAs('admin/filesOC',$request->file('file_pago_oc'),$nombreFile);
            if(is_null($pago->file)){
                $pago->file()->create([
                    'url'=>$url,
                    'tipo_archivo'=>$file->getMimeType()
                ]);
            }else{
                Storage::delete($pago->file->url);
                $pago->file()->update([
                    'url'=>$url,
                    'tipo_archivo'=>$file->getMimeType()
                ]);
            }
        }
        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'success','msg'=>'Pago actualizado correctamente']
        ]);
    }
}
