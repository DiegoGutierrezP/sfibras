<div class="card-body mt-2">
    <div class="content-info-pagos">
        <h5>Informacion de Pagos</h5>
        <div class="mt-3 col-lg-6 col-md-6 col-12">
            <table class="table table-sm table-borderless">
                <tr>
                    <th>Total a Pagar:</th>
                    <td>{{$moneda . $oc->precioTotalOC}}</td>
                </tr>
                <tr>
                    <th>Monto Abonado:</th>
                    <td>0.00</td>
                </tr>
                <tr>
                    <th>Monto Restante:</th>
                    <td>0.00</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="mt-5 content-table-pagos">
        <button class="btn-add-pago-oc btn btn-sfibras2 mb-3">Registrar Pago</button>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Fecha Pago</th>
                        <th>Monto</th>
                        <th>Tipo Pago</th>
                        <th>File</th>
                    </tr>
                </thead>
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
@push('js')

    <script>
        //document d ya esta definido en show control files
        let $formAddPago = d.querySelector('#addPagoModal #form-add-pago-oc');
                let $errorDatePago = $formAddPago.querySelector('.validate-date'),
                $errorMontoPago = $formAddPago.querySelector('.validate-pago'),
                $errorFormaPago = $formAddPago.querySelector('.validate-forma-pago'),
                $errorFilePago = $formAddPago.querySelector('.validate-file');

        d.addEventListener("click",e=>{
            if(e.target.matches('.btn-add-pago-oc')){
                $errorDatePago.textContent = '';
                $errorMontoPago.textContent = '';
                $errorFormaPago.textContent = '';
                $errorFilePago.textContent = '';
                $("#addPagoModal").modal('show');
            }
            //----------------------------------
            if(e.target.matches('.btn-registrar-pago-oc')){
                $errorDatePago.textContent = '';
                $errorMontoPago.textContent = '';
                $errorFormaPago.textContent = '';
                $errorFilePago.textContent = '';
                if($formAddPago.fecha_pago_oc.value == '' || $formAddPago.pago_oc.value == '' || $formAddPago.forma_pago_oc.value == ''){
                    if($formAddPago.fecha_pago_oc.value == ''){
                        $errorDatePago.textContent = 'Ingrese la fecha de pago';
                    }
                    if($formAddPago.pago_oc.value == ''){
                        $errorMontoPago.textContent = 'Ingrese la monto de pago';
                    }
                    if($formAddPago.forma_pago_oc.value == ''){
                        $errorFormaPago.textContent = 'Seleccione un tipo de pago';
                    }
                }

            }
        })

    </script>

@endpush
