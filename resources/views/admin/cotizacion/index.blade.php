@extends('adminlte::page')

@section('title', 'Cotizacion')

@section('content_header')
    <h1>Generar Cotizacion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-7">
                    <div class="form-group">
                        <label>Empresa</label>
                        <select  class="form-control">
                            @foreach ($empresas as $emp)
                                <option value="">{{ $emp->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cliente</label>
                        <select name="" id="select-clientes" class="form-control">
                            @foreach ($clientes as $cli)
                                <option value="">{{ $cli->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-5">
                    <table class="table table-borderless">
                        <tr>
                            <th>Fecha Emision</th>
                            <td>
                                <input type="date" class="input-fecha-emision form-control ">
                            </td>
                        </tr>
                        <tr>
                            <th>Expiración</th>
                            <td>
                                <input type="number" class="form-control" value="10">
                            </td>
                        </tr>
                        <tr>
                            <th>Tiempo entrega</th>
                            <td>
                                <input type="number" class="form-control" value="5">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Forma de Pago</th>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 0">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="formaPago" checked class="form-check-input">
                                        <span>Contado</span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="formaPago" class="form-check-input">
                                        <span>Adelanto 50%</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <label>Referencia</label>
                        <input type="text" class="form-control" placeholder="referencia de busqueda(opcional)">
                    </div>


                </div>
            </div>
            <div class="form-group">
                <label>Introducción</label>
                <textarea rows="4" class="form-control">La presente es para saludarlo y a su vez enviarle la cotización solicitada
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
                    <div class="d-flex align-items-center justify-content-center col-4">
                        <button class="btn-agregar-item btn btn-secondary" disabled>Agregar Item</button>
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
                <textarea  rows="4" class="form-control">Sin otro particular, quedamos de Ustedes.</textarea>
            </div>

            <div class="mt-5">
                <div class="float-right">
                    <button class="btn btn-secondary">Cancelar</button>
                    <button class="btn btn-success">Generar PDF</button>
                    <button class="btn btn-primary">Guardar</button>
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
            $tableItems = d.querySelector(".table-items-cotizacion tbody"),
            $tableTotales = d.querySelector(".table-cotizacion-totales"),
            $inputDescuento = d.querySelector('.input-descuento'),
            $inputFechaEmision = d.querySelector('.input-fecha-emision');

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
            if(e.target.matches('.btn-delete-item')){
                let row = e.target.parentNode.parentNode;
                $tableItems.removeChild(row);

                for(let i=0; i<$tableItems.rows.length; i++){//indexa la tabla nuevamente
                    $tableItems.rows[i].childNodes[0].textContent = i+1;
                }

                calcularTotales($inputDescuento.value);
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
        })

        function calcularTotales(descuento = 0){

            //para totales
            let neto=0,total=0,igv;
            for(let i=0; i<$tableItems.rows.length; i++){//indexa la tabla nuevamente

                neto +=  parseFloat($tableItems.rows[i].querySelector('.precio-total-item').value);
            }
            total = neto;
            if(descuento!= 0){
                total =  neto - ((parseFloat(descuento) * neto)/100);
            }
            igv = total * 0.18;
            $tableTotales.rows[0].children[1].textContent = `S/. ${neto.toFixed(2)}`;
            $tableTotales.rows[2].children[1].textContent = `S/. ${total.toFixed(2)}`;
            $tableTotales.rows[3].children[1].textContent = `S/. ${igv.toFixed(2)}`;
            $tableTotales.rows[5].children[1].textContent = `S/. ${(total + igv).toFixed(2)}`;
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
