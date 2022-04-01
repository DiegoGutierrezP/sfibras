<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use App\Models\Cotizacion;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\File;
use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use DataTables;
use stdClass;
use PDF;

class OrdenCompraController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $ordenCompras = DB::select('select oc.id , oc.codigoOC , oc.tipoMoneda, oc.estadoPedido, oc.estadoPago ,oc.precioTotalOC, c.nombre as clienteNombre from orden_compras as oc inner join clientes as c on oc.cliente_id = c.id');
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
            $this->authorize('createAsOC',$cotizacion);
        }else{
            $cotizacion = null;
        }

        $catesprod = CategoriaProducto::all();
        $clientes = Cliente::all();
        return view('admin.ordenCompra.create',compact('cotizacion','catesprod','clientes'));
    }

    public function edit($id){
        $oc = OrdenCompra::find($id);
        $fechaEmisionOC = Carbon::createFromFormat('Y-m-d',$oc->fechaEmisionOC)->locale('es')->isoFormat(' D \d\e MMMM \d\e\l Y');
        $catesprod = CategoriaProducto::all();
        return view('admin.ordenCompra.edit',compact('oc','fechaEmisionOC','catesprod'));
    }

    public function store(Request $request){

        //dd($request->file('file_OC')->guessExtension());

        $coti=null;$tiempoEntrega=null;$tipoMoneda=null;$valorDolar=null;$formaPago=null;$cotiID=null;$clienteID=null;
        $cotiEnvio = null;
        if($request->cotizacion_id){
            $coti=Cotizacion::find($request->cotizacion_id);
            $cotiEnvio = $coti->precioEnvioCoti;//-Para comparar luego
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
        //creamos las fechas
        $fechasOC  = [['referencia'=>'inicioTrabajo'],['referencia'=>'finalTrabajo'],['referencia'=>'entrega']];
        $oc->fechas()->createMany($fechasOC);

        //file
        if($request->hasFile('file_OC')){
            //dd($request->file('file_OC')->getMimeType());
            $file = $request->file('file_OC');
            $nombreFile = $oc->codigoOC.'-'.time().'.'.$file->guessExtension();
            $url = Storage::putFileAs('admin/filesOC',$request->file('file_OC'),$nombreFile);

            $oc->files()->create([
                'url'=>$url,
                'tipo_archivo'=>$file->getMimeType()
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
                    if($cotiEnvio != $request->oc_precio_envio){
                        $coti->update(['estado'=>3]);
                    }else{
                        $coti->update(['estado'=>2]);
                    }
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

    public function update(Request $request,$id){
        $oc = OrdenCompra::find($id);
        $precioEnvioOC = $oc->precioEnvioOC;
        $oc->update([
            'observaciones'=>$request->observaciones_oc,
            'precioNetoOC'=>$request->oc_precio_neto,
            'descuentOC'=>$request->oc_descuento?$request->oc_descuento:0,
            'precioSubTotalOC'=>$request->oc_precio_subtotal,
            'precioIgvOC'=>$request->oc_precio_igv,
            'precioEnvioOC'=>$request->oc_precio_envio?$request->oc_precio_envio:0,
            'precioTotalOC'=>$request->oc_precio_total,
        ]);
        $arrayItemsOC = [];
        foreach($oc->orden_detalles as $item){//lo convertimos a array para comparar
            $arrayItemsOC[]= [
            'nombre'=>$item->nombre,
            'descrip'=>$item->descripcion,
            'cantidad'=>$item->cantidad,
            'precioUnit'=>$item->precioUnit,
            'precioTotal'=>$item->precioTotal
            ];
        }
        $crearNewItems = false;
        $difNombreItem = 0;$difDescripItem = 0;$difCantItem=0;$difPrecUnitItem=0;$difPrecTotal=0;
        if(count($request->items) != count($arrayItemsOC)){//hacemos esto para ver si es aceptado tal cual o acpetado /modificado
                $oc->orden_detalles()->delete();
                $crearNewItems = true;
        }else{
            for($i=0; $i<count($request->items); $i++){
                $arrayItemsOC[$i]['nombre']==$request->items[$i]['nombre']? false : $difNombreItem++;
                $arrayItemsOC[$i]['descrip']==$request->items[$i]['descrip']? false : $difDescripItem++;
                $arrayItemsOC[$i]['cantidad']==$request->items[$i]['cantidad']? false : $difCantItem++;
                $arrayItemsOC[$i]['precioUnit']==$request->items[$i]['precioUnit']? false : $difPrecUnitItem++;
                $arrayItemsOC[$i]['precioTotal']==$request->items[$i]['precioTotal']? false : $difPrecTotal++;
            }
            if($difNombreItem != 0 || $difDescripItem != 0 || $difCantItem != 0|| $difPrecUnitItem != 0 || $difPrecTotal != 0){
                $oc->orden_detalles()->delete();
                $crearNewItems = true;
            }
        }
        //si se modifico algun item o se agrego
        if($crearNewItems){
            $oc->cotizacion->update(['estado'=>3]);
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
        }
        if($precioEnvioOC != $request->oc_precio_envio){
            $oc->cotizacion->update(['estado'=>3]);
        }

        return redirect()->route('admin.ordenCompra.show',$oc->id)->with('msg-sweet','Se modifico la Orden de Compra correctamente');
    }

    public function show($id){
        $oc = OrdenCompra::FindOrFail($id);
        $moneda = $oc->tipoMoneda=='soles'? 'S/. ':'$. ';
        $fechaEmisionOC = Carbon::createFromFormat('Y-m-d',$oc->fechaEmisionOC)->locale('es')->isoFormat(' D \d\e MMMM \d\e\l Y');
        return view('admin.ordenCompra.show',compact('oc','fechaEmisionOC','moneda'));
    }

    public function cancel($id){
        $oc = OrdenCompra::find($id);
        $oc->update(['estadoPedido'=>4]);
        return response()->json([
            'res'=>true,
            'data'=>['icon'=>'warning','msg'=>'la orden de compra '.$oc->codigoOC . ' fue cancelada']
        ]);
    }

    public function getdatesOC($id){
        $oc = OrdenCompra::FindOrFail($id);

        return response()->json([
            'res'=>true,
            /* 'fechaInicio'=>$oc->fechaInicioTrabajo,
            'fechaFinal'=>$oc->	fechaFinalTrabajo,
            'fechaEntrega'=>$oc->fechaEntrega */
            'dataInicio'=>['fecha'=>$oc->fechas[0]->fecha,'obs'=>$oc->fechas[0]->observaciones],
            'dataFinal'=>['fecha'=>$oc->fechas[1]->fecha,'obs'=>$oc->fechas[1]->observaciones],
            'dataEntrega'=>['fecha'=>$oc->fechas[2]->fecha,'obs'=>$oc->fechas[2]->observaciones],

        ]);
    }
    public function updateDatesOC(Request $request){
        try{
            $oc = OrdenCompra::find($request->codigoOC);
            $ref = '';
            if($request->dataStep == 'inicio'){
                $ref = 'inicioTrabajo';
            }else if($request->dataStep == 'final'){
                $ref = 'finalTrabajo';
            }else if($request->dataStep == 'entrega'){
                $ref = 'entrega';
            }
            $fechasRef = [];
            foreach($oc->fechas as $fecha){
                if($fecha->referencia == $ref){
                    $fecha->update(['fecha'=>$request->date,'observaciones'=>$request->obsStep?$request->obsStep:null]);
                }
                if($fecha->fecha != null){
                    $fechasRef[] = $fecha->referencia;
                }
            }
            if(in_array('entrega',$fechasRef)){
                $oc->update([
                    'estadoPedido'=>3
                ]);
            }else if(in_array('finalTrabajo',$fechasRef)){
                $oc->update([
                    'estadoPedido'=>2
                ]);
            }

            return response()->json([
                'res'=>true,
                'data'=>['icon'=>'success','msg'=>'Fecha insertada correctamente']
                //'data'=>$request->all()
            ]);
        }catch(Exception $err){
            return response()->json([
                'res'=>false,
                'data'=>['icon'=>'error','msg'=>'Ocurrio un error '.$err]
            ]);
        }

    }
    /* Para pdf orden de compra */
    public function createPdf($id){
         $oc = OrdenCompra::findOrFail($id);
        $miEmp = Empresa::find(1);
        $moneda = $oc->tipoMoneda=='soles'? 'S/. ':'$. ';
        $fechaEmision = Carbon::createFromFormat('Y-m-d',$oc->fechaEmisionOC)->locale('es')->isoFormat(' D \d\e MMMM \d\e\l Y');

        $fechaInicio = $oc->fechas->where('referencia','inicioTrabajo')->first();
        $fechaFinal = $oc->fechas->where('referencia','finalTrabajo')->first();
        $fechaEntrega = $oc->fechas->where('referencia','entrega')->first();

        $pdf = PDF::loadView('admin.ordenCompra.pdf',['oc'=>$oc,"miEmp"=>$miEmp,'fechaEmision'=>$fechaEmision,'moneda'=>$moneda,'fechas'=>[$fechaInicio,$fechaFinal,$fechaEntrega]]);
        //$pdf->setPaper('A4');
        return $pdf->stream('admin.ordenCompra.pdf');
        //return $pdf->download($coti->codigoCoti.'.pdf');
    }
}
