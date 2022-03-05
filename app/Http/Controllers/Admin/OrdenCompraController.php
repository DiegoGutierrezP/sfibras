<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use App\Models\Cotizacion;
use App\Models\Cliente;
use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DataTables;

class OrdenCompraController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $ordenCompras = DB::select('select oc.id , oc.codigoOC , oc.tipoMoneda, oc.estadoPedido, oc.estadoPago ,oc.precioTotalOC, c.nombre as clienteNombre from orden_compras as oc inner join clientes as c on oc.cliente_id = c.id ');
            collect($ordenCompras)->map(function($item ,$key){
                $item->precioConMoneda = $item->tipoMoneda == 'dolares'? '$. '.$item->precioTotalOC:'S/. '.$item->precioTotalOC;
                return $item;
            });

            return Datatables::of($ordenCompras)
            ->addColumn('actions',function($ordenCompras){
                return view('admin.ordenCompra.actions-index',compact('ordenCompras'));
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
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

        //dd($request);
        $coti=null;$tiempoEntrega=null;$tipoMoneda=null;$valorDolar=null;$formaPago=null;$cotiID=null;$clienteID=null;
        if($request->cotizacion_id){
            $coti=Cotizacion::find($request->cotizacion_id);
            $tiempoEntrega = $coti->tiempoEntrega;
            $tipoMoneda=$coti->tipoMoneda;
            $valorDolar=$coti->valorDolar;
            $formaPago=$coti->formaPago;
            $cotiID=$coti->id;
            $clienteID=$coti->cliente_id;
            //dd($cotiID);
        }else{
            $tiempoEntrega =$request->tiempo_entrega.' dias';
            $tipoMoneda=$request->tipo_moneda;
            $valorDolar=$request->tipo_moneda == "dolares"?$request->valor_dolar:0;
            $formaPago=$request->formaPago == "contado"? "Al contado": ($request->formaPago == "otro"? $request->otra_forma_pago : "adelanto 50%");

            if($request->cliente_nuevo){//si el cliente es nuevo lo creamos
                $cliente = Cliente::create([
                    'nombre'=>$request->nombreCliente,
                    'dni'=>$request->dniCliente,
                    'ruc'=>$request->rucCliente,
                    'telefono'=>$request->telefonoCliente,
                    'email'=>$request->emailCliente,
                    'direccion'=>$request->direccionCliente
                ]);
                $clienteID=$cliente->id;
            }else{
                $clienteID=$request->cliente_id;
            }


        }

        $oc = OrdenCompra::create([
            'fechaEmisionOC'=>$request->emision_OC,
            'observaciones'=>$request->observaciones_oc,
            'entregaEstimada'=>$tiempoEntrega,
            'tipoMoneda'=>$tipoMoneda,
            'valorDolar'=>$valorDolar,
            'formaPago'=>$formaPago,
            'precioNetoOC'=>$request->oc_precio_neto,
            'descuentoOC'=>$request->oc_descuento?$request->oc_descuento:0,
            'precioSubTotalOC'=>$request->oc_precio_subtotal,
            'precioIgvOC'=>$request->oc_precio_igv,
            'precioEnvioOC'=>$request->oc_precio_envio?$request->oc_precio_envio:0,
            'precioTotalOC'=>$request->oc_precio_total,
            'cotizacion_id'=>$cotiID,
            'cliente_id'=>$clienteID
        ]);

        //codigo de OC
        $codigoOC  = str_pad($oc->id,4,'0',STR_PAD_LEFT);
        $oc->update([
            'codigoOC'=>'SFOC'.$codigoOC,
        ]);

        //file
        if($request->hasFile('file_OC')){
            //dd($request->file('file_OC')->getMimeType());
            $file = $request->file('file_OC');
            $nombreFile = $oc->codigoOC.'-'.time().'.'.$file->guessExtension();
            $url = Storage::putFileAs('admin/filesOC',$request->file('file_OC'),$nombreFile);

            $oc->files()->create([
                'url'=>$url,
            ]);
        }
        if($coti!=null){
            //para con cotizacion
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
        }


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
        }

        return redirect()->route('admin.ordenCompra.index')->with('msg-sweet','Se registro la Orden de Compra correctamente');
    }

    public function show($id){
        return view('admin.ordenCompra.show');
    }


}
