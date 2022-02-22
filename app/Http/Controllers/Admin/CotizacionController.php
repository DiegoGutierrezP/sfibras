<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Producto;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index(){

        $empresas = Empresa::all();
        $catesprod = CategoriaProducto::all();
        $clientes = Cliente::all();
        return view('admin.cotizacion.index',compact('empresas','catesprod','clientes'));
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

        dd($request);

        /* return response()->json([
            'res'=>true,
            'dataCoti'=>json_decode($request->getContent())
        ]); */


    }

}
