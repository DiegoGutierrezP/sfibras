import ajaxFetch from "../../helpers/ajaxFetch.js";

const d = document,
            $selectProds = d.getElementById("select-prods"),
            $contentMedidasSen = d.getElementById("content-medidas-señales"),
            $btnAddItem = d.querySelector(".btn-agregar-item"),
            $btnAddFilaVacia = d.querySelector(".btn-agregar-fila-vacia"),
            $tableItems = d.querySelector(".table-items-oc tbody"),
            $tableTotales = d.querySelector(".table-oc-totales"),
            $inputDescuento = d.querySelector('.input-descuento'),
            $incluyeIgv = d.querySelector('input[name="incluye_igv"]').value;
        var selectCategoriaValue = 0;

        d.addEventListener("DOMContentLoaded", e => {
            setTimeout(() => {
                calcularTotales();
            }, 300);
        })

        //evento para validar solo entrada de numeros enteros positivos
        d.addEventListener("input", e => {
            if (e.target.matches(['.cantidad-item', '.input-descuento', '.input-medidas'])) {
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
            //-------------------------------------------------------------
            if (e.target.matches('.input-medidas')) {

                let medida1 = parseFloat(d.getElementsByClassName('input-medidas')[0].value),
                    medida2 = parseFloat(d.getElementsByClassName('input-medidas')[1].value);

                console.log(typeof(medida1), medida1, typeof(medida2), medida2);
                if (medida1 && medida2) {
                    $btnAddItem.removeAttribute("disabled");
                } else {
                    $btnAddItem.setAttribute("disabled");
                }
            }
            //---------------------------------------------
            if (e.target.matches('.precio-envio')) {
                calcularTotales($inputDescuento.value);
            }
        })

        d.addEventListener("click", e => {
            if (e.target.matches('.btn-agregar-item')) {
                //console.log($selectProds.value);
                e.preventDefault();
                let urlGetProducts2 = urlGetProducts.replace(':id', $selectProds.value);
                //console.log(uri);
                ajaxFetch({
                    url: urlGetProducts2,
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
                        cell1.innerHTML = `<span class='nro-item'>${index + 1}</span>`;
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
                cell1.innerHTML = `<span class='nro-item'>${index + 1}</span>`;
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
            if(e.target.matches('.btn-orden-compra-update')){
                e.preventDefault();
                e.target.setAttribute('disabled');
                validacionOrdenCompraUpdate();
            }

        })

        d.addEventListener("change", e => {
            if (e.target.matches('#select-cates-prods')) {
                selectCategoriaValue = e.target.value;
                $selectProds.innerHTML = "";
                $btnAddItem.setAttribute("disabled");
                d.querySelectorAll('.input-medidas').forEach(el => {
                    el.value = '';
                    el.setAttribute("disabled");
                })
                if (e.target.value != 0) {
                    let urlGetProductsxCate2 = urlGetProductsxCate.replace(':id', e.target.value);
                    //console.log(uri);
                    ajaxFetch({
                        url: urlGetProductsxCate2,
                        ops: {
                            method: "GET",
                            headers: {
                                "Content-type": "application/json; charset=utf-8"
                            }
                        },
                        success: (json) => {
                            let opt = '<option value="0" selected>--Eliga un item--</option>';
                            json.productos.forEach(el => {
                                opt +=
                                    `<option value="${el.id}">${el.descripcion_producto}</option>`
                            });
                            $selectProds.innerHTML = opt;

                            if (e.target.value == 1) {
                                $contentMedidasSen.classList.remove('d-none');
                            } else {
                                if (!$contentMedidasSen.classList.contains('d-none')) {
                                    $contentMedidasSen.classList.add('d-none');
                                }
                            }
                        },
                        error: err => console.log(err),
                    })
                }

            }
            if (e.target.matches("#select-prods")) {

                if (e.target.value != 0) {
                    if (selectCategoriaValue == 1 && e.target.value != 0) {
                        d.querySelectorAll('.input-medidas').forEach(el => {
                            el.removeAttribute("disabled");
                        })
                    }
                    if (selectCategoriaValue != 1) {
                        $btnAddItem.removeAttribute("disabled");
                    }

                } else {
                    $btnAddItem.setAttribute("disabled");
                    d.querySelectorAll('.input-medidas').forEach(el => {
                        el.setAttribute("disabled");
                        el.value = '';
                    })
                }
            }
        })

        function calcularTotales(descuento = 0) {
            //para totales
            let neto = 0,
                subtotal = 0,
                total = 0,
                igv = 0,
                moneda = 'S/';
            for (let i = 0; i < $tableItems.rows.length; i++) { //indexa la tabla nuevamente

                neto += parseFloat($tableItems.rows[i].querySelector('.precio-total-item').value);
            }
            subtotal = neto;
            if (descuento != 0) {
                subtotal = neto - ((parseFloat(descuento) * neto) / 100);
            }
            //para igv
            if ($incluyeIgv == 1) {
                igv = subtotal * 0.18;
            }
            let tipoMoneda = d.querySelector('input[name="tipo_moneda"]').value;
            if (tipoMoneda == 'dolares') {
                moneda = '$'
            }
            let precioEnvio = 0;

            let inputPEnvio =  d.querySelector('.precio-envio');
            if(inputPEnvio){
                if(!isNaN(inputPEnvio.value) && parseFloat(inputPEnvio.value) > 0){
                    precioEnvio = parseFloat(inputPEnvio.value);
                }
            }

            total = subtotal + igv + precioEnvio;

            $tableTotales.rows[0].children[1].querySelector('span').textContent = `${moneda}. ${neto.toFixed(2)}`;
            $tableTotales.rows[0].children[1].querySelector('input[name="oc_precio_neto"]').value = `${neto.toFixed(2)}`;
            $tableTotales.rows[2].children[1].querySelector('span').textContent = `${moneda}. ${subtotal.toFixed(2)}`;
            $tableTotales.rows[2].children[1].querySelector('input[name="oc_precio_subtotal"]').value =
                `${subtotal.toFixed(2)}`;
            $tableTotales.rows[3].children[1].querySelector('span').textContent = `${moneda}. ${igv.toFixed(2)}`;
            $tableTotales.rows[3].children[1].querySelector('input[name="oc_precio_igv"]').value = `${igv.toFixed(2)}`;

            $tableTotales.rows[4].children[1].querySelector('span').textContent = `${moneda}. ${precioEnvio.toFixed(2)}`;
            $tableTotales.rows[4].children[1].querySelector('input[name="oc_precio_envio"]').value =
                `${precioEnvio.toFixed(2)}`;

            $tableTotales.rows[5].children[1].querySelector('span').textContent = `${moneda}. ${(total).toFixed(2)}`;
            $tableTotales.rows[5].children[1].querySelector('input[name="oc_precio_total"]').value =
                `${(total).toFixed(2)}`;
        }

        function validacionOrdenCompraUpdate() {
            let errorTablaItems;

            if (!$tableItems.rows.length) { //si la tabla de items no tiene filas
                errorTablaItems = "Debe agregar almenos un item";
            } else {
                let contEmptyNomItem = 0,
                    contEmptyCantItem = 0,
                    contPreItem = 0;
                for (let i = 0; i < $tableItems.rows.length; i++) {
                    $tableItems.rows[i].querySelector('.nombre-item').value ? false : contEmptyNomItem++;
                    $tableItems.rows[i].querySelector('.cantidad-item').value ? false : contEmptyCantItem++;
                    $tableItems.rows[i].querySelector('.precio-unit-item').value ? false : contPreItem++;
                }
                //console.log(contEmptyNomItem,contEmptyCantItem,contPreItem);
                if (contEmptyNomItem != 0 || contEmptyCantItem != 0 || contPreItem != 0) {
                    errorTablaItems = "Algunos campos de la tabla items estan vacios";
                }
            }

            if (errorTablaItems ) {
                d.querySelector('.btn-orden-compra-update').removeAttribute('disabled');
                let listaErrors = '<ul>';
                listaErrors += errorTablaItems? `<li>${errorTablaItems}</li>`: '';
                listaErrors += '</ul>';
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    background: '#FEEFB3',
                    title: 'Errores',
                    html:listaErrors,
                    toast: true,
                    color: '#9f6000',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,

                })
            } else if (!errorTablaItems) {
                console.log('todo ok');
                d.getElementById('form-ordenCompra-update').submit();
            }
        }
