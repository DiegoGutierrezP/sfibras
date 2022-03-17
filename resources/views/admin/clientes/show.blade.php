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
                                    <th>Cliente</th>
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
        const d = document;

        let id_cliente = document.getElementById('id_cliente').value;

        d.addEventListener("DOMContentLoaded", e => {

            let url = '{{ route('admin.clientes.getOCxCliente', ':id') }}';
            url = url.replace(':id', document.getElementById('id_cliente').value);


            $("#oc-cliente").DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla ",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "›",
                        "sPrevious": "‹"
                    },
                    //"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
                },
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                order: [0, 'desc'],
                ajax:url,
                dataType: 'json',
                type: "POST",
                columns: [{
                        data: 'codigoOC',
                        name: 'codigoOC',
                    },
                    {
                        data: 'clienteNombre',
                        name: 'clienteNombre',
                        orderable: false
                    },
                    {
                        data: 'precioConMoneda',
                        name: 'precioConMoneda',
                    },
                    {
                        data: 'estadoPedido',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<h5 ><span class=" badge badge-warning ">Pendiente</span></h5>';
                            }
                            if (data == 2) {
                                return '<h5><span class=" badge badge-primary" >Terminado</span></h5>';
                            }
                            if (data == 3) {
                                return '<h5><span class=" badge badge-success" >Entregado</span></h5>';
                            }
                            if (data == 4) {
                                return '<h5><span class=" badge badge-danger" >Cancelado</span></h5>';
                            }
                        },
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'estadoPago',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<h5 ><span class=" badge badge-secondary">Debe</span></h5>';
                            }
                            if (data == 2) {
                                return '<h5><span class=" badge badge-primary">Pagado</span></h5>';
                            }
                        },
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false
                    },

                ],
            });
        })
    </script>
@stop
