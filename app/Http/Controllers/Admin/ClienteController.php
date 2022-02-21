<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(){
        return view('admin.clientes.index');
    }

    public function show(Cliente $cliente){
        return view('admin.clientes.show',compact('cliente'));
    }
}
