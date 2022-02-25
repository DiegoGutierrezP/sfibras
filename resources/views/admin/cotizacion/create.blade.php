@extends('adminlte::page')

@section('title', 'Cotizacion')

@section('content_header')
    <h1>Generar Cotizacion</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{route('admin.cotizacion.generar')}}" id="form-cotizacion" method="POST">
            @csrf
        <div class="card-header">
            <div class="content-valor-dolar float-right d-flex align-items-center ">
                <h5 class="pr-2" >Valor del dolar hoy:</h5>
                <div class="input-group" style="width: 120px">
                    <div class="input-group-prepend">
                    <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="valor_dolar"  class="form-control" readonly value="0">
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group">
                        <label>Empresa</label>
                        <select name="empresa_id" class="select-miEmpresa form-control">
                            @foreach ($empresas as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="content-select-clientes ">
                            <label>Cliente</label>
                            <select name="cliente_id" id="select-clientes" class="form-control">
                                @foreach ($clientes as $cli)
                                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="content-form-nuevo-cliente d-none">
                        <label>Nuevo Cliente</label>

                        <div id="form-nuevo-cliente">
                            <div class="form-group">
                                <label class="form-check-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreCliente" value="mrda"  placeholder="Nombre del Cliente">
                                <small class="error-nombre text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Dni</label>
                                <input type="text" class="form-control" name="dniCliente" placeholder="Dni del cliente">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Ruc</label>
                                <input type="text" class="form-control" name="rucCliente" placeholder="Ruc del cliente">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Telefono</label>
                                <input type="text" class="form-control" name="telefonoCliente" placeholder="Telefono del cliente">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Email</label>
                                <input type="text" class="form-control" name="emailCliente" placeholder="Email del cliente">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Dirección</label>
                                <input type="text" class="form-control" name="direccionCliente" placeholder="Direccion del cliente">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>Fecha Emision</th>
                            <td>
                                <input type="date" name="fecha_emision" class="input-fecha-emision form-control ">
                            </td>
                        </tr>
                        <tr>
                            <th>Expiración</th>
                            <td>
                                <input type="number" name="dias_expiracion" class="dias-expiracion form-control" value="10">
                            </td>
                        </tr>
                        <tr>
                            <th>Tiempo entrega</th>
                            <td>
                                <input type="number" name="tiempo_entrega" class="tiempo-entrega form-control" value="5">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Tipo de moneda</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="py-0">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="tipo_moneda" value="soles" checked class="tipo-moneda form-check-input">
                                        <span>Soles</span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="tipo_moneda" value="dolares" class="tipo-moneda radio-dolar form-check-input">
                                        <span>Dolares</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Opcionales</th>
                        </tr>
                        <tr>
                            <td  colspan="2" class="py-0">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-1">
                                        <input type="checkbox" name="cliente_nuevo" id="check-cliente-nuevo">
                                    <span>Cliente nuevo</span>
                                    </label>
                                    <label class="form-check-label mb-1">
                                        <input type="checkbox" id="check-sin-igv">
                                        <span>Sin IGV</span>
                                    </label>
                                    <label class="form-check-label mb-1">
                                        <input type="checkbox" id="">
                                        <span>Envio</span>
                                    </label>
                                </div>
                                <div class="content-envio-precio d-none">
                                    <table class="table p-0 m-0">
                                        <tr>
                                            <td width="50%"><label>Envio:</label></td>
                                            <td width="50%"><input type="number" class="form-control" placeholder="precio"></td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Forma de Pago</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="pt-0">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="formaPago" value="contado" checked class="form-check-input">
                                        <span>Contado</span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="formaPago" value="50adelanto" class="form-check-input">
                                        <span>Adelanto 50%</span>
                                    </label>
                                </div>
                            </td>
                        </tr>

                    </table>
                    <div class="form-group mt-4">
                        <label>Referencia</label>
                        <input type="text" name="referencia_cotizacion" class="referencia-cotizacion form-control" placeholder="referencia de busqueda(opcional)">
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label>Introducción</label>
                <textarea rows="4" name="intro_cotizacion" class="intro-cotizacion form-control">La presente es para saludarlo y a su vez enviarle la cotización solicitada
                </textarea>
            </div>
            <hr>
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
                        <select  id="select-prods" class="form-control my-3">
                            <option value="0">--Eliga un item--</option>
                        </select>
                        <div class="form-group d-none" id="content-medidas-señales">
                            <label>Medidas</label>
                            <table>
                                <tr>
                                    <td ><input type="number" disabled class="input-medidas form-control"></td>
                                    <td class="px-3">X</td>
                                    <td ><input type="number" disabled class="input-medidas form-control"></td>
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
                <table class="table-items-cotizacion table table-sm table-bordered">
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

                    </tbody>
                </table>
            </div>

            <div class="row position-relative my-4 ">
                    <div class="w-100">
                    <table class="table-cotizacion-totales table table-sm table-bordered">
                        <tr>
                            <td>Neto</td>
                            <td>
                                <input type="hidden" name="coti_precio_neto" value="">
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
                                    <input type="number" name="coti_descuento" class="input-descuento form-control" value="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sub Total</td>
                            <td>
                                <input type="hidden" name="coti_precio_subtotal" value="">
                                <span>S/ 0.00</span>
                            </td>
                        </tr>
                        <tr>
                            <td>IGV</td>
                            <td>
                                <input type="hidden" name="coti_precio_igv" value="">
                                <span>S/ 0.00</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Envio</td>
                            <td>
                                <input type="hidden" name="coti_precio_envio" value="">
                                <span>S/ 0.00</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>
                                <input type="hidden" name="coti_precio_total" value="">
                                <span>S/ 0.00</span>
                            </td>
                        </tr>
                    </table>
                    </div>
            </div>

            <div class="position relative">
                <label >Conclusión</label>
                <textarea  rows="4" name="conclusion_cotizacion" class="conclusion-cotizacion form-control">Sin otro particular, quedamos de Ustedes.</textarea>
            </div>

            <div class="mt-5">
                <div class="float-right">
                    <a href="{{route('admin.cotizacion.index')}}" class="btn btn-secondary">Cancelar</a>
                   {{--  <button class="btn-cotizacion-pdf btn btn-success">Generar</button> --}}
                    <button class="btn-cotizacion-guardar btn btn-primary">Generar</button>
                </div>
            </div>
        </div>
        </form>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        const d = document,
            $selectCategory = d.getElementById("select-cates-prods"),
            $selectProds = d.getElementById("select-prods"),
            $contentMedidasSen = d.getElementById("content-medidas-señales"),
            $btnAddItem = d.querySelector(".btn-agregar-item"),
            $btnAddFilaVacia = d.querySelector(".btn-agregar-fila-vacia"),
            $tableItems = d.querySelector(".table-items-cotizacion tbody"),
            $tableTotales = d.querySelector(".table-cotizacion-totales"),
            $inputDescuento = d.querySelector('.input-descuento'),
            $inputFechaEmision = d.querySelector('.input-fecha-emision'),
            $checkClientNew = d.getElementById('check-cliente-nuevo'),
            $checkSinIgv = d.getElementById('check-sin-igv');

        var selectCategoriaValue = 0 ;

        d.addEventListener("DOMContentLoaded", e=>{
            let today = new Date(),
            mes = today.getMonth()+1,
            dia = today.getDate(),
            anio = today.getFullYear();
            if(dia<10) dia='0'+dia; //agrega cero si el menor de 10
            if(mes<10) mes='0'+mes //agrega cero si el menor de 10
            $inputFechaEmision.value = anio+"-"+mes+"-"+dia;

            //select2 cdn
            $('#select-clientes').select2();

            //api dolar
            peticiones({
                url:'https://deperu.com/api/rest/cotizaciondolar.json',
                ops: {
                    method: "GET",
                    headers: {
                        'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    //mode:"cors"
                },
                success: json => {
                    d.querySelector('.content-valor-dolar')
                    .querySelector('input[name="valor_dolar"]')
                    .value=(json.Cotizacion[0].Venta);
                    //console.log(Math.round(json.Cotizacion[0].Venta*100)/100,json.Cotizacion[0].Venta)
                },
                error: err=> {
                    d.querySelector('.content-valor-dolar')
                    .querySelector('input[name="valor_dolar"]')
                    .value='0';
                    d.querySelector('.radio-dolar').setAttribute("disabled");
                }
            })

        })

        //evento para validar solo entrada de numeros enteros positivos
        d.addEventListener("input",e=>{
            if(e.target.matches(['.cantidad-item','.input-descuento','.input-medidas'])){
                let val = e.target.value;
                e.target.value = val.replace(/\D|\-/,'');
            }
            //--------------------------------------------------------------
            if(e.target.matches('.cantidad-item')){
                let cantidadItem = parseFloat(e.target.value),
                $inputPrecioTotal = e.target.parentNode.parentNode.querySelector('.precio-total-item'),
                $inputPrecioUnit = e.target.parentNode.parentNode.querySelector('.precio-unit-item');

                if(e.target.value){
                    $inputPrecioTotal.value = (parseFloat($inputPrecioUnit.value) * cantidadItem).toFixed(2);
                }
                if(e.target.value == ''){
                    $inputPrecioTotal.value = 0;
                }
                calcularTotales($inputDescuento.value);
            }
            if(e.target.matches('.precio-unit-item')){
                let precioUnitItem = parseFloat(e.target.value),
                $inputPrecioTotal = e.target.parentNode.parentNode.querySelector('.precio-total-item'),
                $inputCantItem = e.target.parentNode.parentNode.querySelector('.cantidad-item');

                if(e.target.value){
                    $inputPrecioTotal.value = (parseFloat($inputCantItem.value) * precioUnitItem).toFixed(2);
                }
                if(e.target.value == ''){
                    $inputPrecioTotal.value = 0;
                }
                calcularTotales($inputDescuento.value);
            }
            if(e.target.matches('.input-descuento')){
                //console.clear()
                //console.log(e.target.value);
                if(e.target.value){
                    calcularTotales(e.target.value);
                }else{
                    calcularTotales()
                }
            }
            //-------------------------------------------------------------
            if(e.target.matches('.input-medidas')){

                let medida1 = parseFloat(d.getElementsByClassName('input-medidas')[0].value),
                medida2 = parseFloat(d.getElementsByClassName('input-medidas')[1].value);

                console.log(typeof(medida1),medida1,typeof(medida2),medida2);
                if(medida1 && medida2){
                    $btnAddItem.removeAttribute("disabled");
                }else{
                    $btnAddItem.setAttribute("disabled");
                }
            }
        })

        d.addEventListener("keyup",e=>{


        })

        d.addEventListener("click",e =>{
            if(e.target.matches('.btn-agregar-item')){
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

                            if(selectCategoriaValue == 1){
                                let precioMedida = 1;
                                d.querySelectorAll('.input-medidas').forEach(el =>{
                                    precioMedida *= parseFloat(el.value)/100;

                                })
                                console.log(precioMedida);
                                precioUnit = (precioUnit * precioMedida).toFixed(2);
                            }
                            //TIPO MONEDA
                            let tipoMoneda = d.querySelector('input[name="tipo_moneda"]:checked').value;
                            if(tipoMoneda == 'dolares'){
                                let dolar = d.querySelector('input[name="valor_dolar"]').value;
                               //console.log((precioUnit / dolar).toFixed(2)) ;
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
                            cell1.innerHTML = `<span>${$tableItems.rows.length++}</span>`;
                            cell2.innerHTML = `<input type='text' name='items[${index}][nombre]' class='form-control' value='${descrip}'>`;
                            cell3.innerHTML = `<textarea rows="1" name='items[${index}][descrip]' class='form-control' placeholder='descripcion (opcional)'></textarea>`;
                            cell4.innerHTML = `<input type='number' name='items[${index}][cantidad]' min='1' class='cantidad-item form-control' value='1'>`;
                            cell5.innerHTML = `<input type='number' name='items[${index}][precioUnit]' class='precio-unit-item form-control' value='${precioUnit}'>`;
                            cell6.innerHTML = `<input type='number' name='items[${index}][precioTotal]' class='precio-total-item form-control' readonly value='${precioTotal}'>`;
                            cell7.innerHTML = `<a class='btn-delete-item btn btn-sm btn-danger'>X</a>`;

                            calcularTotales($inputDescuento.value);
                        },
                        error: err => console.log(err),
                    })
            }
            if(e.target.matches('.btn-agregar-fila-vacia')){
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
                            cell1.innerHTML = `<span>${$tableItems.rows.length++}</span>`;
                            cell2.innerHTML = `<input type='text' name='items[${index}][nombre]' class='form-control' value=''>`;
                            cell3.innerHTML = `<textarea rows="1" name='items[${index}][descrip]' class='form-control' placeholder='descripcion (opcional)'></textarea>`;
                            cell4.innerHTML = `<input type='number' name='items[${index}][cantidad]' min='1' class='cantidad-item form-control' value='1'>`;
                            cell5.innerHTML = `<input type='number' name='items[${index}][precioUnit]' class='precio-unit-item form-control' value='0.00'>`;
                            cell6.innerHTML = `<input type='number' name='items[${index}][precioTotal]' class='precio-total-item form-control' readonly value='0.00'>`;
                            cell7.innerHTML = `<a class='btn-delete-item btn btn-sm btn-danger'>X</a>`;
            }
            if(e.target.matches('.btn-delete-item')){
                let row = e.target.parentNode.parentNode;
                $tableItems.removeChild(row);

                for(let i=0; i<$tableItems.rows.length; i++){//indexa la tabla nuevamente
                    $tableItems.rows[i].childNodes[0].textContent = i+1;
                    $tableItems.rows[i].childNodes[1].childNodes[0].setAttribute("name",`items[${i}][nombre]`);
                    $tableItems.rows[i].childNodes[2].childNodes[0].setAttribute("name",`items[${i}][descrip]`);
                    $tableItems.rows[i].childNodes[3].childNodes[0].setAttribute("name",`items[${i}][cantidad]`);
                    $tableItems.rows[i].childNodes[4].childNodes[0].setAttribute("name",`items[${i}][precioUnit]`);
                    $tableItems.rows[i].childNodes[5].childNodes[0].setAttribute("name",`items[${i}][precioTotal]`);
                }

                calcularTotales($inputDescuento.value);
            }
            //Para botones generar
            if(e.target.matches('.btn-cotizacion-pdf')){
                e.preventDefault();
                validacionCotizacion();
            }
            if(e.target.matches('.btn-cotizacion-guardar')){
                e.preventDefault();
                validacionCotizacion();
            }
        })

        d.addEventListener("change", e => {
            if (e.target.matches('#select-cates-prods')) {
                selectCategoriaValue = e.target.value;
                $selectProds.innerHTML = "";
                $btnAddItem.setAttribute("disabled");
                d.querySelectorAll('.input-medidas').forEach(el =>{
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
                            //const $select = d.createElement('select');
                            //$select.classList.add('form-control');
                            let opt = '<option value="0" selected>--Eliga un item--</option>';
                            json.productos.forEach(el => {
                                opt +=
                                    `<option value="${el.id}">${el.descripcion_producto}</option>`
                            });
                            $selectProds.innerHTML = opt;
                            //$selectCategory.insertAdjacentElement("afterend",$select);
                            //$contentSelectProds.insertAdjacentElement("afterbegin", $select);
                            if(e.target.value == 1){
                                $contentMedidasSen.classList.remove('d-none');
                            }else{
                                if(!$contentMedidasSen.classList.contains('d-none')){
                                    $contentMedidasSen.classList.add('d-none');
                                }
                            }
                        },
                        error: err => console.log(err),
                    })
                }

            }

            if(e.target.matches("#select-prods")){

               if(e.target.value != 0){
                   if(selectCategoriaValue == 1 && e.target.value != 0){
                        d.querySelectorAll('.input-medidas').forEach(el =>{
                            el.removeAttribute("disabled");
                        })
                   }
                   if(selectCategoriaValue != 1){
                       $btnAddItem.removeAttribute("disabled");
                   }

               }else{
                    $btnAddItem.setAttribute("disabled");
                    d.querySelectorAll('.input-medidas').forEach(el =>{
                        el.setAttribute("disabled");
                        el.value = '';
                    })
               }
            }
            if(e.target.matches('#check-cliente-nuevo')){
                //console.log(e.target.checked);
                const $formNewClient = d.querySelector('.content-form-nuevo-cliente'),
                $selectClienteContent = d.querySelector('.content-select-clientes');
                if(e.target.checked){
                    $formNewClient.classList.remove('d-none');
                    $selectClienteContent.classList.add('d-none');

                }else{
                    $formNewClient.classList.add('d-none');
                    $selectClienteContent.classList.remove('d-none');

                }
            }
            if(e.target.matches('#check-sin-igv')){
                calcularTotales($inputDescuento.value);
            }
            if(e.target.matches('.tipo-moneda')){
                //console.log(e.target.value,d.querySelector('input[name="valor_dolar"]').value);
                let dolar = d.querySelector('input[name="valor_dolar"]').value;
                if(e.target.value == 'dolares'){

                    for(let i=0; i<$tableItems.rows.length; i++){//indexa la tabla nuevamente
                        let precioUnitSoles = $tableItems.rows[i].childNodes[4].childNodes[0].value;
                        let precioTotalSoles = $tableItems.rows[i].childNodes[5].childNodes[0].value;
                        $tableItems.rows[i].childNodes[4].childNodes[0].value = (precioUnitSoles/dolar).toFixed(2);
                        $tableItems.rows[i].childNodes[5].childNodes[0].value = (precioTotalSoles/dolar).toFixed(2);
                    }
                    calcularTotales($inputDescuento.value);
                }else if(e.target.value == 'soles'){
                    for(let i=0; i<$tableItems.rows.length; i++){//indexa la tabla nuevamente
                        let precioUnitSoles = $tableItems.rows[i].childNodes[4].childNodes[0].value;
                        let precioTotalSoles = $tableItems.rows[i].childNodes[5].childNodes[0].value;
                        $tableItems.rows[i].childNodes[4].childNodes[0].value = (precioUnitSoles*dolar).toFixed(2);
                        $tableItems.rows[i].childNodes[5].childNodes[0].value = (precioTotalSoles*dolar).toFixed(2);
                    }
                    calcularTotales($inputDescuento.value);
                }

            }

        })

        function calcularTotales(descuento = 0){
            //para totales
            let neto=0,total=0,igv=0,moneda = 'S/';
            for(let i=0; i<$tableItems.rows.length; i++){//indexa la tabla nuevamente

                neto +=  parseFloat($tableItems.rows[i].querySelector('.precio-total-item').value);
            }
            total = neto;
            if(descuento!= 0){
                total =  neto - ((parseFloat(descuento) * neto)/100);
            }
            //para igv
            if(!$checkSinIgv.checked){
                igv = total * 0.18;
            }
            let tipoMoneda = d.querySelector('input[name="tipo_moneda"]:checked').value;
            if(tipoMoneda == 'dolares'){
                moneda = '$';
            }

            $tableTotales.rows[0].children[1].querySelector('span').textContent = `${moneda}. ${neto.toFixed(2)}`;
            $tableTotales.rows[0].children[1].querySelector('input[name="coti_precio_neto"]').value = `${neto.toFixed(2)}`;
            $tableTotales.rows[2].children[1].querySelector('span').textContent = `${moneda}. ${total.toFixed(2)}`;
            $tableTotales.rows[2].children[1].querySelector('input[name="coti_precio_subtotal"]').value = `${total.toFixed(2)}`;
            $tableTotales.rows[3].children[1].querySelector('span').textContent = `${moneda}. ${igv.toFixed(2)}`;
            $tableTotales.rows[3].children[1].querySelector('input[name="coti_precio_igv"]').value = `${igv.toFixed(2)}`;
            $tableTotales.rows[5].children[1].querySelector('span').textContent = `${moneda}. ${(total + igv).toFixed(2)}`;
            $tableTotales.rows[5].children[1].querySelector('input[name="coti_precio_total"]').value = `${(total + igv).toFixed(2)}`;
        }

        function validacionCotizacion(){
            let errorFormCliente,errorTablaItems;

            if($checkClientNew.checked){//si el checked cliente esta marcado
                const $formCliente = d.getElementById("form-nuevo-cliente");
                let nombreCliente = $formCliente.querySelector('input[name="nombreCliente"]').value;
                if(!nombreCliente){

                    $formCliente.querySelector('.error-nombre').textContent = 'El campo nombre es obligatorio';
                    errorFormCliente = "Ingrese el nombre del cliente";
                }
            }

            if(!$tableItems.rows.length){//si la tabla de items no tiene filas
                errorTablaItems="Debe agregar almenos un item";
            }else{
                let contEmptyNomItem=0,contEmptyCantItem=0,contPreItem=0;
                for(let i=0; i<$tableItems.rows.length; i++){
                    $tableItems.rows[i].childNodes[1].childNodes[0].value? false :contEmptyNomItem++;
                    $tableItems.rows[i].childNodes[3].childNodes[0].value? false :contEmptyCantItem++;
                    $tableItems.rows[i].childNodes[4].childNodes[0].value? false :contPreItem++;
                }
                //console.log(contEmptyNomItem,contEmptyCantItem,contPreItem);
                if(contEmptyNomItem!=0 || contEmptyCantItem!=0 || contPreItem!=0){
                    errorTablaItems = "Algunos campos de la tabla items estan vacios";
                }
            }

            if(errorFormCliente || errorTablaItems){
                let listaErrors = '<ul>';
                listaErrors += errorFormCliente? `<li>${errorFormCliente}</li>`:'' ;
                listaErrors += errorTablaItems? `<li>${errorTablaItems}</li>`: '';
                listaErrors += '</ul>';
                if(errorFormCliente){
                    window.scrollTo({
                        behavior:"smooth",
                        top:0,
                    })
                }
                Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            background:'#FEEFB3',
                            title:'Errores',
                            html:listaErrors,
                            toast:true,
                            color: '#9f6000',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,

                    })
            }else if(!errorFormCliente && !errorTablaItems){
                console.log('todo ok');
                d.getElementById('form-cotizacion').submit();
            }
        }

        async function peticiones(options) {
            let {url,ops,success,error} = options;
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
@stop
