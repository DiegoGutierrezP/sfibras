@extends('adminlte::page')

@section('title', 'Orden de Compra')

@section('content_header')
    <h1>Ordenes de Compra</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-orden-compra-index table table-striped table-bordered" id="orden-compra">
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        const d = document;

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
                /* "drawCallback": function( settings ) {
                    $('ul.pagination').addClass("pagination-sm");
                }, */
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
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
                        name: 'estadoPedido',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'estadoPago',
                        name: 'estadoPago',
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
