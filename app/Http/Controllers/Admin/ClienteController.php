<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\OrdenCompra;
use Illuminate\Support\Facades\DB;
use DataTables;

class ClienteController extends Controller
{
    public function index(){
        return view('admin.clientes.index');
    }

    public function show($id){
        $cliente = Cliente::find($id);
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
                return view('admin.ordenCompra.actions-index',compact('ordenCompras'));
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
    }

    public function getDeudas(Request $request,$id){
        if($request->ajax()){
            $ocs = OrdenCompra::where('cliente_id',$id);
            return Datatables::of($ocs)->make(true);
        }
    }

}
