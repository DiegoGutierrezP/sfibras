<div class="card-body mt-2">
    <input type="hidden" value="{{$oc->id}}" class="id-oc">
    <div>
        <div class="stepper-wrapper">
            <div class="stepper-item step-inicio">
              <div class="step-action step-counter">1</div>
              <div class="step-name">Fecha de Inicio</div>
              <div class="step-date"></div>
            </div>
            <div class="stepper-item">
              <div class="step-counter">2</div>
              <div class="step-name">Trabajando..</div>
            </div>
            <div class="stepper-item step-final">
              <div class="step-action step-counter">3</div>
              <div class="step-name">Fecha Final</div>
              <div class="step-date"></div>
            </div>
            <div class="stepper-item step-entrega">
              <div class="step-action step-counter">4</div>
              <div class="step-name">Entrega</div>
              <div class="step-date"></div>
            </div>
          </div>
    </div>

</div>

@push('js')
    <script>
        const d = document;

        d.addEventListener("DOMContentLoaded",()=>{
            let idOC = d.querySelector(".id-oc").value;
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
                    let dateEntrega = d.querySelector(".step-entrega");
                    dateInicio.querySelector(".step-date").textContent = json.fechaInicio?  json.fechaInicio : '--';
                    dateFinal.querySelector(".step-date").textContent = json.fechaFinal?  json.fechaFinal : '--';
                    dateEntrega.querySelector(".step-date").textContent = json.fechaEntrega?  json.fechaEntrega : '--';
                    console.log(json.fechaInicio)
                },
                error:err=>{
                    console.log(err)
                }
            });
            //console.log(idOC);
        })

        d.addEventListener("click",e=>{
            if(e.target.matches('.step-action')){
                alert('ga');
            }
        })

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
