<div class="card-body mt-2">

    <div class="content-fechas my-5">
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
    {{-- Modal Files --}}
    <div class="modal fade bd-example-modal-lg" id="filesOCModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header py-2">
                <a href="" id="descargar-fileOC" download>Descargar</a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
                <object class="d-none"  id="fileshow-oc" data="" type="" width="100%" style="min-height: 80vh;"  >
                    No support
                  </object>
                <div class="d-none content-img-file p-2 bg-secondary text-center">
                    <img src="" alt="" style="max-width:100%;max-height: 800px;">
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
        const d = document;
        let idOC = d.querySelector(".id-oc").value;
        const $tableFiles = d.querySelector('.table-files-oc tbody');

        d.addEventListener("DOMContentLoaded",()=>{
            cargarStepsDate();
            cargarFilesOC();
        })

        d.addEventListener("click",e=>{
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
                let url = '{{ route('admin.ordenCompra.updateDatesOC') }}';
                if(date != ''){
                    ajax({
                        url:url,
                        ops:{
                            method:"PUT",
                            headers: {
                                "Content-type": "application/json; charset=utf-8",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
                            //console.log(json)
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
            //---------------------------------------------------------------------------------
            if(e.target.matches('.link-file')){
                e.preventDefault();
                let $objectTag = d.querySelector("#filesOCModal #fileshow-oc"),
                $imgFile = d.querySelector("#filesOCModal .content-img-file"),
                $descarga = d.querySelector("#filesOCModal #descargar-fileOC");
                $objectTag.classList.add('d-none');
                $imgFile.classList.add('d-none');
                let ext = e.target.dataset.type.split('/').pop();
                //console.log(ext);
                if(ext=="pdf"){
                    $objectTag.setAttribute('data', `/storage/${e.target.dataset.file}`);
                    $objectTag.setAttribute('type', e.target.dataset.type);
                    $objectTag.classList.remove('d-none');
                }else if(ext == "pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
                    $imgFile.querySelector('img').src=`/storage/${e.target.dataset.file}`;
                    $imgFile.querySelector('img').alt=e.target.dataset.file;
                    $imgFile.classList.remove('d-none');
                }
                $descarga.href=`/storage/${e.target.dataset.file}`;
                $("#filesOCModal").modal("show");
            }
            //----------------------------------------------------------------------------------------
            if(e.target.matches('.btn-add-file-oc')){
                e.preventDefault();
                let $formAddFile = d.getElementById('form-add-file');
                let $inputFile = $formAddFile.file_OC,
                $descripFile = $formAddFile.descrip_file_OC,
                $errorFile = d.querySelector('#addFileModal .validate-file');
                /* const $inputFile = d.querySelector('#addFileModal #file-OC');
                let $errorFile = d.querySelector('#addFileModal .validate-file'),
                $descripFile = d.querySelector('#addFileModal .descrip-file-oc'); */
                $inputFile.value= '';
                $errorFile.textContent = '';$descripFile.value='';
                d.querySelector('.add-file-oc').removeAttribute('disabled');
                $("#addFileModal").modal("show");
            }
            //-------------------------------------------------------------------------------------
            if(e.target.matches('.add-file-oc')){
                e.preventDefault();
                e.target.setAttribute('disabled');
                /* const $inputFile = d.querySelector('#addFileModal #file-OC');
                let $errorFile = d.querySelector('#addFileModal .validate-file'),
                $formAddFile = d.getElementById('form-add-file'); */
                let $formAddFile = d.getElementById('form-add-file');
                let $inputFile = $formAddFile.file_OC,
                $errorFile = d.querySelector('#addFileModal .validate-file');

                let bandera = validateFile($inputFile,$errorFile);
                if(bandera){
                    let url = '{{ route('admin.ordenCompra.addFilesOC') }}';
                    ajax({
                        url:url,
                        ops:{
                            method:"POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
            //------------------------------------------------------------------------------------
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
                let bandera = validateFile($inputFile,$errorFile,'paraUpdate');
                if(bandera){
                    let url = '{{ route('admin.ordenCompra.updateFilesOC') }}';
                    ajax({
                        url:url,
                        ops:{
                            method:"POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
                        let url = '{{ route('admin.ordenCompra.deleteFilesOC', ':id') }}';
                        url = url.replace(':id', e.target.dataset.file);
                        ajax({
                            url:url,
                            ops:{
                                method:"DELETE",
                                headers: {
                                    "Content-type": "application/json; charset=utf-8",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
        })
        function validateFile($inputFile,$errorFile,data = ''){
            let bandera =false;
            if($inputFile.value !=''){
                let ext = $inputFile.value.split('.').pop();
                if(ext == "pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
                    let sizeMegaBytes = $inputFile.files[0].size/1024;//lo pasamos de bytes a kilobytes
                    if(ext == "pdf"){
                        if(sizeMegaBytes < 1024){//en kilobytes
                            bandera = true;
                        }else{
                            $errorFile.textContent = "El archivo excede los 1mb";
                        }
                    }else{
                        if(sizeMegaBytes < 3072){//menor a 3 mb
                            bandera = true;
                        }else{
                            $errorFile.textContent = "La imagen excede los 3mb";
                        }
                    }
                }else{
                    $errorFile.textContent = "Solo se aceptan formatos pdf o imagenes";
                }
            }else{
                if(data == 'paraUpdate'){
                    bandera = true;
                }else{
                  $errorFile.textContent = "El campo file es necesario";
                }
            }
            return bandera;
        }
        function cargarFilesOC(){
            let url = '{{ route('admin.ordenCompra.getFilesOC', ':id') }}';
            url = url.replace(':id', idOC);
            ajax({
                url:url,
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
            let url = '{{ route('admin.ordenCompra.getDatesOC', ':id') }}';
            url = url.replace(':id', idOC);
            ajax({
                url:url,
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

        function swalSuccess(icon,msg){
            Swal.fire({
                position: 'top-end',
                icon: icon,
                title: msg,
                background:'#E6F4EA',
                toast:true,
                color: '#333',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            })
        }

        async function ajax(obj){
            let {url,ops,success,error} = obj;
            try{
                let res = await fetch(url,ops);
                let json = await res.json();
                if (!res.ok) throw {
                    status: res.status,
                    statusText: res.statusText
                };
                success(json);
            }catch(err){
                console.log(err);
                error(err);
            }
        }
    </script>
@endpush
