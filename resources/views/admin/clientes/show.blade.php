@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Información del Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nombre o Razon Social:</th>
                    <td>{{ $cliente->nombre }}</td>
                </tr>
                <tr>
                    <th>Dni:</th>
                    <td>{{ $cliente->dni }}</td>
                </tr>
                <tr>
                    <th>Ruc:</th>
                    <td>{{ $cliente->ruc }}</td>
                </tr>
                <tr>
                    <th>Telefono:</th>
                    <td>{{ $cliente->telefono }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $cliente->email }}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{ $cliente->direccion }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card">
        <input type="hidden" id="id_cliente" value="{{$cliente->id}}">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="ped-cliente-tab" data-toggle="tab" href="#ped-cliente" role="tab"
                    aria-controls="ped-cliente" aria-selected="true">Pedidos del Cliente</a>
                <a class="nav-item nav-link" id="deudas-cliente-tab" data-toggle="tab" href="#deudas-cliente" role="tab"
                    aria-controls="deudas-cliente" aria-selected="false">Deudas</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="ped-cliente" role="tabpanel" aria-labelledby="ped-cliente-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="oc-cliente">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Total</th>
                                    <th>Estado Pedido</th>
                                    <th>Estado Pago</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="deudas-cliente" role="tabpanel" aria-labelledby="deudas-cliente-tab">
                <div class="card-body">
                    @include('admin.clientes.show-deudas')
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        let url = '{{ route('admin.clientes.getOCxCliente', ':id') }}';
        url = url.replace(':id', document.getElementById('id_cliente').value);
        let url2 = '{{ route('admin.clientes.getDeudas', ':id') }}';
            url2 = url2.replace(':id', document.getElementById('id_cliente').value);
    </script>
     <script src="{{ asset('js/admin/clienteShow.js') }}"></script>
@stop
