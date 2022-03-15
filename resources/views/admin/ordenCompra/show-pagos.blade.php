<div class="card-body mt-2">
    <div class="content-info-pagos">
        <h5>Informacion de Pagos</h5>
        <div class="mt-3 col-lg-6 col-md-6 col-12">
            <table class="table-info-pagos table table-sm table-borderless">
                <tr>
                    <th>Total a Pagar:</th>
                    <td class="cell-total-pagar">
                        <input type="hidden" name="hidden_total_pagar" data-moneda="{{$oc->tipoMoneda}}" value="{{$oc->precioTotalOC}}">
                        <span>{{$moneda . $oc->precioTotalOC}}</span>
                    </td>
                </tr>
                <tr>
                    <th>Monto Total Abonado:</th>
                    <td class="cell-total-abonado">
                        <input type="hidden" name="hidden_total_abonado" value="0">
                        <span>0.00</span>
                    </td>
                </tr>
                <tr>
                    <th>Monto Restante:</th>
                    <td class="cell-total-restante">
                        <input type="hidden" name="hidden_monto_restante" value="0">
                        <span>0.00</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="mt-5 content-table-pagos">
        <button class="btn-add-pago-oc btn btn-sfibras2 mb-3">Registrar Pago</button>
        <div class="table-responsive">
            <table class="table-pagos-oc table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Fecha Pago</th>
                        <th>Monto</th>
                        <th>Tipo Pago</th>
                        <th>File</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Modal registrar pago --}}
<div  class="modal fade" id="addPagoModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add-pago-oc"  enctype="multipart/form-data">
                    <input type="hidden" value="{{$oc->id}}"  name="id_OC">
                    <input type="hidden" value="{{$oc->tipoMoneda}}"  name="moneda">
                    <div class="form-group">
                        <label>Fecha de Pago:</label>
                        <input type="date" class="form-control" name="fecha_pago_oc">
                        <small class="validate-date text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Monto: ({{$oc->tipoMoneda}})</label>
                        <input type="number" class="form-control" name="pago_oc">
                        <small class="validate-pago text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Forma de Pago:</label>
                        <select  id="" class="form-control" name="forma_pago_oc">
                            <option value="" selected>---</option>
                            <option value="deposito">Deposito</option>
                            <option value="transferencia">Transferencia</option>
                            <option value="efectivo">Efectivo</option>
                        </select>
                        <small class="validate-forma-pago text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>File: <small>(opcional)</small></label>
                        <input type="file" class="form-control-file" name="file_pago_oc" id="file-pago-oc"
                                    placeholder="col-form-label"
                                    accept="image/jpeg,image/gif,image/png,image/jpg,application/pdf">
                        <small class="validate-file text-danger"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button"  class="btn-registrar-pago-oc btn btn-primary ">Registrar</button>
            </div>

        </div>
    </div>
</div>
{{-- Modal actualizar pago --}}
<div  class="modal fade" id="updatePagoModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-update-pago-oc"  enctype="multipart/form-data">
                    <input type="hidden" value=""  name="id_pago_oc">
                    <input type="hidden" value="{{$oc->tipoMoneda}}"  name="moneda">
                    <div class="form-group">
                        <label>Fecha de Pago:</label>
                        <input type="date" class="form-control" name="fecha_pago_oc">
                        <small class="validate-date text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Monto: ({{$oc->tipoMoneda}})</label>
                        <input type="number" class="form-control" name="pago_oc">
                        <small class="validate-pago text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Forma de Pago:</label>
                        <select  id="" class="form-control" name="forma_pago_oc">
                            <option value="">---</option>
                            <option value="deposito">Deposito</option>
                            <option value="transferencia">Transferencia</option>
                            <option value="efectivo">Efectivo</option>
                        </select>
                        <small class="validate-forma-pago text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>File: <small>(opcional)</small></label>
                        <input type="file" class="form-control-file" name="file_pago_oc" id="file-pago-oc"
                                    placeholder="col-form-label"
                                    accept="image/jpeg,image/gif,image/png,image/jpg,application/pdf">
                        <small class="validate-file text-danger"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button"  class="btn-update-pago-oc btn btn-primary" data-row="">Actualizar</button>
            </div>

        </div>
    </div>
</div>
@push('js')

    <script>
        //document d ya esta definido en show control files
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

        d.addEventListener("click",e=>{
            if(e.target.matches('.btn-add-pago-oc')){
                $errorDatePagoAdd.textContent = '';
                $errorMontoPagoAdd.textContent = '';
                $errorFormaPagoAdd.textContent = '';
                $errorFilePagoAdd.textContent = '';
                $formAddPago.fecha_pago_oc.value ='';
                $formAddPago.pago_oc.value = '';
                $formAddPago.forma_pago_oc.value = '';
                $formAddPago.file_pago_oc.value = '';
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
                    let url = '{{ route('admin.pagos.addPagosOC') }}';
                    ajax({
                        url:url,
                        ops:{
                            method:"POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
                $formUpdatePago.fecha_pago_oc.value ='';
                $formUpdatePago.pago_oc.value = '';
                $formUpdatePago.forma_pago_oc.value = '';
                $formUpdatePago.file_pago_oc.value = '';
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
                    let url = '{{ route('admin.pagos.updatePagosOC') }}';
                    ajax({
                        url:url,
                        ops:{
                            method:"POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
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

        function cargarPagosOC(){
            let url = '{{ route('admin.pagos.getPagosOC', ':id') }}';
            url = url.replace(':id', idOC);
            return ajax({
                url:url,
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


    </script>

@endpush
