@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cotizacion {{$cotizacion->codigoCoti}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.cotizacion.index')}}" class="btn  btn-secondary"><i class="fas fa-arrow-left"></i></a>
            <a href="{{ route('admin.cotizacion.pdf', $cotizacion->id) }}" class="btn  btn-sfibras2"><i class="fas fa-file-pdf"></i></a>
            <div class="float-right">
                @if ($cotizacion->estado == 1)
                    <a href="" class="btn-estado-coti btn  btn-warning px-2 py-1 font-weight-bold" data-estado="{{$cotizacion->estado}}" data-codigo="{{$cotizacion->codigoCoti}}">Pendiente</a>
                @elseif($cotizacion->estado == 2)
                    <button class="btn-coti-aceptada btn btn-success px-2 py-1 font-weight-bold" data-coti="{{$cotizacion->id}}" data-estado="{{$cotizacion->estado}}">Aceptado</button>
                @elseif($cotizacion->estado == 3)
                    <button class="btn-coti-aceptada btn btn-primary px-2 py-1 font-weight-bold" data-coti="{{$cotizacion->id}}" data-estado="{{$cotizacion->estado}}">Aceptado/Modificado</button>
                @elseif($cotizacion->estado == 4)
                    <button class="btn btn-secondary px-2 py-1 font-weight-bold">Expirado</button>
                @elseif($cotizacion->estado == 5)
                    <button class="btn  btn-danger px-2 py-1 font-weight-bold">Rechazado</button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
               <h6><b>Fecha de Emisión: </b>&nbsp; {{ $fechaEmision}}</h6>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 p-2">
                    <h5 >Datos del Cliente</h5>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th>Cliente:</th>
                            <td>{{$cotizacion->clienteNombre}}</td>
                        </tr>
                        <tr>
                            <th>ruc:</th>
                            <td>{{$cotizacion->clienteRuc}}</td>
                        </tr>
                        <tr>
                            <th>dni:</th>
                            <td>{{$cotizacion->clienteDni}}</td>
                        </tr>
                        <tr>
                            <th>telefono:</th>
                            <td>{{$cotizacion->clienteTelefono}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 col-md-6 col-12 p-2">
                    <h5 >Condiciones Generales</h5>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th>Precios:</th>
                            <td>{{$cotizacion->precioIgvCoti==0? 'No Incluye IGV':'Incluye IGV'}}</td>
                        </tr>
                        <tr>
                            <th>Forma de Pago:</th>
                            <td>{{$cotizacion->formaPago}}</td>
                        </tr>
                        <tr>
                            <th>Validez:</th>
                            <td>{{$cotizacion->diasExpiracion}}</td>
                        </tr>
                        <tr>
                            <th>Tiempo Entrega:</th>
                            <td>{{$cotizacion->tiempoEntrega}}</td>
                        </tr>
                        <tr>
                            <th>Moneda:</th>
                            <td>{{$cotizacion->tipoMoneda}}</td>
                        </tr>
                        @if ($cotizacion->tipoMoneda == "dolares")
                            <tr>
                                <th>Valor Dolar:</th>
                                <td>{{$cotizacion->valorDolar}}</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>
            <div class="form-group my-3">
                <label>Introducción:</label>
                <p>
                    {{ $cotizacion->introCoti }}
                </p>
            </div>
            <div class="table-responsive">
                <table class="table-items-coti-show table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio/u</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cotizacion->items as $index => $item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>{{$item->descripcion?$item->descripcion:'-'}}</td>
                                <td>{{$item->cantidad}}</td>
                                <td>{{$item->precioUnit}}</td>
                                <td>{{$item->precioTotal}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row position-relative my-4 ">
                <div class="w-100">
                <table style="width: 300px; float:right;" class="table-precios-coti-show table table-sm table-bordered">
                    @if ($cotizacion->descuentoCoti != 0)
                        <tr>
                            <td>Neto</td>
                            <td>
                                {{$moneda}}{{$cotizacion->precioNetoCoti}}
                            </td>
                        </tr>
                        <tr>
                            <td>Descuento</td>
                            <td>
                                {{$cotizacion->descuentoCoti}}%
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>Sub Total</td>
                        <td>
                            {{$moneda}}{{$cotizacion->precioSubTotalCoti}}
                        </td>
                    </tr>
                    <tr>
                        <td>IGV</td>
                        <td>
                            {{$moneda}}{{$cotizacion->precioIgvCoti}}
                        </td>
                    </tr>
                    <tr>
                        <td>Envio</td>
                        <td>
                            {{$moneda}}{{$cotizacion->precioEnvioCoti}}
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>
                            {{$moneda}}{{$cotizacion->precioTotalCoti}}
                        </td>
                    </tr>
                </table>
                </div>
        </div>
        <div class="form-group">
            <label>Conclusión:</label>
            <p>
                {{ $cotizacion->conclusionCoti }}
            </p>
        </div>
        </div>
    </div>

    {{-- Modal --}}
    <div  class="modal fade" id="estadosCotiModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estados de la Cotizacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5></h5>
                    <form action="{{route('admin.cotizacion.cambiarEstado')}}" method="POST" id="form-checks-estado-coti">
                        @csrf
                        <input type="hidden" name="codigo_coti" value="">
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="estadosCoti" id="exampleRadios3" value="2">
                            <label class="form-check-label" for="exampleRadios3">
                                Aceptar
                            </label>
                        </div>
                        <div class="form-check mb-1 ">
                            <input class="form-check-input" type="radio" name="estadosCoti" id="exampleRadios4" value="5"
                                >
                            <label class="form-check-label" for="exampleRadios4">
                                Rechazar
                            </label>
                        </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-guardar-estado-coti">Continuar</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Modal information coti aceptada --}}
    <div  class="modal fade" id="cotiAceptadaModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacion Cotizacion Aceptada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="info"></p>
                    <table class="table-information table table-sm talbe-borderless">
                        <tr>
                            <th>Orden de Compra Relacionada:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Fecha de Aprobacion:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Estado de la Orden de Compra:</th>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
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
    @if(Session::has('msg-sweet'))

        let msg = "{{Session::get('msg-sweet')}}";
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            background:'#E6F4EA',
            toast:true,
            color: '#333',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
        })
    @endif

    const d= document;

    d.addEventListener("click",e=>{
        if (e.target.matches('.btn-estado-coti')) {
            e.preventDefault();
            console.log(e.target.dataset.estado, e.target.dataset.codigo);
            $('#estadosCotiModal').modal('show');
            $('#estadosCotiModal').find('.modal-body h5').text('Cotización ' + e.target.dataset.codigo);
            $('#estadosCotiModal').find('.modal-body input[name="codigo_coti"]').val(e.target.dataset.codigo);
            d.querySelectorAll('#estadosCotiModal input[name="estadosCoti"]').forEach(el => {
                if (el.value == e.target.dataset.estado) {
                    el.checked = true;
                }
            });
        }
        if(e.target.matches('.btn-guardar-estado-coti')){
            e.preventDefault();
            $('#estadosCotiModal').modal('hide');
            if(d.querySelector('input[name="estadosCoti"]:checked')){
                let estado = d.querySelector('input[name="estadosCoti"]:checked').value;
                if(estado == 1 || estado == 5){
                    d.getElementById("form-checks-estado-coti").submit();
                }else if(estado == 2 || estado == 3){
                    let codigoCoti = d.querySelector('#estadosCotiModal input[name="codigo_coti"]').value;
                    let url = '{{ route('admin.ordenCompra.create', ':codigo') }}';
                    url = url.replace(':codigo', codigoCoti);
                    window.location.href = url;
                }
            }
        }
        if(e.target.matches('.btn-coti-aceptada')){
            e.preventDefault();
            console.log(e.target.dataset.coti);
            let estadoCoti = e.target.dataset.estado;
            let url = '{{ route('cotizacion.informationAceptada') }}';
            let obj ={
                url:url,
                ops:{
                    method:"POST",
                    headers: {
                        "Content-type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        codigoCoti: e.target.dataset.coti,
                    })
                },
                success: json => {
                    const contentModal = d.querySelector("#cotiAceptadaModal .modal-body");
                    let msg = "";
                    if(estadoCoti == 2){
                        msg = 'Esta cotizacion fue aceptada sin ninguna modificacion.'
                    }else{
                        msg = 'Esta cotizacion fue aceptada con alguna  modificacion.'
                    }
                    contentModal.querySelector('.info').textContent = msg;
                    const tableInfo = contentModal.querySelector('.table-information');
                    let fechaAprobacion = new Date(json.data.oc.created_at);
                    let urlshow ='{{route('admin.ordenCompra.show', ':id')}}'
                    urlshow = urlshow.replace(':id', json.data.oc.id);
                    tableInfo.rows[0].cells[1].innerHTML = `<a href="${urlshow}">${json.data.oc.codigoOC}</a>`
                    tableInfo.rows[1].cells[1].textContent = fechaAprobacion.toLocaleString();
                    tableInfo.rows[2].cells[1].textContent = json.data.oc.estadoPedido;
                    $('#cotiAceptadaModal').modal('show');
                    //console.log(json)
                },
                error:err => {
                    console.log(err)
                }
            }
            peticiones(obj);
        }

                /* if(d.querySelector('input[name="estadosCoti"]:checked')){
                    $('#estadosCotiModal').modal('hide');
                    let estado = d.querySelector('input[name="estadosCoti"]:checked').value;
                    if(estado == 1 || estado == 5){
                        let codigoCoti = d.querySelector('#estadosCotiModal input[name="codigo_coti"]').value;
                        let url = '{{ route('admin.cotizacion.cambiarEstado') }}';
                        let obj = {
                            url : url,
                            ops: {
                                method: "POST",
                                headers: {
                                    "Content-type": "application/json; charset=utf-8",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    codigoCoti: codigoCoti,
                                    estadoCoti:estado
                                })
                            },
                            success: json => {
                                //Livewire.emitTo('admin.cotizacion-index', 'render');
                                window.location.href
                                Swal.fire({
                                    position: 'top-end',
                                    icon: json.data.icon,
                                    title: json.data.msg,
                                    background: '#E6F4EA',
                                    toast: true,
                                    color: '#333',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                })
                            },
                            error: err=>{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: err.data.icon,
                                    title: err.data.msg,
                                    background: '#FFD2D2',
                                    toast: true,
                                    color: '#D8000C',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                })
                            }
                        }

                        ajax(obj);
                    }
                } */


    })
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

    </script>
@stop
