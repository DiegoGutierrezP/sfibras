<div class="card-body mt-2">
    <p><em>Control de la duracion hasta el proceso de entrega del pedido</em></p>
    <div class="content-fechas my-5 ">
        <div class="stepper-wrapper">
            <div class="stepper-item step-inicio">
              <div class="step-action step-counter" data-step="inicio">1</div>
              <div class="step-name">Fecha de Inicio</div>
              <div class="step-date" data-obs=""></div>
            </div>
            <div class="stepper-item step-trabajando">
              <div class="step-counter">2</div>
              <div class="step-name">Trabajando..</div>
            </div>
            <div class="stepper-item step-final">
              <div class="step-action step-counter" data-step="final">3</div>
              <div class="step-name">Fecha Final</div>
              <div class="step-date" data-obs=""></div>
            </div>
            <div class="stepper-item step-entrega" >
              <div class="step-action step-counter" data-step="entrega">4</div>
              <div class="step-name">Entrega</div>
              <div class="step-date" data-obs=""></div>
            </div>
          </div>
    </div>
    <div class="content-files mt-5">
        <label>Archivos:</label>
        <div class="my-2">
            <button class="btn-add-file-oc btn btn-sfibras2">Agregar File</button>
        </div>
        <div class="table-responsive">
            <table class="table-files-oc table table-sm table-bordered">
                <thead>
                   <tr>
                       <th>File</th>
                       <th>Tipo</th>
                       <th>Descripcion</th>
                       <th></th>
                   </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>
{{-- Modal --}}
<div  class="modal fade" id="controlOCModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fecha de Inicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="data-step" value="">
                    <div class="form-group">
                        <label for="">Observaciones:</label>
                        <textarea rows="4" class="obs-step form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label >Fecha</label>
                        <input type="date" class="fecha-step form-control" >
                        <small class="validate-date text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                    <button type="button"  class="guardar-fechas-oc btn btn-primary ">Guardar</button>
                </div>

            </div>
        </div>
    </div>

      {{-- Modal Agregar FIle --}}
      <div  class="modal fade" id="addFileModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form   id="form-add-file"  enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <input type="hidden" value="{{$oc->id}}"  name="id_OC">
                        <div class="form-group">
                            <label for="">Descripcion:</label>
                            <textarea rows="4" name="descrip_file_OC" class="descrip-file-oc form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label >File</label>
                            <input type="file" class="form-control-file" name="file_OC" id="file-OC"
                                placeholder="col-form-label"
                                accept="image/jpeg,image/gif,image/png,image/jpg,application/pdf">
                            <small class="validate-file text-danger"></small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                    <button type="button"  class="add-file-oc btn btn-primary ">Guardar</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Modal update FIle --}}
    <div  class="modal fade" id="updateFileModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form   id="form-edit-file"  enctype="multipart/form-data">
                    {{-- @csrf --}}
                    <input type="hidden" value=""  name="id_file" id="id_file">
                    <div class="form-group">
                        <label for="">Descripcion:</label>
                        <textarea rows="4" name="descrip_file_OC" class="descrip-file-oc form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label >File</label>
                        <input type="file" class="form-control-file" name="file_OC" id="file-update-OC"
                            placeholder="col-form-label"
                            accept="image/jpeg,image/gif,image/png,image/jpg,application/pdf">
                        <small class="validate-file text-danger"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button"  class="btn-update-file-oc btn btn-primary ">Guardar</button>
            </div>

        </div>
    </div>
</div>

@push('js')
    <script>
    </script>
@endpush
