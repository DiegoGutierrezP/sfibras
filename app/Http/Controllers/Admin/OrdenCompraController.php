<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use App\Models\Cotizacion;
use App\Models\Cliente;
use Illuminate\Http\Request;

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
}
