
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Información del Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.clientes.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nombre o Razon Social:</th>
                    <td>{{$cliente->nombre}}</td>
                </tr>
                <tr>
                    <th>Dni:</th>
                    <td>{{$cliente->dni}}</td>
                </tr>
                <tr>
                    <th>Ruc:</th>
                    <td>{{$cliente->ruc}}</td>
                </tr>
                <tr>
                    <th>Telefono:</th>
                    <td>{{$cliente->telefono}}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{$cliente->email}}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{$cliente->direccion}}</td>
                </tr>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')

@stop
