<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\OrdenCompra;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;
use DataTables;

class ClienteController extends Controller
{
    public function index(){
        return view('admin.clientes.index');
    }

    public function show($id){
        $cliente = Cliente::FindOrFail($id);
        return view('admin.clientes.show',compact('cliente'));

    }

    public function getOCxCliente(Request $request,$id){
        if($request->ajax()){
            $ordenCompras = DB::select('select oc.id , oc.codigoOC , oc.tipoMoneda, oc.estadoPedido, oc.estadoPago ,oc.precioTotalOC, c.nombre as clienteNombre from orden_compras as oc inner join clientes as c on oc.cliente_id = c.id where cliente_id='.$id);
            collect($ordenCompras)->map(function($item ,$key){
                $item->precioConMoneda = $item->tipoMoneda == 'dolares'? '$. '.$item->precioTotalOC:'S/. '.$item->precioTotalOC;
                return $item;
            });
            return Datatables::of($ordenCompras)
            ->addColumn('actions',function($ordenCompras){
               /*  return view('admin.ordenCompra.actions-index',compact('ordenCompras')); */
               return '<a href="'.route('admin.ordenCompra.show',$ordenCompras->id).'"
                class="btn btn-sm btn-sfibras2"><i class="fas fa-eye"></i></a>
                <a href="" class="btn btn-sm btn-sfibras2"><i class="fas fa-file-pdf"></i></a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
    }

    public function getDeudas($id){
        $ocs = OrdenCompra::where('cliente_id',$id)->where('estadoPago',1)->where('estadoPedido','!=','4')->get();

        $dataDeuda=[];
        foreach($ocs as $oc){
            //$deudas[] = $oc->pagos->sum('monto');
            $deuda = (float)$oc->precioTotalOC - $oc->pagos->sum('monto');
            $mon = $oc->moneda == 'dolares'? '$.':'S/.';
            $dataDeuda[] = ["idOC"=>$oc->id,"codigoOC"=>$oc->codigoOC,"deudaOC"=>$mon." ".number_format($deuda,2)];
        }

        return Datatables::of($dataDeuda)
        ->addColumn('actions',function($dataDeuda){
            return '<a href="'.route('admin.ordenCompra.show',$dataDeuda["idOC"]).'"
            class="btn btn-sm btn-sfibras2"><i class="fas fa-eye"></i></a>';
        })
        ->rawColumns(['actions'])
        ->make(true);
        //dd($dataDeuda);
    }

}
