@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mi Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.miEmpresa.create')}}" class="btn btn-secondary">Registrar Empresa</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Razon Social</th>
                        <th>Ruc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{$empresa->id}}</td>
                        <td>{{$empresa->razon_social}}</td>
                        <td>{{$empresa->ruc}}</td>
                        <td width="20px">
                            <a class="btn btn-light " href="{{route('admin.miEmpresa.show',$empresa)}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
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
