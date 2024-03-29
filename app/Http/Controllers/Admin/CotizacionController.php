<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Empresa;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use PDF;
use DataTables;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{

    public function index(Request $request){
        DB::statement('call pa_verificarEstadoCotizacion()');//procedimiento almacenado que modifica el estado comparando las fechas
        if($request->ajax()){
            $cotis=Cotizacion::all();
            $cotis->map(function($item,$key){//agregamos nuevo campo a cada coti
                $item->precioConMoneda = $item->tipoMoneda == 'dolares'? '$. '.$item->precioTotalCoti:'S/. '.$item->precioTotalCoti;
                return $item;
            });

            return Datatables::of($cotis)
            ->addColumn('actions',function($cotis){
                return view('admin.cotizacion.actions-index',compact('cotis'));
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.cotizacion.index');
    }

    public function create(){

        $empresas = Empresa::all();
        $catesprod = CategoriaProducto::all();
        $clientes = Cliente::all();
        return view('admin.cotizacion.create',compact('empresas','catesprod','clientes'));
    }

    public function clonar($id){
        $cotizacion = Cotizacion::find($id);
        $clientes = Cliente::all();
        $moneda = $cotizacion->tipoMoneda=='soles'? 'S/. ':'$. ';
        return view('admin.cotizacion.clonar',compact('cotizacion','moneda','clientes'));
    }

    public function storeClonar(Request $request){
        /* $coti = Cotizacion::find($request->coti_id);
        dd(strstr($coti->diasExpiracion, ' ',true)); */
        try{
            if($request->check_cliente_nuevo){//si el cliente es nuevo lo creamos
                $cliente = Cliente::create([
                    'nombre'=>$request->nombreCliente,
                    'dni'=>$request->dniCliente,
                    'ruc'=>$request->rucCliente,
                    'telefono'=>$request->telefonoCliente,
                    'email'=>$request->emailCliente,
                    'direccion'=>$request->direccionCliente
                ]);

            }else{
                $cliente = Cliente::find($request->cliente_id);
            }

            $coti = Cotizacion::find($request->coti_id);

            $cotiNew = Cotizacion::create([
                'fechaEmision'=>Carbon::now()->toDateString(),
                'diasExpiracion'=>$coti->diasExpiracion,
                'fechaExpiracion'=>Carbon::now()->addDays(strstr($coti->diasExpiracion, ' ',true))->toDateString(),
                'tiempoEntrega'=>$coti->tiempoEntrega,
                'formaPago'=>$coti->formaPago,
                'tipoMoneda'=>$coti->tipoMoneda,
                'valorDolar'=>$coti->valorDolar,
                'referenciaCoti'=>$coti->referenciaCoti,
                'introCoti'=>$coti->introCoti,
                'conclusionCoti'=>$coti->conclusionCoti,
                'precioNetoCoti'=>$coti->precioNetoCoti,
                'descuentoCoti'=>$coti->descuentoCoti,
                'precioSubTotalCoti'=>$coti->precioSubTotalCoti,
                'precioIgvCoti'=>$coti->precioIgvCoti,
                'precioEnvioCoti'=>$coti->precioEnvioCoti,
                'precioTotalCoti'=>$coti->precioTotalCoti,

                'clienteNombre'=>$cliente->nombre,
                'clienteDni'=>$cliente->dni,
                'clienteRuc'=>$cliente->ruc,
                'clienteTelefono'=>$cliente->telefono,

                'cliente_id'=>$cliente->id,
            ]);

            $codigoCoti  = str_pad($cotiNew->id,4,'0',STR_PAD_LEFT);
            $cotiNew->update([
                    'codigoCoti'=>'SFC'.$codigoCoti,
            ]);

            //$cotiNew->items()->createMany($coti->items);

            $items = [];
           foreach($coti->items as $item){
             $items[] = [
                        'nombre'=>$item['nombre'],
                        'descripcion'=>$item['descripcion'],
                        'cantidad'=>$item['cantidad'],
                        'precioUnit'=>$item['precioUnit'],
                        'precioTotal'=>$item['precioTotal']
                        ];
           }
           if(!empty($items)){
                $cotiNew->items()->createMany($items);
            }

            return redirect()->route('admin.cotizacion.index')->with('msg-sweet','La cotizacion se clono correctamente');
        }catch(Exception $e){
            return 'Error '.$e;
        }

    }

    public function pdfCotizacion($id){
        $coti = Cotizacion::FindOrFail($id);
        $miEmp = Empresa::find(1);
        $moneda = $coti->tipoMoneda=='soles'? 'S/. ':'$. ';
        //$fechaTrans = date('jS F, Y',strtotime($coti->fechaEmision));
        $fechaTrans = Carbon::createFromFormat('Y-m-d',$coti->fechaEmision)->locale('es')->isoFormat(' D \d\e MMMM \d\e\l Y');

        $pdf = PDF::loadView('admin.cotizacion.pdf',['coti'=>$coti,"miEmp"=>$miEmp,'fechaEmision'=>$fechaTrans,'moneda'=>$moneda]);
        $pdf->setPaper('A4');
        //return $pdf->stream('admin.cotizacion.pdf');
        return $pdf->download($coti->codigoCoti.'.pdf');
    }


    public function getProductosxCategoria($id){
        $productos = Producto::where('categoria_producto_id',$id)->get();

        return response()->json([
            'res'=>true,
            'productos'=>$productos
        ]);
    }
    public function getProduct($id){
        $producto = Producto::find($id);

        return response()->json([
            'res'=>true,
            'producto'=>$producto
        ]);
    }

    public function generarCotizacion(Request $request){

        /* $fecha = Carbon::createFromFormat('Y-m-d',$request->fecha_emision)->addDays(1)->toDateString();
        dd($fecha); */
        try{
            if($request->cliente_nuevo){//si el cliente es nuevo lo creamos
                $cliente = Cliente::create([
                    'nombre'=>$request->nombreCliente,
                    'dni'=>$request->dniCliente,
                    'ruc'=>$request->rucCliente,
                    'telefono'=>$request->telefonoCliente,
                    'email'=>$request->emailCliente,
                    'direccion'=>$request->direccionCliente
                ]);

            }else{
                $cliente = Cliente::find($request->cliente_id);
            }

            $diasExpiracion = $request->dias_expiracion?$request->dias_expiracion:10;
            $cotizacion = Cotizacion::create([
                'fechaEmision'=>$request->fecha_emision,
                'diasExpiracion'=>$request->dias_expiracion?$request->dias_expiracion.' dias':'10 dias',
                'fechaExpiracion'=>Carbon::createFromFormat('Y-m-d',$request->fecha_emision)->addDays($diasExpiracion)->toDateString(),
                'tiempoEntrega'=>$request->tiempo_entrega?$request->tiempo_entrega.' dias':'5 dias',
                'formaPago'=>$request->formaPago == "contado"? "Al contado": ($request->formaPago == "otro"? $request->otra_forma_pago : "adelanto 50%"),
                'tipoMoneda'=>$request->tipo_moneda == "soles"? "soles":"dolares",
                'valorDolar'=>$request->tipo_moneda == "dolares"?$request->valor_dolar:0,
                'referenciaCoti'=>$request->referencia_cotizacion,
                'introCoti'=>$request->intro_cotizacion,
                'conclusionCoti'=>$request->conclusion_cotizacion,
                'precioNetoCoti'=>$request->coti_precio_neto,
                'descuentoCoti'=>$request->coti_descuento? $request->coti_descuento: "0",
                'precioSubTotalCoti'=>$request->coti_precio_subtotal,
                'precioIgvCoti'=>$request->coti_precio_igv? $request->coti_precio_igv: 0,
                'precioEnvioCoti'=>$request->coti_precio_envio? $request->coti_precio_envio: 0,
                'precioTotalCoti'=>$request->coti_precio_total,

                'clienteNombre'=>$cliente->nombre,
                'clienteDni'=>$cliente->dni,
                'clienteRuc'=>$cliente->ruc,
                'clienteTelefono'=>$cliente->telefono,

                'cliente_id'=>$cliente->id,
            ]);

            //codigo de cotizacion
            $codigoCoti  = str_pad($cotizacion->id,4,'0',STR_PAD_LEFT);
            $cotizacion->update([
                'codigoCoti'=>'SFC'.$codigoCoti,
            ]);


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
            $cotizacion->items()->createMany($items);
            }

            return redirect()->route('admin.cotizacion.show',$cotizacion->id)->with('msg-sweet','La cotizacion se genero correctamente');

        }catch(Exception $err){
            return "error ".$err;
        }

    }

    public function show($id){
        $cotizacion = Cotizacion::FindOrFail($id);
        $moneda = $cotizacion->tipoMoneda=='soles'? 'S/. ':'$. ';
        $fechaEmision = Carbon::createFromFormat('Y-m-d',$cotizacion->fechaEmision)->locale('es')->isoFormat(' D \d\e MMMM \d\e\l Y');
        return view('admin.cotizacion.show',compact('cotizacion','moneda','fechaEmision'));
    }

    public function cambiarEstadoCoti(Request $request){
        try{
            $coti = Cotizacion::where('codigoCoti',$request->codigo_coti);

            $coti->update([
                'estado'=>$request->estadosCoti,
            ]);

            return redirect()->route('admin.cotizacion.index')->with('msg-sweet','La cotizacion '.$request->codigo_coti.' cambio de estado');

        }catch(Exception $e){
            dd($e);
        }
    }

    public function informationCotiAceptada(Request $request){
        try{
            $coti = Cotizacion::find($request->codigoCoti);
            $oc = $coti->orden_compra;

            return response()->json([
                'res'=>true,
                'data'=>[
                    'res'=>true,
                    'oc'=>$oc
                ]
            ]);
        }catch(Exception $e){
            return response()->json([
                'res'=>false,
                'data'=>['icon'=>'error','msg'=>'Ocurrio al consultar con la base de datos']
            ]);
        }
    }

    public function delete($id){

        try{
            $coti = Cotizacion::find($id);

            //$coti->delete();

            /* return response()->json([
                'res'=>true,
                'data'=>['icon'=>'success','msg'=>'La cotizacion se elimino correctamente']
            ]); */
            if($coti->orden_compra == null){
                $coti->delete();
                return response()->json([
                    'res'=>true,
                    'type'=>1,
                    'data'=>['icon'=>'success','msg'=>'La cotizacion se elimino correctamente','position'=>'top-end']
                ]);
            }else{
                return response()->json([
                    'res'=>true,
                    'type'=>2,
                    'data'=>['icon'=>'warning','msg'=>'No se puede eliminar la cotizacion porque esta relacionada a una orden de compra','position'=>'center']
                ]);
            }

        }catch(Exception $e){
            return response()->json([
                'res'=>false,
                'data'=>['icon'=>'error','msg'=>'Ocurrio un error al eliminar la cotizacion']
            ]);
        }
    }

}
