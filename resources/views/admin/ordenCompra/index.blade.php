@extends('adminlte::page')

@section('title', 'Orden de Compra')

@section('content_header')
    <h1>Lista Ordenes de Compra</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{route('admin.ordenCompra.create')}}" class="btn btn-sfibras2">Registrar Orden de Compra</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-orden-compra-index table table-striped table-bordered" id="orden-compra">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        @if (Session::has('msg-sweet'))
            let msg = "{{ Session::get('msg-sweet') }}";
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            background:'#E6F4EA',
            toast:true,
            color: '#333',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            })
        @endif

        let urlOcIndex = "{{ route('admin.ordenCompra.index') }}";
        let urlOcCancel = "{{ route('admin.ordenCompra.cancel',':id') }}";
        let token = "{{ csrf_token() }}";

        /* const d = document;

        d.addEventListener("DOMContentLoaded", e => {

            $("#orden-compra").DataTable({
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
                //"drawCallback": function( settings ) {
                //    $('ul.pagination').addClass("pagination-sm");
                //},
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                order:[0,'desc'],
                ajax: "{{ route('admin.ordenCompra.index') }}",
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
                        render: function (data, type, row) {
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
                        render: function (data, type, row) {
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

        }) */
    </script>
    <script type="module" src="{{asset('js/admin/ocIndex.js')}}"></script>
@stop
