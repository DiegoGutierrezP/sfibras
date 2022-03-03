<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use App\Models\Cotizacion;
use App\Models\Cliente;
use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdenCompraController extends Controller
{
    public function index(){
        return view('admin.ordenCompra.index');
    }
    public function create($coti = null){
        if($coti != null){
            $cotizacion = Cotizacion::where('codigoCoti',$coti)->firstOrFail();
        }else{
            $cotizacion = null;
        }
        $catesprod = CategoriaProducto::all();
        $clientes = Cliente::all();
        return view('admin.ordenCompra.create',compact('cotizacion','catesprod','clientes'));
    }

    public function store(Request $request){

        if($request->hasFile('file_OC')){
            dd($request->file('file_OC')->getMimeType());
        }
        /* $coti=Cotizacion::find($request->cotizacion_id);

        $oc = OrdenCompra::create([
            'fechaRegistroOC'=>Carbon::now()->toDateString(),
            'observaciones'=>$request->observaciones_oc,
            'entregaEstimada'=>$coti->tiempoEntrega,
            'tipoMoneda'=>$coti->tipoMoneda,
            'valorDolar'=>$coti->valorDolar,
            'formaPago'=>$coti->formaPago,
            'precioNetoOC'=>$request->oc_precio_neto,
            'descuentoOC'=>$request->oc_descuento?$request->oc_descuento:0,
            'precioSubTotalOC'=>$request->oc_precio_subtotal,
            'precioIgvOC'=>$request->oc_precio_igv,
            'precioEnvioOC'=>$request->oc_precio_envio?$request->oc_precio_envio:0,
            'precioTotalOC'=>$request->oc_precio_total,
            'cotizacion_id'=>$coti->id,
            'cliente_id'=>$coti->cliente_id
        ]);

        //codigo de OC
        $codigoOC  = str_pad($oc->id,4,'0',STR_PAD_LEFT);
        $oc->update([
            'codigoOC'=>'SFOC'.$codigoOC,
        ]);

        $arrayItemsCoti = [];
        foreach($coti->items as $item){//lo convertimos a array para comparar
            $arrayItemsCoti[]= [
            'nombre'=>$item->nombre,
            'descrip'=>$item->descripcion,
            'cantidad'=>$item->cantidad,
            'precioUnit'=>$item->precioUnit,
            'precioTotal'=>$item->precioTotal
            ];
        }

        $difNombreItem = 0;$difDescripItem = 0;$difCantItem=0;$difPrecUnitItem=0;$difPrecTotal=0;
        if(count($request->items) != count($coti->items)){//hacemos esto para ver si es aceptado tal cual o acpetado /modificado
            $coti->update(['estado'=>3]);
        }else{
            for($i=0; $i<count($request->items); $i++){
                $arrayItemsCoti[$i]['nombre']==$request->items[$i]['nombre']? false : $difNombreItem++;
                $arrayItemsCoti[$i]['descrip']==$request->items[$i]['descrip']? false : $difDescripItem++;
                $arrayItemsCoti[$i]['cantidad']==$request->items[$i]['cantidad']? false : $difCantItem++;
                $arrayItemsCoti[$i]['precioUnit']==$request->items[$i]['precioUnit']? false : $difPrecUnitItem++;
                $arrayItemsCoti[$i]['precioTotal']==$request->items[$i]['precioTotal']? false : $difPrecTotal++;
            }
            if($difNombreItem != 0 || $difDescripItem != 0 || $difCantItem != 0|| $difPrecUnitItem != 0 || $difPrecTotal != 0){
                $coti->update(['estado'=>3]);
            }else{
                $coti->update(['estado'=>2]);
            }

        }

         //
         $items = [];
         foreach($request->items as $item){
           $items[] = [
                      'nombre'=>$item['nombre'],
                      'descripcion'=>$item['descrip'],
                      'cantidad'=>$item['cantidad'],
                      'precioUnit'=>$item['precioUnit'],
                      'precioTotal'=>$item['precioTotal']
           ];
         }
        if(!empty($items)){
            $oc->orden_detalles()->createMany($items);
        } */

    }



}
