import ajaxFetch from "../../helpers/ajaxFetch.js";

const d = document;

d.addEventListener("DOMContentLoaded", (e) => {
    $("#cotizaciones").DataTable({
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla ",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            sInfoEmpty:
                "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "›",
                sPrevious: "‹",
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
        order: [0, "desc"],
        ajax: urlCotiIndex,
        dataType: "json",
        type: "POST",
        columns: [
            {
                data: "codigoCoti",
                name: "codigoCoti",
            },
            {
                data: "referenciaCoti",
                name: "referenciaCoti",
                orderable: false,
            },
            {
                data: "clienteNombre",
                name: "clienteNombre",
                orderable: false,
            },
            {
                data: "fechaEmision",
                name: "fechaEmision",
            },
            {
                data: "precioConMoneda",
                name: "precioConMoneda",
                searchable: false,
                orderable: false,
            },
            {
                data: "estado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return '<h5 ><span class=" badge badge-warning ">Pendiente</span></h5>';
                    }
                    if (data == 2 || data == 3) {
                        let esta = data == 2? 'Aceptado' : 'Aceptado/Modificado';
                        return `<h5><span class=" badge badge-primary" >${esta}</span></h5>`;
                    }
                    if (data == 4) {
                        return '<h5><span class=" badge badge-secondary" >Expirado</span></h5>';
                    }
                    if (data == 5) {
                        return '<h5><span class=" badge badge-danger" >Rechazado</span></h5>';
                    }
                },
                searchable: false,
                orderable: false,
            },
            {
                data: "actions",
                name: "actions",
                searchable: false,
                orderable: false,
            },
        ],
    });
});

d.addEventListener("click", (e) => {
    if (e.target.matches([".btn-delete-coti", ".btn-delete-coti *"])) {
        e.preventDefault();

        Swal.fire({
            title: "Esta seguro?",
            text: "No podras recuperar la cotización",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Eliminar",
        }).then((result) => {
            let urlCotiDelete2 = urlCotiDelete.replace(
                ":id",
                e.target.dataset.coti
            );
            if (result.value) {
                let obj = {
                    url: urlCotiDelete2,
                    ops: {
                        method: "DELETE",
                        headers: {
                            "Content-type": "application/json; charset=utf-8",
                            "X-CSRF-TOKEN": token,
                        },
                    },
                    success: (json) => {
                        if (json.type == 1) {
                            $("#cotizaciones").DataTable().ajax.reload();
                            Swal.fire({
                                position: "top-end",
                                icon: json.data.icon,
                                title: json.data.msg,
                                background: "#E6F4EA",
                                toast: true,
                                color: "#333",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                            });
                        } else if (json.type == 2) {
                            Swal.fire({
                                position: "top",
                                icon: json.data.icon,
                                text: json.data.msg,
                                toast: true,
                                color: "#333",
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,
                            });
                        }
                        //console.log(json);
                    },
                    error: (err) => {
                        Swal.fire({
                            position: "top-end",
                            icon: err.data.icon,
                            title: err.data.msg,
                            background: "#FFD2D2",
                            toast: true,
                            color: "#D8000C",
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                        });
                    },
                };
                ajaxFetch(obj);
            }
        });
    }
});
