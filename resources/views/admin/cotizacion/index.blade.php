@extends('adminlte::page')

@section('title', 'Cotizacion')

@section('content_header')
    <h1>Generar Cotizacion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group">
                        <label>Empresa</label>
                        <select  class="select-miEmpresa form-control">
                            @foreach ($empresas as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="content-select-clientes ">
                            <label>Cliente</label>
                            <select name="" id="select-clientes" class="form-control">
                                @foreach ($clientes as $cli)
                                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="content-form-nuevo-cliente d-none">
                        <label>Nuevo Cliente</label>

                        <form id="form-nuevo-cliente">
                            <div class="form-group">
                                <label class="form-check-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="mrda"  placeholder="Nombre del Cliente">
                                <small class="error-nombre text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Dni</label>
                                <input type="text" class="form-control" name="dni" placeholder="Dni del cliente">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Ruc</label>
                                <input type="text" class="form-control" name="ruc" placeholder="Ruc del cliente">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Telefono</label>
                                <input type="text" class="form-control" name="telefono" placeholder="Telefono del cliente">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email del cliente">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Dirección</label>
                                <input type="text" class="form-control" name="direccion" placeholder="Direccion del cliente">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>Fecha Emision</th>
                            <td>
                                <input type="date" class="input-fecha-emision form-control ">
                            </td>
                        </tr>
                        <tr>
                            <th>Expiración</th>
                            <td>
                                <input type="number" class="dias-expiracion form-control" value="10">
                            </td>
                        </tr>
                        <tr>
                            <th>Tiempo entrega</th>
                            <td>
                                <input type="number" class="tiempo-entrega form-control" value="5">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Opcionales</th>
                        </tr>
                        <tr>
                            <td  colspan="2" class="py-0">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-1">
                                        <input type="checkbox" id="check-cliente-nuevo">
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
                                            <td width="50%"><input type="numer" class="form-control" placeholder="precio"></td>
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
                        <input type="text" class="referencia-cotizacion form-control" placeholder="referencia de busqueda(opcional)">
                    </div>


                </div>
            </div>
            <div class="form-group">
                <label>Introducción</label>
                <textarea rows="4" class="intro-cotizacion form-control">La presente es para saludarlo y a su vez enviarle la cotización solicitada
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
                            <th>Total S/.</th>
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
                            <td>S/ 0.00</td>
                        </tr>
                        <tr>
                            <td>Decuento</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">%</div>
                                    </div>
                                    <input type="number" class="input-descuento form-control" value="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sub Total</td>
                            <td>S/ 0.00</td>
                        </tr>
                        <tr>
                            <td>IGV</td>
                            <td>S/ 0.00</td>
                        </tr>
                        <tr>
                            <td>Envio</td>
                            <td>S/ 0.00</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>S/ 0.00</td>
                        </tr>
                    </table>
                    </div>
            </div>

            <div class="position relative">
                <label >Conclusión</label>
                <textarea  rows="4" class="conclusion-cotizacion form-control">Sin otro particular, quedamos de Ustedes.</textarea>
            </div>

            <div class="mt-5">
                <div class="float-right">
                    <button class="btn btn-secondary">Cancelar</button>
                    <button class="btn-cotizacion-pdf btn btn-success">Generar PDF</button>
                    <button class="btn-cotizacion-guardar btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>


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

                            let precioTotal = precioUnit;

                            let row = $tableItems.insertRow($tableItems.rows.length);
                            let cell1 = row.insertCell(0),
                                cell2 = row.insertCell(1),
                                cell3 = row.insertCell(2),
                                cell4 = row.insertCell(3),
                                cell5 = row.insertCell(4),
                                cell6 = row.insertCell(5),
                                cell7 = row.insertCell(6);
                            cell1.innerHTML = `<span>${$tableItems.rows.length++}</span>`;
                            cell2.innerHTML = `<input type='text' class='form-control' value='${descrip}'>`;
                            cell3.innerHTML = `<textarea rows="1" class='form-control' placeholder='descripcion (opcional)'></textarea>`;
                            cell4.innerHTML = `<input type='number' min='1' class='cantidad-item form-control' value='1'>`;
                            cell5.innerHTML = `<input type='number' class='precio-unit-item form-control' value='${precioUnit}'>`;
                            cell6.innerHTML = `<input type='number' class='precio-total-item form-control' disabled value='${precioTotal}'>`;
                            cell7.innerHTML = `<a class='btn-delete-item btn btn-sm btn-danger'>X</a>`;

                            calcularTotales($inputDescuento.value);
                        },
                        error: err => console.log(err),
                    })
            }
            if(e.target.matches('.btn-agregar-fila-vacia')){
                e.preventDefault();
                let row = $tableItems.insertRow($tableItems.rows.length);
                            let cell1 = row.insertCell(0),
                                cell2 = row.insertCell(1),
                                cell3 = row.insertCell(2),
                                cell4 = row.insertCell(3),
                                cell5 = row.insertCell(4),
                                cell6 = row.insertCell(5),
                                cell7 = row.insertCell(6);
                            cell1.innerHTML = `<span>${$tableItems.rows.length++}</span>`;
                            cell2.innerHTML = `<input type='text' class='form-control' value=''>`;
                            cell3.innerHTML = `<textarea rows="1" class='form-control' placeholder='descripcion (opcional)'></textarea>`;
                            cell4.innerHTML = `<input type='number' min='1' class='cantidad-item form-control' value='1'>`;
                            cell5.innerHTML = `<input type='number' class='precio-unit-item form-control' value='0.00'>`;
                            cell6.innerHTML = `<input type='number' class='precio-total-item form-control' disabled value='0.00'>`;
                            cell7.innerHTML = `<a class='btn-delete-item btn btn-sm btn-danger'>X</a>`;
            }
            if(e.target.matches('.btn-delete-item')){
                let row = e.target.parentNode.parentNode;
                $tableItems.removeChild(row);

                for(let i=0; i<$tableItems.rows.length; i++){//indexa la tabla nuevamente
                    $tableItems.rows[i].childNodes[0].textContent = i+1;
                }

                calcularTotales($inputDescuento.value);
            }
            //Para botones generar
            if(e.target.matches('.btn-cotizacion-pdf')){
                validacionCotizacion();
            }
            if(e.target.matches('.btn-cotizacion-guardar')){
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
        })

        function calcularTotales(descuento = 0){
            //para totales
            let neto=0,total=0,igv=0;
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

            $tableTotales.rows[0].children[1].textContent = `S/. ${neto.toFixed(2)}`;
            $tableTotales.rows[2].children[1].textContent = `S/. ${total.toFixed(2)}`;
            $tableTotales.rows[3].children[1].textContent = `S/. ${igv.toFixed(2)}`;
            $tableTotales.rows[5].children[1].textContent = `S/. ${(total + igv).toFixed(2)}`;
        }

        function validacionCotizacion(){
            let errorFormCliente,errorTablaItems;

            if($checkClientNew.checked){//si el checked cliente esta marcado
                const $formCliente = d.getElementById("form-nuevo-cliente");
                if(!$formCliente.nombre.value){
                    console.log($formCliente.nombre.value);
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
                            color: '#333',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,

                    })
            }else if(!errorFormCliente && !errorTablaItems){
                let empresa_id = d.querySelector(".select-miEmpresa").value,
                fecha_emision = $inputFechaEmision.value,
                dias_expiracion =  d.querySelector(".dias-expiracion").value,
                tiempo_entrega = d.querySelector(".tiempo-entrega").value,
                forma_pago =  d.querySelector('input[name="formaPago"]:checked').value,
                referencia = d.querySelector('.referencia-cotizacion').value? d.querySelector('.referencia-cotizacion').value : '',
                introduccion = d.querySelector('.intro-cotizacion').value,
                conclusion = d.querySelector('.conclusion-cotizacion').value;

                let clienteNuevo,cliente_id;
                if($checkClientNew.checked){
                     const $formCliente = d.getElementById("form-nuevo-cliente");
                     clienteNuevo = {
                         nombre: $formCliente.nombre.value,
                         dni:$formCliente.dni.value,
                         ruc:$formCliente.ruc.value,
                         telefono:$formCliente.telefono.value,
                         email:$formCliente.email.value,
                         direc:$formCliente.direccion.value,
                     }
                    //console.log(clienteNuevo);
                }else{
                    cliente_id = d.getElementById('select-clientes').value;
                    //console.log(cliente_id)
                }
                let items = [];
                for(let i=0; i<$tableItems.rows.length; i++){
                    let objItem = {
                        item: $tableItems.rows[i].childNodes[0].textContent,
                        nombre: $tableItems.rows[i].childNodes[1].childNodes[0].value,
                        descrip: $tableItems.rows[i].childNodes[2].childNodes[0].value,
                        cantidad:$tableItems.rows[i].childNodes[3].childNodes[0].value,
                        precioUnit:$tableItems.rows[i].childNodes[4].childNodes[0].value,
                        total: $tableItems.rows[i].childNodes[5].childNodes[0].value
                    }
                    items.push(objItem);
                }

                let cotizacionTotales = {
                    neto:$tableTotales.rows[0].children[1].textContent ,
                    subTotal:$tableTotales.rows[2].children[1].textContent ,
                    igv:$tableTotales.rows[3].children[1].textContent ,
                    envio:$tableTotales.rows[4].children[1].textContent ,
                    total:$tableTotales.rows[5].children[1].textContent ,
                }


                //console.log(fecha_emision,dias_expiracion,tiempo_entrega,forma_pago,referencia);
                //console.log(items,cotizacionTotales);

                let datosCotizacion = {
                    empresa_id,
                    fecha_emision,
                    dias_expiracion ,
                    tiempo_entrega ,
                    forma_pago ,
                    referencia ,
                    introduccion,
                    conclusion ,
                    clienteNuevo,
                    cliente_id,
                    items,
                    cotizacionTotales,
                }
                //console.log(JSON.stringify(datosCotizacion));

                //let uri = '{{ route('cotizacion.guardarCotizacion') }}';
                peticiones({
                    url: '{{ route('cotizacion.guardarCotizacion') }}',
                    ops:{
                        method:'POST',
                        headers: {
                            "Content-type": "application/json; charset=utf-8",
                            "X-CSRF-TOKEN":"{{csrf_token()}}"
                        },
                        body:JSON.stringify(datosCotizacion),
                    },
                    success: json => console.log(json),
                    error: err => console.log(err),
                })
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
