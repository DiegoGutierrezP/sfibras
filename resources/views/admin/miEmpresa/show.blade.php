@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mi Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="float-left">{{$empresa->razon_social}}</h4>
            <div class="float-right">
                <a href="" class="btn btn-secondary">Editar</a>
            </div>
        </div>
        <div class="card-body">
            <div class="my-4">
                <img src="{{Storage::url($empresa->logo)}}" class="img-fluid" alt="">
            </div>
            <table class="table">
                <tr>
                    <th>Razon Social:</th>
                    <td>{{$empresa->razon_social}}</td>
                </tr>
                <tr>
                    <th>Ruc:</th>
                    <td>{{$empresa->ruc}}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{$empresa->direccion}}</td>
                </tr>
                <tr>
                    <th>Telefono:</th>
                    <td>{{$empresa->telefono}}</td>
                </tr>
                <tr>
                    <th>Celular:</th>
                    <td>{{$empresa->celular}}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{$empresa->email}}</td>
                </tr>
                <tr>
                    <th>Cuentas Bancarias:</th>
                    <td>{{$empresa->cuentas_bancarias}}</td>
                </tr>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
