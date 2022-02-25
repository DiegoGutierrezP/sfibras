<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}"> --}}
    <style>
        /* *{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        } */
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
            font-size: 1rem;
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
            border: 1px solid #dee2e6;
            margin-left: 5px
        }
        .header-2 .datos-cli{
            float: right;
            padding: 5px;
            width: 47%;
            margin-right: 5px;
            /* padding: 5px; */
            height: 90%;
            border: 1px solid #dee2e6;

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
        .content-items{

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
        .table-coti{
            border-collapse: collapse;
            width: 100%;
            color: #212529;
            background-color: transparent;
            margin-bottom: .5rem;
        }
        .table-coti th,
        .table-coti td{
            padding: 0.5rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table-coti thead th{
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
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
        .content-table-totales .content{
            float: right;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding:5px 10px;
        }
        .content-table-totales table{
        }
        .content-table-totales table th,
        .content-table-totales table td{
            border: none;
            padding: 0.3rem 0.5rem;
        }
        .footer{
            /* padding: 0 1.5rem; */
            background: hotpink;
        }
        .content-medios-pagos{
            padding: 0 1.5rem;
            margin-bottom: .8rem;
        }
        .content-contact-firma{
            width: 100%;
            box-sizing: border-box;
            padding: 0;
            background: aquamarine;
            margin: 0;
        }
        .content-contact-firma .content-contact{
            float: left;
            width: 47%;
            border: 1px solid #000;
            padding: 10px;
        }
        .content-contact-firma .content-contact table th,
        .content-contact-firma .content-contact table td{
            text-align: left;
        }
        .content-contact-firma .content-firma{
            float: right;
            width: 47%;
            border: 1px solid #000;
        }
        .content-contact-firma .content-firma img{
            max-width: 120px;
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
                        <h3>COTIZACIÓN - {{$coti->codigoCoti}}</h3>
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
                                <td>:&nbsp;{{$coti->clienteNombre}}</td>
                            </tr>
                            <tr>
                                <th>Ruc</th>
                                <td>:&nbsp;{{$coti->clienteRuc}}</td>
                            </tr>
                            <tr>
                                <th>Dni</th>
                                <td>:&nbsp;{{$coti->clienteDni}}</td>
                            </tr>
                            <tr>
                                <th>Telefono</th>
                                <td>:&nbsp;{{$coti->clienteTelefono}}</td>
                            </tr>
                        </table>

                </div>


                <div class="condi-generales">

                        <h5>CONDICIONES GENERALES</h5>
                        <table class="table-header">
                            <tr>
                                <th>PRECIOS</th>
                                <td>:&nbsp;{{$coti->precioIgvCoti==0? 'No Incluye IGV':'Incluye IGV'}}</td>
                            </tr>
                            <tr>
                                <th>FORMA DE PAGO</th>
                                <td>:&nbsp;{{$coti->formaPago}}</td>
                            </tr>
                            <tr>
                                <th>VALIDEZ</th>
                                <td>:&nbsp;{{$coti->diasExpiracion}}</td>
                            </tr>
                            <tr>
                                <th>TIEMPO ENTREGA</th>
                                <td>:&nbsp;{{$coti->tiempoEntrega}}</td>
                            </tr>
                            <tr>
                                <th>MONEDA</th>
                                <td>:&nbsp;{{$coti->tipoMoneda}}</td>
                            </tr>
                        </table>

                </div>

        </section>

        <section class="content-items">
            <p>{{$coti->introCoti}} </p>
            <div class="content-table-items">
                <table class="table-coti">
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
                        @foreach ($coti->items as $index => $item)
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
                   <table class="table-coti">
                        <tr>
                            <td>Neto</td>
                            <td> {{$moneda}}{{$coti->precioNetoCoti}}</td>
                        </tr>
                        @if ($coti->descuentoCoti != 0)
                        <tr>
                                <td>Descuento</td>
                                <td>{{$coti->descuentoCoti}} %</td>
                            </tr>
                        @endif

                        <tr>
                            <td>IGV</td>
                            <td> {{$moneda}}{{$coti->precioIgvCoti}}</td>
                        </tr>
                        @if ($coti->precioEnvioCoti > 0)
                        <tr>
                                <td>Envio</td>
                                <td> {{$moneda}}{{$coti->precioEnvioCoti}}</td>
                            </tr>
                        @endif

                        <tr>
                            <td>Total</td>
                            <td> {{$moneda}}{{$coti->precioTotalCoti}}</td>
                        </tr>
                    </table>
                </div>
                <div style="clear: both"></div>
            </div>
        </section>
        <section class="footer">
            <div class="content-medios-pagos">
                <h5>MEDIOS DE PAGO</h5>
                <ul>
                    @foreach ($miEmp->cuentas_bancarias as $cuenta)
                        <li>{{$cuenta->banco .' '. $cuenta->tipo_cuenta.': '.$cuenta->numero_cuenta}}</li>

                    @endforeach
                </ul>
            </div>
            <div class="content-contact-firma">
                <div class="content-contact">
                    <h5>CONTACTO</h5>
                    <table>
                        <tr>
                            <th>Telefono</th>
                            <td>:</td>
                        </tr>
                        <tr>
                            <th>Celular</th>
                            <td>:</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                        </tr>
                        <tr>
                            <th>Web</th>
                            <td>:</td>
                        </tr>
                    </table>
                </div>
                <div class="content-firma">
                    <img src="{{Storage::url($miEmp->firma_titular)}}">
                </div>
                <div style="clear: both"></div>
            </div>
        </section>
    </div>
</body>
</html>
