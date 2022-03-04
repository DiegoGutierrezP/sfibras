@extends('adminlte::page')

@section('title', 'Orden de Compra')

@section('content_header')
    <h1>Registrar Orden de Compra</h1>
@stop

@section('content')


@if (is_null($cotizacion))
    @include('admin.ordenCompra.create-info-nosent')
@else
    @include('admin.ordenCompra.create-info-sent')
@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
{{-- <script>
    const d = document,
        $selectProds = d.getElementById("select-prods"),
        $contentMedidasSen = d.getElementById("content-medidas-señales"),
        $btnAddItem = d.querySelector(".btn-agregar-item"),
        $btnAddFilaVacia = d.querySelector(".btn-agregar-fila-vacia"),
        $tableItems = d.querySelector(".table-items-cotizacion tbody"),
        $tableTotales = d.querySelector(".table-cotizacion-totales"),
        $inputDescuento = d.querySelector('.input-descuento'),
        $inputFechaEmision = d.querySelector('.input-fecha-emision'),
        $checkClientNew = d.getElementById('check-cliente-nuevo'),
        $checkSinIgv = d.getElementById('check-sin-igv'),
        $checkEnvio = d.getElementById('check-envio');

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
        if(e.target.matches(['.cantidad-item','.input-descuento','.input-medidas','.precio-envio'])){
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
        //---------------------------------------------
        if(e.target.matches('.precio-envio')){
            calcularTotales($inputDescuento.value);
        }
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
        if(e.target.matches('#check-envio')){
            const $contentEnvio = d.querySelector(".content-envio-precio");
            if(e.target.checked){
                $contentEnvio.classList.remove('d-none');
            }else{
                $contentEnvio.classList.add('d-none');
                d.querySelector('.precio-envio').value = '';
                calcularTotales($inputDescuento.value);
            }
        }

    })

    function calcularTotales(descuento = 0){
        //para totales
        let neto=0,subtotal=0,total=0,igv=0,moneda = 'S/';
        for(let i=0; i<$tableItems.rows.length; i++){//indexa la tabla nuevamente

            neto +=  parseFloat($tableItems.rows[i].querySelector('.precio-total-item').value);
        }
        subtotal = neto;
        if(descuento!= 0){
            subtotal =  neto - ((parseFloat(descuento) * neto)/100);
        }
        //para igv
        if(!$checkSinIgv.checked){
            igv = subtotal * 0.18;
        }
        let tipoMoneda = d.querySelector('input[name="tipo_moneda"]:checked').value;
        if(tipoMoneda == 'dolares'){
            moneda = '$';
        }
        let precioEnvio = 0;
        if($checkEnvio.checked){
            precioEnvio = d.querySelector('.precio-envio').value;
            if(!isNaN(precioEnvio) && parseFloat(precioEnvio) > 0){
                precioEnvio = parseFloat(precioEnvio);
            }else{
                precioEnvio = 0;
            }
        }

        total = subtotal + igv + precioEnvio;

        $tableTotales.rows[0].children[1].querySelector('span').textContent = `${moneda}. ${neto.toFixed(2)}`;
        $tableTotales.rows[0].children[1].querySelector('input[name="coti_precio_neto"]').value = `${neto.toFixed(2)}`;
        $tableTotales.rows[2].children[1].querySelector('span').textContent = `${moneda}. ${subtotal.toFixed(2)}`;
        $tableTotales.rows[2].children[1].querySelector('input[name="coti_precio_subtotal"]').value = `${subtotal.toFixed(2)}`;
        $tableTotales.rows[3].children[1].querySelector('span').textContent = `${moneda}. ${igv.toFixed(2)}`;
        $tableTotales.rows[3].children[1].querySelector('input[name="coti_precio_igv"]').value = `${igv.toFixed(2)}`;

        $tableTotales.rows[4].children[1].querySelector('span').textContent = `${moneda}. ${precioEnvio.toFixed(2)}`;
        $tableTotales.rows[4].children[1].querySelector('input[name="coti_precio_envio"]').value = `${precioEnvio.toFixed(2)}`;

        $tableTotales.rows[5].children[1].querySelector('span').textContent = `${moneda}. ${(total).toFixed(2)}`;
        $tableTotales.rows[5].children[1].querySelector('input[name="coti_precio_total"]').value = `${(total).toFixed(2)}`;
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
</script> --}}
@stop
