<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html{
            font-family: sans-serif;
            line-height: 1.15;
        }
        *,
        *:before,
        *:after{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        body{
            padding: 0;
            margin: 0;
            min-height: 100vh;
            font-size: .9rem;
            line-height: 1.3;
        }
        .header-1{
            height: 140px;
        }
        .header-1 .logo{
            float: left;

            width: 50%;
            height: 100%;
            text-align: center;
        }

        .header-1 .logo img{

            width: 250px;
            max-height: 100px;
            margin-bottom: .8rem;
        }
        .header-1 .info-coti{

            float: right;
            width: 50%;
            height: 100%;
            text-align: center;
        }
        .header-1 .info-coti .content{

            margin-top: 1.2rem;
        }
        .header-1 .info-coti p{
            text-transform: uppercase;

            margin-bottom: 5px;
            font-weight: 500;
            font-size: 1.2rem;
        }
        .header-2{
            width: 100%;
            height: 160px;
            box-sizing: border-box;
            padding: 0;
            text-transform: uppercase;
        }
        .header-2 .condi-generales{
            float: left;
            padding: 5px;
            width: 47%;
            /* padding: 5px; */
            height: 90%;
            border: 1px solid #6A6A6A;
            border-radius: 3px;
            margin-left: 5px
        }
        .header-2 .datos-cli{
            float: right;
            padding: 5px;
            width: 47%;
            margin-right: 5px;
            /* padding: 5px; */
            height: 90%;
            border: 1px solid #6A6A6A;
            border-radius: 3px;
        }
        .header-2 .condi-generales h5,
        .header-2 .datos-cli h5{
            text-align: center;
            font-size: .9rem;
        }
        h5{
            font-size: .9rem;
        }
        .table-header{
            margin-top:5px;
        }
        .table-header th,
        .table-header td{
            text-align: left;
            font-size: .9rem;
        }
        .content-obs{
            border: 1px solid #6A6A6A;
            border-radius: 3px;
            margin: .5rem 5px;
            padding: .5rem;
        }
        .content-table-items{
            margin-top: 1rem;
            width: 100%;
        }
        /* .content-table-items table{
            border-collapse: collapse;
            width: 100%;
            color: #212529;
            background-color: transparent;
        }
        .content-table-items table th,
        .content-table-items table td{
            padding: 0.5rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .content-table-items table thead th{
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        } */
        .table{
            border-collapse: collapse;
            width: 100%;
            color: #212529;
            background-color: transparent;
            margin-bottom: .5rem;
            border: 1px solid #6A6A6A;
        }
        .table th,
        .table td{
            padding: 0.5rem;
            vertical-align: top;
            border-top: 1px solid #6A6A6A;
        }
        .table thead th{
            vertical-align: bottom;
            border-bottom: 2px solid #6A6A6A;
        }
        /* .content-table-totales{
            float: right;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
        } */
        .content-table-totales{
            width: 100%;
            margin-bottom: 2rem;
        }
        .content-table-totales .table-totales{
            border-collapse: collapse;
            width: 100%;
            color: #212529;
            background-color: transparent;
            margin-bottom: .5rem;
        }
        .content-table-totales .content{
            float: right;
            border: 1px solid #6A6A6A;
            border-radius: 3px;
            padding:2px 10px;

        }

        .content-table-totales table th,
        .content-table-totales table td{
            border: none;
            padding: 0.3rem 0.5rem;
        }
        .table-bordered{
            border: 1px solid #6A6A6A;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #6A6A6A;
        }

        .table-bordered thead th,
        .table-bordered thead td {
        border-bottom-width: 2px;
        }

        .footer{
            /* padding: 0 1.5rem; */
            padding-top: .4rem;
            width: 100%;
            box-sizing: border-box;
            border-top: 1px solid #000;
        }
        .footer .content-1{
            float: left;
            width: 47%;
            padding: .6rem;
        }
        .footer .content-1 .content-medios-pagos{
            margin-bottom: .5rem;
        }
        .footer .content-1 .content-medios-pagos ul{
            padding-left: 1rem;
        }
        .footer .content-1 .content-contact table th,
        .footer .content-1 .content-contact table td{
            text-align: left;
            font-size: .9rem;
        }
        .footer .content-2{
            float: right;
            width: 47%;
            padding-top: 1rem;
        }
        .footer .content-2 .content-firma{
            max-width: 200px;
            margin: auto;
            text-align: center;
        }
        .footer .content-2 .content-firma p{
            margin-top: .2rem;
            padding-top: .3rem;
            border-top: 1px solid #000;
            font-style: italic;
        }
        .footer .content-2 .content-firma img{
            width: 95%;
            max-height: 120px;
        }

    </style>
</head>
<body style="padding: 1rem;">
    <div class="content-coti">
        <section class="header-1">

                <div class="logo" style="">
                    <img src="{{Storage::url($miEmp->logo)}}" alt="logo"><br>
                    <span>{{$fechaEmision}}</span>
                </div>
                <div class="info-coti" style="">
                    <div class="content">
                        <h3>INFORMACION</h3>
                        <h3>ORDEN DE COMPRA - {{$oc->codigoOC}}</h3>
                        <p>{{$miEmp->razon_social}}</p>
                        <p>{{$miEmp->ruc}}</p>
                    </div>
                </div>

        </section>
       <section class="header-2">
                <div class="datos-cli">

                        <h5>DATOS DEL CLIENTE</h5>
                        <table class="table-header">
                            <tr>
                                <th>Señor</th>
                                <td>:&nbsp;{{$oc->cliente->nombre}}</td>
                            </tr>
                            <tr>
                                <th>Ruc</th>
                                <td>:&nbsp;{{$oc->cliente->ruc}}</td>
                            </tr>
                            <tr>
                                <th>Dni</th>
                                <td>:&nbsp;{{$oc->cliente->dni}}</td>
                            </tr>
                            <tr>
                                <th>Telefono</th>
                                <td>:&nbsp;{{$oc->cliente->telefono}}</td>
                            </tr>
                        </table>

                </div>


                <div class="condi-generales">

                        <h5>CONDICIONES GENERALES</h5>
                        <table class="table-header">
                            <tr>
                                <th>PRECIOS</th>
                                <td>:&nbsp;{{$oc->precioIgvOC==0? 'No Incluye IGV':'Incluye IGV'}}</td>
                            </tr>
                            <tr>
                                <th>FORMA DE PAGO</th>
                                <td>:&nbsp;{{$oc->formaPago}}</td>
                            </tr>
                            <tr>
                                <th>VALIDEZ</th>
                                <td>:&nbsp;{{$oc->diasExpiracion}}</td>
                            </tr>
                            <tr>
                                <th>TIEMPO ENTREGA</th>
                                <td>:&nbsp;{{$oc->entregaEstimada}}</td>
                            </tr>
                            <tr>
                                <th>MONEDA</th>
                                <td>:&nbsp;{{$oc->tipoMoneda}}</td>
                            </tr>
                        </table>

                </div>

        </section>

        <section class="content-obs">
            <b>Observaciones:</b><br>{{$oc->observaciones? $oc->observaciones: '--'}}
        </section>
        <br>
        <p><b>Estado de la Orden:</b>
            @if ($oc->estadoPedido == 1)
                <span>Pendiente</span>
            @elseif($oc->estadoPedido == 2)
                <span>Terminado</span>
            @elseif($oc->estadoPedido == 3)
                <span>Terminado/Entregado</span>
            @elseif($oc->estadoPedido == 4)
                <span>Cancelado</span>
            @endif
        </p>
        <br>
        <section class="content-items">
            <h3>Items de la Orden:</h3>
            <div class="content-table-items">
                <table class="table">
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
                                <td>{{$item->descripcion}}</td>
                                <td>{{$item->cantidad}}</td>
                                <td>{{$item->precioUnit}}</td>
                                <td>{{$item->precioTotal}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="content-table-totales">
                <div class="content">
                   <table class="table-totales">
                        <tr>
                            <td>Neto</td>
                            <td> {{$moneda}}{{$oc->precioNetoOC}}</td>
                        </tr>
                        @if ($oc->descuentoOC != 0)
                        <tr>
                                <td>Descuento</td>
                                <td>{{$oc->descuentoOC}} %</td>
                            </tr>
                        @endif

                        <tr>
                            <td>IGV</td>
                            <td> {{$moneda}}{{$oc->precioIgvOC}}</td>
                        </tr>
                        @if ($oc->precioEnvioOC > 0)
                        <tr>
                                <td>Envio</td>
                                <td> {{$moneda}}{{$oc->precioEnvioOC}}</td>
                            </tr>
                        @endif

                        <tr>
                            <td>Total</td>
                            <td> {{$moneda}}{{$oc->precioTotalOC}}</td>
                        </tr>
                    </table>
                </div>
                <div style="clear: both"></div>
            </div>
        </section>
        <br>
        <section>
            <h3>Pagos Realizados:</h3>
            <br>
            <p><b>Estado de Pago </b>{{$oc->estadoPago==2?'Pagado':'Debe'}}</p>
            <div class="content-table-control">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha Pago</th>
                            <th>Tipo Pago</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($oc->pagos))
                            @foreach ($oc->pagos as $pago)
                                <tr>
                                    <td>{{$pago->fecha_pago}}</td>
                                    <td>{{$pago->tipo_pago}}</td>
                                    <td>{{$pago->moneda=='soles'?'S/. ':'$. '}} {{$pago->monto}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Ningun Pago Realizado</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </section>
        <br><br>
        <section>
            <h3>Control del Trabajo: </h3>
            <br>
            <div class="content-table-control">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Fecha</th>
                            <th>Observacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Fecha de Inicio</b></td>
                            <td>{{$fechas[0]->fecha?$fechas[0]->fecha:'--'}}</td>
                            <td>{{$fechas[0]->observaciones?$fechas[0]->observaciones:'--'}}</td>
                        </tr>
                        <tr>
                            <td><b>Fecha de Final</b></td>
                            <td>{{$fechas[1]->fecha?$fechas[1]->fecha:'--'}}</td>
                            <td>{{$fechas[1]->observaciones?$fechas[1]->observaciones:'--'}}</td>
                        </tr>
                        <tr>
                            <td><b>Fecha de Entrega</b></td>
                            <td>{{$fechas[2]->fecha?$fechas[2]->fecha:'--'}}</td>
                            <td>{{$fechas[2]->observaciones?$fechas[2]->observaciones:'--'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        {{--  <section class="footer">
            <div class="content-1">
                <div class="content-medios-pagos">
                    <h5>MEDIOS DE PAGO</h5>
                    <ul>
                        @foreach ($miEmp->cuentas_bancarias as $cuenta)
                            <li>{{$cuenta->banco .' '. $cuenta->tipo_cuenta.': '.$cuenta->numero_cuenta}}</li>

                        @endforeach
                    </ul>
                </div>
                <div class="content-contact">
                    <h5>CONTACTO</h5>
                    <table>
                        <tr>
                            <th>Telefono</th>
                            <td>:&nbsp;{{$miEmp->telefono}}</td>
                        </tr>
                        <tr>
                            <th>Celular</th>
                            <td>:&nbsp;{{$miEmp->celular}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:&nbsp;{{$miEmp->email}}</td>
                        </tr>
                        <tr>
                            <th>Direccion</th>
                            <td>:&nbsp;{{$miEmp->direccion}}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="content-2">

                <div class="content-firma">
                    <img src="{{Storage::url($miEmp->firma_titular)}}">
                    <p>
                     Firma de la empresa.
                    </p>
                </div>

            </div>
            <div style="clear: both"></div>
        </section>
    </div> --}}
</body>
</html>
