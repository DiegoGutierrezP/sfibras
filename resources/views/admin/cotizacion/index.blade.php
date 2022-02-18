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
                        <select name="" id="" class="form-control">
                            @foreach ($empresas as $emp)
                                <option value="">{{ $emp->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cliente</label>
                        <select name="" id="" class="form-control">
                            @foreach ($empresas as $emp)
                                <option value="">{{ $emp->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-5">
                    <table class="table table-borderless">
                        <tr>
                            <th>Fecha Emision</th>
                            <td>
                                <input type="date" class="form-control ">
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
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                        value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Contado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                        value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Adelanto 50%</label>
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
                <textarea cols="30" rows="5" class="form-control"></textarea>
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
                                    <td ><input type="number" class="form-control"></td>
                                    <td class="px-3">X</td>
                                    <td ><input type="number" class="form-control"></td>
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
                <table class="table-items table table-sm table-bordered">
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
            $tableItems = d.querySelector(".table-items tbody");
            var selectCategoriaValue = 0 ;

        d.addEventListener("keyup",e=>{
            if(e.target.matches('.input-precio-prod')){
                let prepro = e.target.value,
                $inputPrecioTotal = e.target.parentNode.parentNode.childNodes[5].querySelector('.precio-total-item');

                console.log($inputPrecioTotal.value);

            }
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
                            console.log(json.producto.precio);

                            let row = $tableItems.insertRow($tableItems.rows.length);
                            let cell1 = row.insertCell(0),
                                cell2 = row.insertCell(1),
                                cell3 = row.insertCell(2),
                                cell4 = row.insertCell(3),
                                cell5 = row.insertCell(4),
                                cell6 = row.insertCell(5),
                                cell7 = row.insertCell(6);
                            cell1.innerHTML = `<span>${$tableItems.rows.length++}</span>`;
                            cell2.innerHTML = `<input type='text' class='form-control' value='${json.producto.descripcion_producto}'>`;
                            cell3.innerHTML = `<textarea rows="1" class='form-control' placeholder='descripcion (opcional)'></textarea>`;
                            cell4.innerHTML = `<input type='number' class='input-precio-prod form-control' value='1'>`;
                            cell5.innerHTML = `<input type='number' class='form-control' value='${json.producto.precio}'>`;
                            cell6.innerHTML = `<input type='number' class='precio-total-item form-control' disabled value='${json.producto.precio}'>`;
                            cell7.innerHTML = `<a class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>`;

                        },
                        error: err => console.log(err),
                    })
            }
        })


        d.addEventListener("change", e => {
            if (e.target.matches('#select-cates-prods')) {
                selectCategoriaValue = e.target.value;
                $selectProds.innerHTML = "";
                $btnAddItem.setAttribute("disabled");
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
                   if(selectCategoriaValue != 1){
                       $btnAddItem.removeAttribute("disabled");
                   }
               }else{
                    $btnAddItem.setAttribute("disabled");
               }
            }
        })


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
