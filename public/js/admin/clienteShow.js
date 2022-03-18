const d = document;
let id_cliente = document.getElementById('id_cliente').value;

d.addEventListener("DOMContentLoaded", e => {

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

    $("#table-deudas-cliente").DataTable({
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
        },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        order: [0, 'desc'],
        ajax:url2,
        dataType: 'json',
        type: "POST",
        columns: [{
                data: 'codigoOC',
                name: 'codigoOC',
            },
            {
                data: 'precioTotalOC',
                name: 'precioTotalOC',
                orderable: false
            },
        ],
    });

})


