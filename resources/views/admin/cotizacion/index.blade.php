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
            $btnAddItem = d.querySelector(".btn-agregar-item");

            let selectCategoriaValue = 0 ;

        d.addEventListener("change", e => {
            if (e.target.matches('#select-cates-prods')) {
                selectCategoriaValue = e.target.value;
                $selectProds.innerHTML = "";
                $btnAddItem.setAttribute("disabled");
                if (e.target.value != 0) {

                    let uri = '{{ route('cotizacion.getProductsxCate', ':id') }}';
                    uri = uri.replace(':id', e.target.value);
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
@stop
