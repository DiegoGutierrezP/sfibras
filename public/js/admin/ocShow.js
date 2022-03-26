import ajaxFetch from "../../helpers/ajaxFetch.js";

const d = document;
var idOC = d.querySelector(".id-oc").value;
const $tableFiles = d.querySelector('.table-files-oc tbody');

let $formAddPago = d.querySelector('#addPagoModal #form-add-pago-oc'),
    $formUpdatePago = d.querySelector('#updatePagoModal #form-update-pago-oc');
let $errorDatePagoAdd = $formAddPago.querySelector('.validate-date'),
    $errorMontoPagoAdd = $formAddPago.querySelector('.validate-pago'),
    $errorFormaPagoAdd = $formAddPago.querySelector('.validate-forma-pago'),
    $errorFilePagoAdd = $formAddPago.querySelector('.validate-file'),
    $errorDatePagoEdit = $formUpdatePago.querySelector('.validate-date'),
    $errorMontoPagoEdit = $formUpdatePago.querySelector('.validate-pago'),
    $errorFormaPagoEdit = $formUpdatePago.querySelector('.validate-forma-pago'),
    $errorFilePagoEdit = $formUpdatePago.querySelector('.validate-file');
const $tablePagosOC = d.querySelector(".table-pagos-oc tbody");


document.addEventListener("DOMContentLoaded", async () => {
    await cargarStepsDate();
    await cargarFilesOC();
    let res1 = await cargarPagosOC();
    //await calcularInfoPagos();//espera la respuesta de cargarPagosOC


});

d.addEventListener("click", e=>{
    //show-control-files***************************************************************************************
    if(e.target.matches('.step-action')){
        let date = e.target.parentNode.querySelector('.step-date').textContent;
        let obs = e.target.parentNode.querySelector('.step-date').dataset.obs;

        let dateInicio = d.querySelector(".step-inicio");
        let dateFinal = d.querySelector(".step-final");
        let stepTrabajando = d.querySelector(".step-trabajando");
        let dateEntrega = d.querySelector(".step-entrega");
        let bandera = false;
        if(e.target.dataset.step == 'inicio'){
            $("#controlOCModal").find(".modal-title").text('Fecha de Inicio');
            bandera =true;
        }else if(dateInicio.classList.contains('completed') && e.target.dataset.step == 'final'){
            $("#controlOCModal").find(".modal-title").text('Fecha de Final');
            bandera =true;
        }else if(dateFinal.classList.contains('completed') && e.target.dataset.step == 'entrega'){
            $("#controlOCModal").find(".modal-title").text('Fecha de Entrega');
            bandera =true;
        }
        if(bandera){
            $("#controlOCModal").find(".modal-body .data-step").val(e.target.dataset.step);
            $("#controlOCModal").find(".modal-body .fecha-step").val(date);
            $("#controlOCModal").find(".modal-body .obs-step").val(obs);
            $("#controlOCModal").find(".modal-body .validate-date").text('');
            $("#controlOCModal").modal('show');
        }

    }
    //--------------------------------------------------------------------------------------------
    if(e.target.matches('.guardar-fechas-oc')){
        let date = $("#controlOCModal").find(".modal-body .fecha-step").val();
        let obs = $("#controlOCModal").find(".modal-body .obs-step").val();
        let dataStep = $("#controlOCModal").find(".modal-body .data-step").val();
        //let url = '{{ route('admin.ordenCompra.updateDatesOC') }}';
        if(date != ''){
            ajaxFetch({
                url:urlUpdateDatesOC,
                ops:{
                    method:"PUT",
                    headers: {
                        "Content-type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        codigoOC: idOC,
                        date:date,
                        dataStep:dataStep,
                        obsStep:obs
                    })
                },
                success: json =>{
                    $("#controlOCModal").modal('hide');
                    swalSuccess(json.data.icon,json.data.msg)
                    //console.log(json,idOC);
                    cargarStepsDate();
                },
                error:err=>{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: err,
                        background:'#D8000C',
                        toast:true,
                        color: '#FFD2D2',
                        showConfirmButton: false,
                    })
                }
            });
        }else{
            $("#controlOCModal").find(".modal-body .validate-date").text('Debe ingresar la fecha');
        }
    }
    //-----------------------------------------------------------------------------------------
    if(e.target.matches('.link-file')){
        e.preventDefault();
        showFileModal(e.target.dataset.type,e.target.dataset.file);
    }
    //----------------------------------------------------------------------------------------
    if(e.target.matches('.btn-add-file-oc')){
        e.preventDefault();
        let $formAddFile = d.getElementById('form-add-file');
        let $inputFile = $formAddFile.file_OC,
        $descripFile = $formAddFile.descrip_file_OC,
        $errorFile = d.querySelector('#addFileModal .validate-file');

        $inputFile.value= '';
        $errorFile.textContent = '';$descripFile.value='';
        d.querySelector('.add-file-oc').removeAttribute('disabled');
        $("#addFileModal").modal("show");
    }
    //-------------------------------------------------------------------------------------
    if(e.target.matches('.add-file-oc')){
        e.preventDefault();
        e.target.setAttribute('disabled');

        let $formAddFile = d.getElementById('form-add-file');
        let $inputFile = $formAddFile.file_OC,
        $errorFile = d.querySelector('#addFileModal .validate-file');

        let bandera = validateFile($inputFile,$errorFile);
        if(bandera){
            //let url = '{{ route('admin.files.addFilesOC') }}';
            ajaxFetch({
                url:urlAddFilesOC,
                ops:{
                    method:"POST",
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    body: new FormData($formAddFile),
                },
                success: json =>{
                    $("#addFileModal").modal("hide");
                    cargarFilesOC();
                    swalSuccess(json.data.icon,json.data.msg);
                },
                error:err=>{
                    console.log(err)
                }
            });
        }else{
            e.target.removeAttribute('disabled');
        }
    }
    //------------------------------------------------------------------------------
    if(e.target.matches(['.btn-edit-file','.btn-edit-file *'])){
        const $inputFile = d.querySelector('#updateFileModal #file-update-OC');
        let $errorFile = d.querySelector('#updateFileModal .validate-file'),
        $descripFile = d.querySelector('#updateFileModal .descrip-file-oc');
        $inputFile.value= '';
        $errorFile.textContent = '';$descripFile.value='';
        d.querySelector('.btn-update-file-oc').removeAttribute('disabled');
        $("#updateFileModal").find('.modal-body #id_file').val(e.target.dataset.file);
        $("#updateFileModal").find('.modal-body .descrip-file-oc').val(e.target.dataset.descrip);
        $("#updateFileModal").modal('show');
    }
    //-----------------------------------
    if(e.target.matches('.btn-update-file-oc')){
        e.preventDefault();
        e.target.setAttribute('disabled');
        const $inputFile = d.querySelector('#updateFileModal #file-update-OC');
        let $errorFile = d.querySelector('#updateFileModal .validate-file'),
        $formUpdateFile = d.getElementById('form-edit-file');
        let bandera = validateFile($inputFile,$errorFile,'noNecesary');
        if(bandera){
            //let url = '{{ route('admin.files.updateFilesOC') }}';
            ajaxFetch({
                url:urlUpdateFilesOC,
                ops:{
                    method:"POST",
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    body: new FormData($formUpdateFile),
                },
                success: json =>{
                    $("#updateFileModal").modal("hide");
                    cargarFilesOC();
                    swalSuccess(json.data.icon,json.data.msg);

                },
                error:err=>{
                    console.log(err)
                }
            });
        }else{
            e.target.removeAttribute('disabled');
        }
    }
    //-----------------------------------------------------------------------------------
    if(e.target.matches(['.btn-delete-file','.btn-delete-file *'])){
        Swal.fire({
            title: 'Esta seguro?',
            text: "Se eliminara el archivo",
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            cancelButtonText:'Cancelar',
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            if(result.value) {
                //let url = '{{ route('admin.files.deleteFilesOC', ':id') }}';
                let urlDeleteFilesOC2 = urlDeleteFilesOC.replace(':id', e.target.dataset.file);
                ajaxFetch({
                    url:urlDeleteFilesOC2,
                    ops:{
                        method:"DELETE",
                        headers: {
                            "Content-type": "application/json; charset=utf-8",
                            "X-CSRF-TOKEN": token
                        }
                    },
                    success: json =>{
                        cargarFilesOC();
                        swalSuccess(json.data.icon,json.data.msg);
                    },
                    error:err=>{
                        console.log(err)
                    }
                });
            }
        })
    }
    //PAGOS******************************************************************************************
    if(e.target.matches('.btn-add-pago-oc')){
        $errorDatePagoAdd.textContent = '';
        $errorMontoPagoAdd.textContent = '';
        $errorFormaPagoAdd.textContent = '';
        $errorFilePagoAdd.textContent = '';
        $formAddPago.reset();
        d.querySelector('.btn-registrar-pago-oc').removeAttribute('disabled');
        $("#addPagoModal").modal('show');
    }
    //----------------------------------
    if(e.target.matches('.btn-registrar-pago-oc')){
        e.target.setAttribute('disabled');
        $errorDatePagoAdd.textContent = '';
        $errorMontoPagoAdd.textContent = '';
        $errorFormaPagoAdd.textContent = '';
        $errorFilePagoAdd.textContent = '';
        let bandera = true;
        if($formAddPago.fecha_pago_oc.value == '' || $formAddPago.pago_oc.value == '' || $formAddPago.forma_pago_oc.value == ''){
            $formAddPago.fecha_pago_oc.value == ''?$errorDatePagoAdd.textContent = 'Ingrese la fecha de pago':false;
            $formAddPago.pago_oc.value == ''?$errorMontoPagoAdd.textContent = 'Ingrese la monto de pago':false;
            $formAddPago.forma_pago_oc.value == ''?$errorFormaPagoAdd.textContent = 'Seleccione un tipo de pago':false;
            bandera=false;
        }
        $formAddPago.file_pago_oc.value!='' ? bandera = validateFile($formAddPago.file_pago_oc, $errorFilePagoAdd,'noNecesary'):false;

        if($formAddPago.pago_oc.value != ''){
            let montoRestante = d.querySelector('.table-info-pagos .cell-total-restante input[name="hidden_monto_restante"]').value;
            if(parseFloat($formAddPago.pago_oc.value) > Math.round(parseFloat(montoRestante))){
                bandera=false;
                $errorMontoPagoAdd.textContent = 'el monto ingresado supera al monto restante';
            }
        }

        if(bandera){
            //let url = '{{ route('admin.pagos.addPagosOC') }}';
            ajaxFetch({
                url:urlAddPagosOC,
                ops:{
                    method:"POST",
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    body: new FormData($formAddPago),
                },
                success: json =>{
                    $("#addPagoModal").modal("hide");
                    cargarPagosOC();
                    swalSuccess(json.data.icon,json.data.msg);
                    //console.log(json);
                },
                error:err=>{
                    console.log(err)
                }
            });
        }else{
            e.target.removeAttribute('disabled');
        }

    }
    //---------------------------------------------------------------------------
    if(e.target.matches('.link-file-pago')){
        e.preventDefault();
        showFileModal(e.target.dataset.type,e.target.dataset.file);
    }
    //-----------------------------------------------------------------------------
    if(e.target.matches(['.btn-edit-pago-oc','.btn-edit-pago-oc *'])){
        e.preventDefault();
        $errorDatePagoEdit.textContent = '';
        $errorMontoPagoEdit.textContent = '';
        $errorFormaPagoEdit.textContent = '';
        $errorFilePagoEdit.textContent = '';
        /* $formUpdatePago.fecha_pago_oc.value ='';
        $formUpdatePago.pago_oc.value = '';
        $formUpdatePago.forma_pago_oc.value = '';
        $formUpdatePago.file_pago_oc.value = ''; */
        $formUpdatePago.reset();
        d.querySelector('#updatePagoModal .btn-update-pago-oc').removeAttribute('disabled');
        $formUpdatePago.id_pago_oc.value = e.target.dataset.idpago;
        $formUpdatePago.fecha_pago_oc.value = e.target.dataset.fechapago;
        $formUpdatePago.pago_oc.value = e.target.dataset.montopago;
        $formUpdatePago.forma_pago_oc.value = e.target.dataset.tipopago;
        d.querySelector('#updatePagoModal .btn-update-pago-oc').dataset.row = e.target.dataset.row;
        $('#updatePagoModal').modal('show');
    }
    //-----------------------------------------------------------------------------
    if(e.target.matches('.btn-update-pago-oc')){
        e.preventDefault();
        e.target.setAttribute('disabled');
        $errorDatePagoEdit.textContent = '';
        $errorMontoPagoEdit.textContent = '';
        $errorFormaPagoEdit.textContent = '';
        $errorFilePagoEdit.textContent = '';
        let bandera = true;
        if($formUpdatePago.fecha_pago_oc.value == '' || $formUpdatePago.pago_oc.value == '' || $formUpdatePago.forma_pago_oc.value == ''){
            $formUpdatePago.fecha_pago_oc.value == ''?$errorDatePagoEdit.textContent = 'Ingrese la fecha de pago':false;
            $formUpdatePago.pago_oc.value == ''?$errorMontoPagoEdit.textContent = 'Ingrese la monto de pago':false;
            $formUpdatePago.forma_pago_oc.value == ''?$errorFormaPagoEdit.textContent = 'Seleccione un tipo de pago':false;
            bandera=false;
        }
        $formUpdatePago.file_pago_oc.value!='' ? bandera = validateFile($formUpdatePago.file_pago_oc, $errorFilePagoEdit,'noNecesary'):false;

        if($formUpdatePago.pago_oc.value != ''){
            let montoTotalAbonar = d.querySelector('.table-info-pagos .cell-total-pagar input[name="hidden_total_pagar"]').value;
            let totalAbonar = 0,totalAbonadoMenosSelect = 0;
            for(let i=0; i<$tablePagosOC.rows.length; i++){
                if(i != e.target.dataset.row){
                    totalAbonadoMenosSelect += parseFloat($tablePagosOC.rows[i].querySelector('.monto-abonado').value)
                }
            }
            let totalAbonadoMasUpdate =  totalAbonadoMenosSelect + parseFloat($formUpdatePago.pago_oc.value);
            if(totalAbonadoMasUpdate > Math.round(parseFloat(montoTotalAbonar))+1){
                bandera=false;
                $errorMontoPagoEdit.textContent = 'la suma de los montos sobrepasa al de pagar';
                console.log( Math.round(parseFloat(montoTotalAbonar)), totalAbonadoMasUpdate);
            }
        }
        if(bandera){
            //let url = '{{ route('admin.pagos.updatePagosOC') }}';
            ajaxFetch({
                url:urlUpdatePagosOC,
                ops:{
                    method:"POST",
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    body: new FormData($formUpdatePago),
                },
                success: json =>{
                    $("#updatePagoModal").modal("hide");
                    cargarPagosOC();
                    swalSuccess(json.data.icon,json.data.msg);
                    //console.log(json);
                },
                error:err=>{
                    console.log(err)
                }
            });
        }else{
            e.target.removeAttribute('disabled');
        }
    }
})



//FUNCIONES---------------------------------------------------------------------------
function cargarPagosOC(){
    //let url = '{{ route('admin.pagos.getPagosOC', ':id') }}';
    let urlGetPagosOC2 = urlGetPagosOC.replace(':id', idOC);
    return ajaxFetch({
        url:urlGetPagosOC2,
        ops:{
            method:"GET",
            headers: {
                "Content-type": "application/json; charset=utf-8"
            }
        },
        success: json =>{
            $tablePagosOC.innerHTML = '';
            if(json.data.length > 0){
                json.data.forEach((el,index) => {
                    let row = $tablePagosOC.insertRow($tablePagosOC.rows.length);
                    row.insertCell(0).innerHTML = el.fecha_pago;
                    row.insertCell(1).innerHTML = `<input type="hidden" class="monto-abonado" value="${el.monto}">` + `<span>${el.moneda == 'soles'? `S/. ${el.monto}` : `$. ${el.monto}`}</span>` ;
                    row.insertCell(2).innerHTML = el.tipo_pago;
                    row.insertCell(3).innerHTML = el.file?`<a href='' class='link-file-pago' data-file='${el.file.url}' data-type='${el.file.tipo_archivo}'>${el.file.url.split('/').pop()}</a>`:'--';
                    row.insertCell(4).innerHTML = `<a class='btn-edit-pago-oc btn btn-sm btn-sfibras2' data-idPago='${el.id}' data-fechaPago='${el.fecha_pago}' data-montoPago='${el.monto}' data-tipoPago='${el.tipo_pago}' data-row='${index}'>
                    <i class='fas fa-pen'  data-idPago='${el.id}' data-fechaPago='${el.fecha_pago}' data-montoPago='${el.monto}' data-tipoPago='${el.tipo_pago}' data-row='${index}'></i></a>`;
                });
                //console.log($tablePagosOC.rows.length);

            }else{
                $tablePagosOC.innerHTML= `<tr><td colspan='4' class='text-center'>Ningun Pago Registrado</td></tr>`;
            }
            calcularInfoPagos();
        },
        error:err=>{
            console.log(err)
        }
    });

}
const calcularInfoPagos = ()=>{
    const $tableInfPagos = d.querySelector('.table-info-pagos');
    let $cellTotalPagar =  $tableInfPagos.rows[0].querySelector('.cell-total-pagar'),
    $cellTotalAbonado = $tableInfPagos.rows[1].querySelector('.cell-total-abonado'),
    $cellRestante = $tableInfPagos.rows[2].querySelector('.cell-total-restante');
   let moneda = $cellTotalPagar.querySelector('input[name="hidden_total_pagar"]').dataset.moneda == 'soles'? 'S/.' : '$.';
    let totalPagar = parseFloat($cellTotalPagar.querySelector('input[name="hidden_total_pagar"]').value);
   let totalAbonado = 0,montoRestante = 0;
   if($tablePagosOC.rows[0].querySelector('.monto-abonado') != null){
       for(let i=0; i<$tablePagosOC.rows.length; i++){
           totalAbonado += parseFloat($tablePagosOC.rows[i].querySelector('.monto-abonado').value)
       }
   }
   montoRestante = totalPagar - totalAbonado;
   //console.log($cellTotalPagar.querySelector('input[name="hidden_total_pagar"]').dataset.moneda);
   $cellTotalAbonado.querySelector('input[name="hidden_total_abonado"]').value = totalAbonado.toFixed(2);
   $cellTotalAbonado.querySelector('span').textContent = moneda + totalAbonado.toFixed(2);
   $cellRestante.querySelector('input[name="hidden_monto_restante"]').value = montoRestante.toFixed(2);
   $cellRestante.querySelector('span').textContent = moneda +  montoRestante.toFixed(2);
}
function cargarFilesOC(){
    //let url = '{{ route('admin.files.getFilesOC', ':id') }}';
    let urlGetFilesOC2 = urlGetFilesOC.replace(':id', idOC);
    ajaxFetch({
        url:urlGetFilesOC2,
        ops:{
            method:"GET",
            headers: {
                "Content-type": "application/json; charset=utf-8"
            }
        },
        success: json =>{
            $tableFiles.innerHTML = '';
            if(json.data.length > 0){
                json.data.forEach(el => {
                    let row = $tableFiles.insertRow($tableFiles.rows.length);
                    row.insertCell(0).innerHTML = el.url?`<a href="" class='link-file' data-file='${el.url}' data-type='${el.tipo_archivo}'>${el.url.split('/').pop()}</a>`:'--';
                    row.insertCell(1).innerHTML = el.tipo_archivo?el.tipo_archivo:'--';
                    row.insertCell(2).innerHTML = el.descripcion?el.descripcion:'--';
                    row.insertCell(3).innerHTML = `<a class='btn-edit-file btn btn-sm btn-sfibras2'
                    data-file='${el.id}' data-descrip='${el.descripcion?el.descripcion:''}'>
                    <i class='fas fa-pen' data-file='${el.id}' data-descrip='${el.descripcion?el.descripcion:''}'></i></a>
                    <a class='btn-delete-file btn btn-sm btn-danger' data-file='${el.id}'><i class='fas fa-trash' data-file='${el.id}'></i></a>`;
                });
            }else{
                $tableFiles.innerHTML= `<tr><td colspan='4'>Ningun Archivo relacionado</td></tr>`;
            }

        },
        error:err=>{
            console.log(err)
        }
    });
}
function cargarStepsDate(){
    //let url = '{{ route('admin.ordenCompra.getDatesOC', ':id') }}';
    let urlGetDatesOC2 = urlGetDatesOC.replace(':id', idOC);
    ajaxFetch({
        url:urlGetDatesOC2,
        ops:{
            method:"GET",
            headers: {
                "Content-type": "application/json; charset=utf-8"
            }
        },
        success: json =>{
            let dateInicio = d.querySelector(".step-inicio");
            let dateFinal = d.querySelector(".step-final");
            let stepTrabajando = d.querySelector(".step-trabajando");
            let dateEntrega = d.querySelector(".step-entrega");
            if(json.dataInicio.fecha){
                dateInicio.querySelector(".step-date").textContent = json.dataInicio.fecha;
                dateInicio.querySelector(".step-date").dataset.obs = json.dataInicio.obs?json.dataInicio.obs:'';
                dateInicio.classList.add('completed');
                stepTrabajando.classList.add('completed');
            }else{
                dateInicio.querySelector(".step-date").textContent = '--';
            }
            if(json.dataFinal.fecha){
                dateFinal.querySelector(".step-date").textContent = json.dataFinal.fecha;
                dateFinal.querySelector(".step-date").dataset.obs = json.dataFinal.obs?json.dataFinal.obs:'';
                dateFinal.classList.add('completed')
            }else{
                dateFinal.querySelector(".step-date").textContent = '--';
            }
            if(json.dataEntrega.fecha){
                dateEntrega.querySelector(".step-date").textContent = json.dataEntrega.fecha;
                dateEntrega.querySelector(".step-date").dataset.obs = json.dataEntrega.obs?json.dataEntrega.obs:'';
                dateEntrega.classList.add('completed')
            }else{
                dateEntrega.querySelector(".step-date").textContent = '--';
            }
        },
        error:err=>{
            console.log(err)
        }
    });
}
function showFileModal(tipo_archivo, url) {
    let $objectTag = d.querySelector("#filesOCModal #fileshow-oc"),
        $imgFile = d.querySelector("#filesOCModal .content-img-file"),
        $descarga = d.querySelector("#filesOCModal #descargar-fileOC");
    //$objectTag.classList.add('d-none');
    d.querySelector("#filesOCModal .content-object").classList.add("d-none");
    $imgFile.classList.add("d-none");
    let ext = tipo_archivo.split("/").pop();
    $objectTag.innerHTML = "";
    if (ext == "pdf") {
        /* $objectTag.setAttribute('data', `/storage/${url}`);
                    $objectTag.setAttribute('type', tipo_archivo);
                    $objectTag.classList.remove('d-none'); */
        var object = document.querySelector("#filesOCModal #fileshow-oc");
        object.setAttribute("data", `/storage/${url}`);
        var clone = object.cloneNode(true);
        var parent = object.parentNode;
        parent.removeChild(object);
        parent.appendChild(clone);
        d.querySelector("#filesOCModal .content-object").classList.remove(
            "d-none"
        );
    } else if (ext == "pdf" || ext == "png" || ext == "jpg" || ext == "jpeg") {
        $imgFile.querySelector("img").src = `/storage/${url}`;
        $imgFile.querySelector("img").alt = url;
        $imgFile.classList.remove("d-none");
    }
    $descarga.href = `/storage/${url}`;
    //console.log($objectTag);
    $("#filesOCModal").modal("show");
}

function validateFile($inputFile, $errorFile, data = "") {
    let bandera = false;
    if ($inputFile.value != "") {
        let ext = $inputFile.value.split(".").pop();
        if (ext == "pdf" || ext == "png" || ext == "jpg" || ext == "jpeg") {
            let sizeMegaBytes = $inputFile.files[0].size / 1024; //lo pasamos de bytes a kilobytes
            if (ext == "pdf") {
                if (sizeMegaBytes < 1024) {
                    //en kilobytes
                    bandera = true;
                } else {
                    $errorFile.textContent = "El archivo excede los 1mb";
                }
            } else {
                if (sizeMegaBytes < 3072) {
                    //menor a 3 mb
                    bandera = true;
                } else {
                    $errorFile.textContent = "La imagen excede los 3mb";
                }
            }
        } else {
            $errorFile.textContent = "Solo se aceptan formatos pdf o imagenes";
        }
    } else {
        if (data == "noNecesary") {
            bandera = true;
        } else {
            $errorFile.textContent = "El campo file es necesario";
        }
    }
    return bandera;
}

function swalSuccess(icon, msg) {
    Swal.fire({
        position: "top-end",
        icon: icon,
        title: msg,
        background: "#E6F4EA",
        toast: true,
        color: "#333",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
    });
}

