<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">
    <style>
        *{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        .content-coti{
            min-height: 100vh;
            background: silver;
            width: 100%;
        }
        .header-1{
            background: red;

            height: 150px;
        }
        .header-1 .logo{
            /* position: absolute;
            background: green;
            width: 50%;
            top: 0;
            left: 0;
            height: 100%; */
            float: left;
            background: blue;
            width: 50%;
            height: 100%;
            text-align: center;
        }
        .header-1 .logo img{
            width: 250px;
            background: brown;
        }
        .header-1 .info-coti{
            /* position: absolute;
            background: blue;
            width: 50%;
            top: 0;
            right: 0;
            height: 100%; */
            background: green;
            float: right;
            width: 50%;
            height: 100%;
            text-align: center;
        }
        .header-1 .info-coti p{
            text-transform: uppercase;
            background: yellow;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .header-2{
            background: yellow;
            width: 100%;
            position: relative;
            height: 200px;
        }
        .header-2 .content-datos-cli{
            position: absolute;
            width: 55%;
            /* background: pink; */
            left: 0;
            height: 100%;
            padding: 1rem
        }
        .header-2 .content-condi-generales{
            position: absolute;
            width: 45%;
            /* background: salmon; */
            right: 0;
            height: 100%;
            padding: 1rem;
        }
        .header-2 .content-datos-cli .datos-cli,
        .header-2 .content-condi-generales .condi-generales{
            width: 100%;
            padding: 5px;
            border: 1px solid #000;
            height: 100%;
        }
    </style>
</head>
<body style="padding: 1rem;">
    <div class="content-coti">
        <section class="header-1">

                <div class="logo" style="">
                    <img src="{{Storage::url($miEmp->logo)}}" alt="logo"><br>
                    <span>lima 22 enero 2022</span>
                </div>
                <div class="info-coti" style="">
                    <h3>COTIZACIÓN</h3>
                    <p>{{$coti->codigoCoti}}</p>
                    <p>{{$miEmp->razon_social}}</p>
                    <p>{{$miEmp->ruc}}</p>
                </div>

        </section>
        <section class="header-2">
            <div class="content-datos-cli">
                <div class="datos-cli">
                    <h5>DATOS DEL CLIENTE</h5>
                    <table>
                        <tr>
                            <th>Señor</th>
                            <td>:&nbsp;{{$coti->clienteNombre}}</td>
                        </tr>
                        <tr>
                            <th>ruc</th>
                            <td>:&nbsp;{{$coti->clienteRuc}}</td>
                        </tr>
                        <tr>
                            <th>dni</th>
                            <td>:&nbsp;{{$coti->clienteDni}}</td>
                        </tr>
                        <tr>
                            <th>Telefono</th>
                            <td>:&nbsp;{{$coti->clienteTelefono}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="content-condi-generales">
                <div class="condi-generales">
                    <h6>CONDICIONES GENERALES</h6>
                    <table>
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
            </div>
        </section>

        <section class="content-items">
            <p>{{$coti->introCoti}} </p>
        </section>
        <section class="footer">

        </section>
    </div>
</body>
</html>
