@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mi Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="float-left">{{$empresa->razon_social}}</h4>
            <div class="float-right">
                <a href="{{route('admin.miEmpresa.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
                <a href="{{route('admin.miEmpresa.edit',$empresa)}}" class="btn btn-primary"><i class="fas fa-pen"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="img-miEmpresa">
                @if ($empresa->logo)
                    <img src="{{Storage::url($empresa->logo)}}"  alt="">
                @else
                    <img src="{{Storage::url('admin/no_image.png')}}" alt="">
                @endif

            </div>
            <table class="table">
                <tr>
                    <th>Razon Social:</th>
                    <td>{{$empresa->razon_social}}</td>
                </tr>
                <tr>
                    <th>Ruc:</th>
                    <td>{{$empresa->ruc}}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{$empresa->direccion}}</td>
                </tr>
                <tr>
                    <th>Telefono:</th>
                    <td>{{$empresa->telefono}}</td>
                </tr>
                <tr>
                    <th>Celular:</th>
                    <td>{{$empresa->celular}}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{$empresa->email}}</td>
                </tr>
                <tr>
                    <th>Firma:</th>
                    <td>
                        @if ($empresa->firma_titular)
                            <img src="{{Storage::url($empresa->firma_titular)}}" style="max-width: 350px;" class="img-fluid" alt="">
                        @else
                            No hay imagen de firma
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Cuentas Bancarias:</th>
                    <td>
                        <ul >
                        @foreach ($empresa->cuentas_bancarias as $cuenta)
                        <li>{{$cuenta->banco .' '. $cuenta->tipo_cuenta .': '. $cuenta->numero_cuenta}}</li>
                        @endforeach
                        </ul>
                    </td>
                </tr>
            </table>
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
                type: 'success',
                text: msg,
                showConfirmButton: false,
                timer: 2000
            })
        @endif


    </script>
@stop
