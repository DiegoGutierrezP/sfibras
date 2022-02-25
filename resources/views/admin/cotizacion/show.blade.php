@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cotizacion {{$cotizacion->codigoCoti}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
               <h6><b>Fecha de Emisión: </b>&nbsp; {{ $fechaEmision}}</h6>
            </div>
            <div class="row">
                <div class="col-6 p-2">
                    <h5 >Datos del Cliente</h5>
                    <table class="table">
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
                <div class="col-6 p-2">
                    <h5 >Condiciones Generales</h5>
                    <table class="table">
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
                    </table>
                </div>
            </div>
            <div class="row my-3">
                <p>
                    {{$cotizacion->introCoti}}
                </p>
            </div>
            <div class="table-responsive">
                <table  class="table table-bordered">
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
                <table style="width: 300px; float:right;" class="table table-sm table-bordered">
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
        <div class="row">
            <p>
                {{$cotizacion->conclusionCoti}}
            </p>
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
    </script>
@stop
