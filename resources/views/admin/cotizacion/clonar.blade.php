@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Clonar Cotización {{ $cotizacion->codigoCoti }}</h1>
@stop

@section('content')
    <div class="card">
        <form id="form-clonar-coti" action="{{route('admin.cotizacion.clonar.store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div>
                    <p class="font-weight-bold font-italic">*Usted clonara esta cotizacion. Solo tiene la opcion de elegir un
                        nuevo cliente o dejar el mismo.*</p>
                </div>
                <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 p-2 px-3" style="background: #DADADA;">
                        <h5>Datos del Cliente</h5>
                        <div class="form-check my-2">
                            <input class="form-check-input" name="check_cliente_nuevo" type="checkbox" id="check-cliente-nuevo">
                            <label class="form-check-label" for="check-cliente-nuevo">
                                Cliente Nuevo
                            </label>
                        </div>

                        <div class="content-select-clientes form-group">
                            <label>Cliente</label>
                            <select class="form-control" name="cliente_id" id="select-clientes" >
                                @foreach ($clientes as $cli)
                                    @if ($cotizacion->cliente_id == $cli->id)
                                        <option value="{{ $cli->id }}" selected>{{ $cli->nombre }}</option>
                                    @else
                                        <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="content-form-nuevo-cliente d-none">
                            <label>Nuevo Cliente</label>

                            <div id="form-nuevo-cliente">
                                <div class="form-group">
                                    <label class="form-check-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombreCliente" value=""
                                        placeholder="Nombre del Cliente">
                                    <small class="error-nombre text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Dni</label>
                                    <input type="text" class="form-control" name="dniCliente"
                                        placeholder="Dni del cliente">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Ruc</label>
                                    <input type="text" class="form-control" name="rucCliente"
                                        placeholder="Ruc del cliente">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Telefono</label>
                                    <input type="text" class="form-control" name="telefonoCliente"
                                        placeholder="Telefono del cliente">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Email</label>
                                    <input type="text" class="form-control" name="emailCliente"
                                        placeholder="Email del cliente">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Dirección</label>
                                    <input type="text" class="form-control" name="direccionCliente"
                                        placeholder="Direccion del cliente">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 p-2 px-3">
                        <h5>Condiciones Generales</h5>
                        <table class="table">
                            <tr>
                                <th>Precios:</th>
                                <td>{{ $cotizacion->precioIgvCoti == 0 ? 'No Incluye IGV' : 'Incluye IGV' }}</td>
                            </tr>
                            <tr>
                                <th>Forma de Pago:</th>
                                <td>{{ $cotizacion->formaPago }}</td>
                            </tr>
                            <tr>
                                <th>Validez:</th>
                                <td>{{ $cotizacion->diasExpiracion }}</td>
                            </tr>
                            <tr>
                                <th>Tiempo Entrega:</th>
                                <td>{{ $cotizacion->tiempoEntrega }}</td>
                            </tr>
                            <tr>
                                <th>Moneda:</th>
                                <td>{{ $cotizacion->tipoMoneda }}</td>
                            </tr>
                            @if ($cotizacion->tipoMoneda == 'dolares')
                                <tr>
                                    <th>Valor Dolar:</th>
                                    <td>{{ $cotizacion->valorDolar }}</td>
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
                    <table class="table table-bordered">
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
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>{{ $item->descripcion ? $item->descripcion : '-' }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td>{{ $item->precioUnit }}</td>
                                    <td>{{ $item->precioTotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row position-relative my-4 ">
                    <div class="w-100">
                        <table style="width: 300px; float:right;" class="table table-sm table-bordered">
                            @if ($cotizacion->descuentoCoti != 0)
                                <tr>
                                    <td>Neto</td>
                                    <td>
                                        {{ $moneda }}{{ $cotizacion->precioNetoCoti }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Descuento</td>
                                    <td>
                                        {{ $cotizacion->descuentoCoti }}%
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>Sub Total</td>
                                <td>
                                    {{ $moneda }}{{ $cotizacion->precioSubTotalCoti }}
                                </td>
                            </tr>
                            <tr>
                                <td>IGV</td>
                                <td>
                                    {{ $moneda }}{{ $cotizacion->precioIgvCoti }}
                                </td>
                            </tr>
                            <tr>
                                <td>Envio</td>
                                <td>
                                    {{ $moneda }}{{ $cotizacion->precioEnvioCoti }}
                                </td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>
                                    {{ $moneda }}{{ $cotizacion->precioTotalCoti }}
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
            <div class="card-footer">
                <div class="float-right">
                    <a href="{{route('admin.cotizacion.index')}}" class="btn btn-secondary">Cancelar</a>
                    <a href="" class="btn-clonar btn btn-primary">Clonar</a>
                </div>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        /* const d = document,
            $checkCliente = d.getElementById('check-cliente-nuevo'),
            $formClonar = d.getElementById('form-clonar-coti');

        d.addEventListener("DOMContentLoaded", e => {
            //select2 cdn
            $('#select-clientes').select2();
        })
        d.addEventListener("change", e => {
            if (e.target.matches('#check-cliente-nuevo')) {
                const $selectCliente = d.querySelector('.content-select-clientes'),
                    $clienteNuevo = d.querySelector('.content-form-nuevo-cliente');
                if (e.target.checked) {
                    $selectCliente.classList.add('d-none');
                    $clienteNuevo.classList.remove('d-none');
                } else {
                    $selectCliente.classList.remove('d-none');
                    $clienteNuevo.classList.add('d-none');
                }
            }
        })
        d.addEventListener("click",e=>{
            if(e.target.matches(".btn-clonar")){
                e.preventDefault();
                //console.log($checkCliente.checked);
                if($checkCliente.checked){
                    const $formCliente = d.getElementById("form-nuevo-cliente");
                    let nombreCliente = $formCliente.querySelector('input[name="nombreCliente"]').value;
                    if(!nombreCliente){

                        $formCliente.querySelector('.error-nombre').textContent = 'El campo nombre es obligatorio';
                        errorFormCliente = "Ingrese el nombre del cliente";
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            background:'#FEEFB3',
                            title:'Ingrese el nombre del cliente',
                            toast:true,
                            color: '#9f6000',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        })
                        window.scrollTo({
                            behavior:"smooth",
                            top:0,
                        })
                    }else{
                        $formClonar.submit();
                    }
                }else{
                    $formClonar.submit();
                }
            }
        }) */
    </script>
    <script src="{{ asset('js/admin/cotizacionClonar.js') }}"></script>
@stop
