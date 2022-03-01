<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
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
        return view('admin.ordenCompra.create',compact('cotizacion'));
    }
}
