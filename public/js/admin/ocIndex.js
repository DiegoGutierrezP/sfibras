import ajaxFetch from "../../helpers/ajaxFetch.js";
const d = document;

d.addEventListener("DOMContentLoaded", (e) => {
    $("#orden-compra").DataTable({
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
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        order: [0, "desc"],
        ajax: urlOcIndex,
        dataType: "json",
        type: "POST",
        columns: [
            {
                data: "codigoOC",
                name: "codigoOC",
            },
            {
                data: "clienteNombre",
                name: "clienteNombre",
                orderable: false,
            },
            {
                data: "precioConMoneda",
                name: "precioConMoneda",
            },
            {
                data: "estadoPedido",
                render: function (data, type, row) {
                    if (data == 1) {
                        return '<h5 ><span class=" badge badge-warning ">Pendiente</span></h5>';
                    }
                    if (data == 2) {
                        return '<h5><span class=" badge badge-primary" >Terminado</span></h5>';
                    }
                    if (data == 3) {
                        return '<h5><span class=" badge badge-primary">Terminado/<br>Entregado</span></h5>';
                    }
                    if (data == 4) {
                        return '<h5><span class=" badge badge-danger" >Cancelado</span></h5>';
                    }
                },
                searchable: false,
                orderable: true,
            },
            {
                data: "estadoPago",
                render: function (data, type, row) {
                    if (data == 1) {
                        return '<h5 ><span class=" badge badge-secondary">Debe</span></h5>';
                    }
                    if (data == 2) {
                        return '<h5><span class=" badge badge-primary">Pagado</span></h5>';
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

d.addEventListener("click",e=>{
    if(e.target.matches('.btn-cancel-oc')){
        e.preventDefault();

        Swal.fire({
            title: "Esta seguro?",
            text: `La orden de compra ${e.target.dataset.codigo} sera cancelada.`,
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Eliminar",
        }).then((result) => {
            if(result.value){
                let urlOcCancel2 = urlOcCancel.replace(':id', e.target.dataset.oc);
                ajaxFetch({
                    url:urlOcCancel2,
                    ops:{
                        method:"DELETE",
                        headers:{
                            "Content-type": "application/json; charset=utf-8",
                            "X-CSRF-TOKEN": token
                        }
                    },
                    success:json=>{
                        $("#orden-compra").DataTable().ajax.reload();
                        Swal.fire({
                            position: "top-end",
                            icon: json.data.icon,
                            title: json.data.msg,
                            background: "#E6F4EA",
                            toast: true,
                            color: "#333",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    },
                    error:err=>{
                        alert(err);
                        console.log(err);
                    }
                })
            }
        });
    }
})
