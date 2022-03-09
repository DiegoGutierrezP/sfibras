<div class="card-body mt-2">
    <input type="hidden" value="{{$oc->id}}" class="id-oc">
    <div>
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

</div>

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

@push('js')
    <script>
        const d = document;
        let idOC = d.querySelector(".id-oc").value;

        d.addEventListener("DOMContentLoaded",()=>{
            cargarStepsDate();
        })

        d.addEventListener("click",e=>{
            if(e.target.matches('.step-action')){
                let date = e.target.parentNode.querySelector('.step-date').textContent;
                let obs = e.target.parentNode.querySelector('.step-date').dataset.obs;
                /* let isCompleted = e.target.parentNode.classList.contains('completed');
                console.log(isCompleted); */
                $("#controlOCModal").find(".modal-body .data-step").val(e.target.dataset.step);
                if(e.target.dataset.step == 'inicio'){
                    $("#controlOCModal").find(".modal-title").text('Fecha de Inicio');
                }else if(e.target.dataset.step == 'final'){
                    $("#controlOCModal").find(".modal-title").text('Fecha de Final');
                }else if(e.target.dataset.step == 'entrega'){
                    $("#controlOCModal").find(".modal-title").text('Fecha de Entrega');
                }
                $("#controlOCModal").find(".modal-body .fecha-step").val(date);
                $("#controlOCModal").find(".modal-body .obs-step").val(obs);
                $("#controlOCModal").find(".modal-body .validate-date").text('');
               $("#controlOCModal").modal('show');
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
        })

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
                    //console.log(json)
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
