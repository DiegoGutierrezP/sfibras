<div class="table-responsive">
    <table class="table table-sm " id="table-deudas-cliente" >
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

@push('js')
    <script>
        //console.log(document.getElementById('id_cliente').value);
        let url2 = '{{ route('admin.clientes.getDeudas', ':id') }}';
            url2 = url2.replace(':id', document.getElementById('id_cliente').value);
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
                    //"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
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
    </script>
@endpush
