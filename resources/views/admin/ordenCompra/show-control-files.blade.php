<div class="card-body mt-2">
    <input type="hidden" value="{{$oc->id}}" class="id-oc">
    <div class="content-fechas my-3">
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
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header py-2">
                <a href="" id="descargar-fileOC" download>Descargar</a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            {{-- <iframe class="iframe-pdf" src="" style="width:100%;height:700px;"></iframe> --}}
            <object id="fileshow-oc" data="" type="" width="100%" height="700">
                <a href="test.pdf" download ><img src="test.pdf.preview.jpg" ></a>
             </object>
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
                            Swal.fire({
                                position: 'top-end',
                                icon: json.data.icon,
                                title: json.data.msg,
                                background:'#E6F4EA',
                                toast:true,
                                color: '#333',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                            })
                            console.log(json)
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
                const $iframe = d.querySelector("#filesOCModal #fileshow-oc"),
                $descarga = d.querySelector("#filesOCModal #descargar-fileOC");
                /* $iframe.src = `/storage/${e.target.dataset.file}`; */
                $iframe.setAttribute('data', `/storage/${e.target.dataset.file}`);
                $iframe.setAttribute('type', e.target.dataset.type);
                $descarga.href=`/storage/${e.target.dataset.file}`;
                $("#filesOCModal").modal("show");
                console.log(e.target.dataset.file);
            }
        })
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
                    json.data.forEach(el => {
                        let row = $tableFiles.insertRow($tableFiles.rows.length);
                        row.insertCell(0).innerHTML = el.url?`<a href="" class='link-file' data-file='${el.url}' data-type='${el.tipo_archivo}'>${el.url}</a>`:'--';
                        row.insertCell(1).innerHTML = el.tipo_archivo?el.tipo_archivo:'--';
                        row.insertCell(2).innerHTML = el.descripcion?el.descripcion:'--';
                        row.insertCell(3).innerHTML = `<a class='btn btn-sm btn-sfibras2'><i class='fas fa-pen'></i></a>
                        <a class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>`;
                    });
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
