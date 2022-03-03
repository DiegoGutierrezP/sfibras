<div>
<form action="{{route('admin.ordenCompra.store')}}" id="form-ordenCompra-crear" method="POST" >
    @csrf
    <div class="card">
        <div class="card-header">
            <h5>Cotizacion relacionada : {{ $cotizacion->codigoCoti }}</h5>
            <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
        </div>
        <div class="card-body">
            <div class="row mb-3">

                <div class="col-lg-6 col-md-6 col-12 p-2">
                    <h5>Datos del Cliente</h5>
                    <table class="table">
                        <tr>
                            <th>Cliente:</th>
                            <td>{{ $cotizacion->cliente->nombre }}</td>
                        </tr>
                        <tr>
                            <th>ruc:</th>
                            <td>{{ $cotizacion->cliente->ruc }}</td>
                        </tr>
                        <tr>
                            <th>dni:</th>
                            <td>{{ $cotizacion->cliente->dni }}</td>
                        </tr>
                        <tr>
                            <th>telefono:</th>
                            <td>{{ $cotizacion->cliente->telefono }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $cotizacion->cliente->email }}</td>
                        </tr>
                        <tr>
                            <th>Direccion:</th>
                            <td>{{ $cotizacion->cliente->direccion }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 col-md-6 col-12 p-2">
                    <h5>Condiciones Generales</h5>
                    <table class="table">
                        <tr>
                            <th>Precios:</th>
                            <td><input type="hidden" name="incluye_igv"
                                    value="{{ $cotizacion->precioIgvCoti == 0 ? 0 : 1 }}">{{ $cotizacion->precioIgvCoti == 0 ? 'No Incluye IGV' : 'Incluye IGV' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Forma de Pago:</th>
                            <td>{{ $cotizacion->formaPago }}</td>
                        </tr>
                        <tr>
                            <th>Tiempo Entrega:</th>
                            <td>{{ $cotizacion->tiempoEntrega }}</td>
                        </tr>
                        <tr>
                            <th>Moneda:</th>
                            <td><input type="hidden" name="tipo_moneda"
                                    value="{{ $cotizacion->tipoMoneda }}">{{ $cotizacion->tipoMoneda }}</td>
                        </tr>
                        @if ($cotizacion->tipoMoneda == 'dolares')
                            <tr>
                                <th>Valor Dolar:</th>
                                <td><input type="hidden" name="valor_dolar"
                                        value="{{ $cotizacion->valorDolar }}">{{ $cotizacion->valorDolar }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Entrega Estimada</th>
                            <td><input type="number" name="entrega_estimada" class="entrega-estimada form-control" placeholder="en dias"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <label for="">Observaciones:</label>
                <textarea cols="3" class="form-control" name="observaciones_oc"></textarea>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>Elija una categoria</label>
                <div class="row">
                    <div class="col-8">
                        <select name="" id="select-cates-prods" class="form-control">
                            <option value="0" selected>--Eliga una Categoria--</option>
                            @foreach ($catesprod as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->nombre }}</option>
                            @endforeach
                        </select>
                        <select id="select-prods" class="form-control my-3">
                            <option value="0">--Eliga un item--</option>
                        </select>
                        <div class="form-group d-none" id="content-medidas-señales">
                            <label>Medidas</label>
                            <table>
                                <tr>
                                    <td><input type="number" disabled class="input-medidas form-control"></td>
                                    <td class="px-3">X</td>
                                    <td><input type="number" disabled class="input-medidas form-control"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center col-4">
                        <button class="btn-agregar-item btn btn-sfibras mb-3" disabled>Agregar Item</button>
                        <a href="" class="btn-agregar-fila-vacia">Agregar Fila Vacia</a>
                    </div>
                </div>

            </div>

            <hr>

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
                        @foreach ($cotizacion->items as $i => $item)
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
        <div class="card-footer">
            <div class="float-right">
                <a href="{{route('admin.cotizacion.index')}}" class="btn btn-secondary">Cancelar</a>
                <button class="btn-orden-compra-registrar btn btn-primary">Generar</button>
            </div>
        </div>
    </div>
</form>
</div>

@push('js')
    <script>
        const d = document,
            $selectProds = d.getElementById("select-prods"),
            $contentMedidasSen = d.getElementById("content-medidas-señales"),
            $btnAddItem = d.querySelector(".btn-agregar-item"),
            $btnAddFilaVacia = d.querySelector(".btn-agregar-fila-vacia"),
            $tableItems = d.querySelector(".table-items-oc tbody"),
            $tableTotales = d.querySelector(".table-oc-totales"),
            $inputDescuento = d.querySelector('.input-descuento'),
            $inputFechaEmision = d.querySelector('.input-fecha-emision'),
            $checkClientNew = d.getElementById('check-cliente-nuevo'),
            $incluyeIgv = d.querySelector('input[name="incluye_igv"]').value,
            $checkEnvio = d.getElementById('check-envio');

        var selectCategoriaValue = 0;

        d.addEventListener("DOMContentLoaded", e => {
            /* let today = new Date(),
            mes = today.getMonth()+1,
            dia = today.getDate(),
            anio = today.getFullYear();
            if(dia<10) dia='0'+dia; //agrega cero si el menor de 10
            if(mes<10) mes='0'+mes //agrega cero si el menor de 10
            $inputFechaEmision.value = anio+"-"+mes+"-"+dia;
     */

            setTimeout(() => {
                calcularTotales();
            }, 300);
        })

        //evento para validar solo entrada de numeros enteros positivos
        d.addEventListener("input", e => {
            if (e.target.matches(['.cantidad-item', '.input-descuento', '.input-medidas', '.precio-envio','.entrega-estimada'])) {
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
            if(e.target.matches('.btn-orden-compra-registrar')){
                e.preventDefault();
                validacionOrdenCompra();
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

                    let uri = '{{ route('cotizacion.getProductsxCate', ':id') }}';
                    uri = uri.replace(':id', e.target.value);
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
            /* if($checkEnvio.checked){
                precioEnvio = d.querySelector('.precio-envio').value;
                if(!isNaN(precioEnvio) && parseFloat(precioEnvio) > 0){
                    precioEnvio = parseFloat(precioEnvio);
                }else{
                    precioEnvio = 0;
                }
            } */

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

        function validacionOrdenCompra() {
            let errorInputEntrega,errorTablaItems;
            let inputEntregaEstimada = d.querySelector('input[name="entrega_estimada"]');

            if(inputEntregaEstimada.value == null || inputEntregaEstimada.value== 0){
                errorInputEntrega = "El campo entrega estimada es necesario";
            }

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

            if (errorTablaItems || errorInputEntrega) {
                let listaErrors = '<ul>';
                listaErrors += errorInputEntrega? `<li>${errorInputEntrega}</li>`:'' ;
                listaErrors += errorTablaItems? `<li>${errorTablaItems}</li>`: '';
                listaErrors += '</ul>';
                if(errorInputEntrega){
                    inputEntregaEstimada.classList.add('is-invalid');
                    const topPos = inputEntregaEstimada.getBoundingClientRect().top + window.pageYOffset
                    window.scrollTo({
                        top: topPos - 160, // scroll so that the element is at the top of the view
                        behavior: 'smooth' // smooth scroll
                    })
                }
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    background: '#FEEFB3',
                    title: 'Errores',
                    html: listaErrors,
                    toast: true,
                    color: '#9f6000',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,

                })
            } else if (!errorTablaItems) {
                console.log('todo ok',inputEntregaEstimada.value == null || inputEntregaEstimada.value== 0?'ga':'ga2');
                d.getElementById('form-ordenCompra-crear').submit();
            }
        }

        async function peticiones(options) {
            let {
                url,
                ops,
                success,
                error
            } = options;
            try {
                let res = await fetch(url, ops),
                    json = await res.json();

                if (!res.ok) throw {
                    status: res.status,
                    statusText: res.statusText
                };
                //console.log(json);
                success(json);
            } catch (err) {
                console.log(err);
                error(err);
            }
        }
    </script>
@endpush
