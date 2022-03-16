<div>
    <div class="table-responsive">
        <table class="table-items-oc table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio/u</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $i => $item)
                    <tr>
                        <td><span class="nro-item">{{ $i + 1 }}</span></td>
                        <td>
                            <input type='text' name="items[{{ $i }}][nombre]"
                                class='nombre-item form-control' value='{{ $item->nombre }}'>
                        </td>
                        <td>
                            <textarea rows="1" name="items[{{ $i }}][descrip]"
                                class='descrip-item form-control'
                                placeholder=''>{{ $item->descripcion }}</textarea>
                        </td>
                        <td>
                            <input type='number' name='items[{{ $i }}][cantidad]' min='1'
                                class='cantidad-item cantidad-item form-control'
                                value='{{ $item->cantidad }}'>
                        </td>
                        <td>
                            <input type='number' name='items[{{ $i }}][precioUnit]'
                                class='precio-unit-item form-control' value='{{ $item->precioUnit }}'>
                        </td>
                        <td>
                            <input type='number' name='items[{{ $i }}][precioTotal]'
                                class='precio-total-item form-control' readonly
                                value='{{ $item->precioTotal }}'>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row position-relative my-4 ">
        <div class="w-100">
            <table class="table-oc-totales table table-sm table-bordered">
                <tr>
                    <td>Neto</td>
                    <td>
                        <input type="hidden" name="oc_precio_neto" value="">
                        <span>S/ 0.00</span>
                    </td>
                </tr>
                <tr>
                    <td>Descuento</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">%</div>
                            </div>
                            <input type="number" name="oc_descuento" class="input-descuento form-control"
                                value="0">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Sub Total</td>
                    <td>
                        <input type="hidden" name="oc_precio_subtotal" value="">
                        <span>S/ 0.00</span>
                    </td>
                </tr>
                <tr>
                    <td>IGV</td>
                    <td>
                        <input type="hidden" name="oc_precio_igv" value="">
                        <span>S/ 0.00</span>
                    </td>
                </tr>
                <tr>
                    <td>Envio</td>
                    <td>
                        <input type="hidden" name="oc_precio_envio" value="">
                        <span>S/ 0.00</span>
                    </td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>
                        <input type="hidden" name="oc_precio_total" value="">
                        <span>S/ 0.00</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@push('js')
    <script>

        const
            $btnAddItem = d.querySelector(".btn-agregar-item"),
            $btnAddFilaVacia = d.querySelector(".btn-agregar-fila-vacia"),
            $tableItems = d.querySelector(".table-items-oc tbody"),
            $tableTotales = d.querySelector(".table-oc-totales"),
            $inputDescuento = d.querySelector('.input-descuento');

        d.addEventListener("input", e => {
            if (e.target.matches(['.cantidad-item', '.input-descuento'])) {
                let val = e.target.value;
                e.target.value = val.replace(/\D|\-/, '');
            }
            //--------------------------------------------------------------
            if (e.target.matches('.cantidad-item')) {
                let cantidadItem = parseFloat(e.target.value),
                    $inputPrecioTotal = e.target.parentNode.parentNode.querySelector('.precio-total-item'),
                    $inputPrecioUnit = e.target.parentNode.parentNode.querySelector('.precio-unit-item');

                if (e.target.value) {
                    $inputPrecioTotal.value = (parseFloat($inputPrecioUnit.value) * cantidadItem).toFixed(2);
                }
                if (e.target.value == '') {
                    $inputPrecioTotal.value = 0;
                }
                calcularTotales($inputDescuento.value);
            }
            if (e.target.matches('.precio-unit-item')) {
                let precioUnitItem = parseFloat(e.target.value),
                    $inputPrecioTotal = e.target.parentNode.parentNode.querySelector('.precio-total-item'),
                    $inputCantItem = e.target.parentNode.parentNode.querySelector('.cantidad-item');

                if (e.target.value) {
                    $inputPrecioTotal.value = (parseFloat($inputCantItem.value) * precioUnitItem).toFixed(2);
                }
                if (e.target.value == '') {
                    $inputPrecioTotal.value = 0;
                }
                calcularTotales($inputDescuento.value);
            }
            if (e.target.matches('.input-descuento')) {
                //console.clear()
                //console.log(e.target.value);
                if (e.target.value) {
                    calcularTotales(e.target.value);
                } else {
                    calcularTotales()
                }
            }

        })

        d.addEventListener("click", e => {
            if (e.target.matches('.btn-agregar-item')) {
                //console.log($selectProds.value);
                e.preventDefault();
                let uri = '{{ route('cotizacion.getProduct', ':id') }}';
                uri = uri.replace(':id', $selectProds.value);
                //console.log(uri);
                peticiones({
                    url: uri,
                    ops: {
                        method: "GET",
                        headers: {
                            "Content-type": "application/json; charset=utf-8"
                        }
                    },
                    success: (json) => {

                        let descrip = json.producto.descripcion_producto,
                            precioUnit = json.producto.precio;

                        if (selectCategoriaValue == 1) {
                            let precioMedida = 1;
                            d.querySelectorAll('.input-medidas').forEach(el => {
                                precioMedida *= parseFloat(el.value) / 100;

                            })
                            console.log(precioMedida);
                            precioUnit = (precioUnit * precioMedida).toFixed(2);
                        }
                        //TIPO MONEDA
                        let tipoMoneda = d.querySelector('input[name="tipo_moneda"]').value;
                        if (tipoMoneda == 'dolares') {
                            let dolar = d.querySelector('input[name="valor_dolar"]').value;
                            //console.log(dolar) ;
                            precioUnit = (precioUnit / dolar).toFixed(2);
                        }

                        let precioTotal = precioUnit;

                        let index = $tableItems.rows.length,
                            row = $tableItems.insertRow($tableItems.rows.length);

                        let cell1 = row.insertCell(0),
                            cell2 = row.insertCell(1),
                            cell3 = row.insertCell(2),
                            cell4 = row.insertCell(3),
                            cell5 = row.insertCell(4),
                            cell6 = row.insertCell(5),
                            cell7 = row.insertCell(6);
                        cell1.innerHTML = `<span class='nro-item'>${$tableItems.rows.length++}</span>`;
                        cell2.innerHTML =
                            `<input type='text' name='items[${index}][nombre]' class='nombre-item form-control' value='${descrip}'>`;
                        cell3.innerHTML =
                            `<textarea rows="1" name='items[${index}][descrip]' class='descrip-item form-control' placeholder='descripcion (opcional)'></textarea>`;
                        cell4.innerHTML =
                            `<input type='number' name='items[${index}][cantidad]' min='1' class='cantidad-item form-control' value='1'>`;
                        cell5.innerHTML =
                            `<input type='number' name='items[${index}][precioUnit]' class='precio-unit-item form-control' value='${precioUnit}'>`;
                        cell6.innerHTML =
                            `<input type='number' name='items[${index}][precioTotal]' class='precio-total-item form-control' readonly value='${precioTotal}'>`;
                        cell7.innerHTML = `<a class='btn-delete-item btn btn-sm btn-danger'>X</a>`;


                        calcularTotales($inputDescuento.value);
                    },
                    error: err => console.log(err),
                })
            }
            if (e.target.matches('.btn-agregar-fila-vacia')) {
                e.preventDefault();
                let index = $tableItems.rows.length,
                    row = $tableItems.insertRow($tableItems.rows.length);
                let cell1 = row.insertCell(0),
                    cell2 = row.insertCell(1),
                    cell3 = row.insertCell(2),
                    cell4 = row.insertCell(3),
                    cell5 = row.insertCell(4),
                    cell6 = row.insertCell(5),
                    cell7 = row.insertCell(6);
                cell1.innerHTML = `<span class='nro-item'>${$tableItems.rows.length++}</span>`;
                cell2.innerHTML =
                    `<input type='text' name='items[${index}][nombre]' class='nombre-item form-control' value=''>`;
                cell3.innerHTML =
                    `<textarea rows="1" name='items[${index}][descrip]' class='descrip-item form-control' placeholder='descripcion (opcional)'></textarea>`;
                cell4.innerHTML =
                    `<input type='number' name='items[${index}][cantidad]' min='1' class='cantidad-item form-control' value='1'>`;
                cell5.innerHTML =
                    `<input type='number' name='items[${index}][precioUnit]' class='precio-unit-item form-control' value='0.00'>`;
                cell6.innerHTML =
                    `<input type='number' name='items[${index}][precioTotal]' class='precio-total-item form-control' readonly value='0.00'>`;
                cell7.innerHTML = `<a class='btn-delete-item btn btn-sm btn-danger'>X</a>`;
            }
            if (e.target.matches('.btn-delete-item')) {
                let row = e.target.parentNode.parentNode;

                $tableItems.removeChild(row);

                for (let i = 0; i < $tableItems.rows.length; i++) { //indexa la tabla nuevamente
                    $tableItems.rows[i].querySelector('.nro-item').textContent = i + 1;
                    $tableItems.rows[i].querySelector('.nombre-item').setAttribute("name", `items[${i}][nombre]`);
                    $tableItems.rows[i].querySelector('.descrip-item').setAttribute("name", `items[${i}][descrip]`);
                    $tableItems.rows[i].querySelector('.cantidad-item').setAttribute("name",
                        `items[${i}][cantidad]`);
                    $tableItems.rows[i].querySelector('.precio-unit-item').setAttribute("name",
                        `items[${i}][precioUnit]`);
                    $tableItems.rows[i].querySelector('.precio-total-item').setAttribute("name",
                        `items[${i}][precioTotal]`);

                }

                calcularTotales($inputDescuento.value);
            }

        })
    </script>
@endpush
