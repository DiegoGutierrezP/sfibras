<div class="card-body">
    <div class="mb-3">
        <h6><b>Fecha de Emisión: </b>&nbsp; {{$fechaEmisionOC}}</h6>
        <h6><b>Cotizacion Relacionada: </b>&nbsp;
            @if (!is_null($oc->cotizacion))
                <a href="{{route('admin.cotizacion.show',$oc->cotizacion->id)}}">{{$oc->cotizacion->codigoCoti}}</a>
            @else
                --
            @endif
        </h6>
     </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12 p-2">
            <h5 >Datos del Cliente</h5>
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>Cliente:</th>
                        <td>{{$oc->cliente->nombre}}</td>
                    </tr>
                    <tr>
                        <th>ruc:</th>
                        <td>{{$oc->cliente->ruc}}</td>
                    </tr>
                    <tr>
                        <th>dni:</th>
                        <td>{{$oc->cliente->dni}}</td>
                    </tr>
                    <tr>
                        <th>telefono:</th>
                        <td>{{$oc->cliente->telefono}}</td>
                    </tr>
                </table>
        </div>
        <div class="col-lg-6 col-md-6 col-12 p-2">
            <h5 >Condiciones Generales</h5>
            <table class="table table-sm table-borderless">
                <tr>
                    <th>Precios:</th>
                    <td>{{$oc->precioIgvOC==0? 'No Incluye IGV':'Incluye IGV'}}</td>
                </tr>
                <tr>
                    <th>Forma de Pago:</th>
                    <td>{{$oc->formaPago}}</td>
                </tr>
                <tr>
                    <th>Tiempo Entrega:</th>
                    <td>{{$oc->entregaEstimada}}</td>
                </tr>
                <tr>
                    <th>Moneda:</th>
                    <td>{{$oc->tipoMoneda}}</td>
                </tr>
                @if ($oc->tipoMoneda == "dolares")
                    <tr>
                        <th>Valor Dolar:</th>
                        <td>{{$oc->valorDolar}}</td>
                    </tr>
                @endif

            </table>
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table-items-oc-show table table-bordered">
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
                @foreach ($oc->orden_detalles as $index => $item)
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
            @if ($oc->descuentoOC != 0)
                <tr>
                    <td>Neto</td>
                    <td>
                        {{$moneda}}{{$oc->precioNetoOC}}
                    </td>
                </tr>
                <tr>
                    <td>Descuento</td>
                    <td>
                        {{$oc->descuentoOC}}%
                    </td>
                </tr>
            @endif
            <tr>
                <td>Sub Total</td>
                <td>
                    {{$moneda}}{{$oc->precioSubTotalOC}}
                </td>
            </tr>
            <tr>
                <td>IGV</td>
                <td>
                    {{$moneda}}{{$oc->precioIgvOC}}
                </td>
            </tr>
            <tr>
                <td>Envio</td>
                <td>
                    {{$moneda}}{{$oc->precioEnvioOC}}
                </td>
            </tr>
            <tr>
                <td>Total</td>
                <td>
                    {{$moneda}}{{$oc->precioTotalOC}}
                </td>
            </tr>
        </table>
        </div>
    </div>
</div>
