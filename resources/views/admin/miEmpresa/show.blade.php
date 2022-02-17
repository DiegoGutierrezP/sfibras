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
                <a href="{{route('admin.miEmpresa.edit',$empresa)}}" class="btn btn-secondary"><i class="fas fa-pen"></i></a>
                <a  class="btn-delete-empresa btn btn-danger" data-empresa="{{$empresa->id}}"><i class="fas fa-trash"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="img-miEmpresa">
                <img src="{{Storage::url($empresa->logo)}}"  alt="">
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
        document.addEventListener("click" , e=>{
            if(e.target.matches(['.btn-delete-empresa','.btn-delete-empresa *'])){
                e.preventDefault();
                let empresa = e.target.dataset.empresa;
                //let url = "{{route('admin.miEmpresa.destroy'," + empresa + ")}}";
                let url = '{{ route("admin.miEmpresa.destroy", ":empresa") }}';

                url = url.replace(':empresa', empresa);

                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Se eliminara la empresa",
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText:'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if(result.value) {
                        //console.log(url)

                        let options ={
                            method:"DELETE",
                            headers:{
                                "Content-type":"application/json; charset=utf-8",
                                "X-CSRF-TOKEN":"{{csrf_token()}}"
                            }
                        }

                        deleteEmpresa(url,options)
                        //console.log(options);
                    }

                })
            }
        })

        async function deleteEmpresa(url,options){
            try{
                let res = await fetch(url,options),
                 json = await res.json();

                 if(!res.ok) throw {status:res.status, statusText: res.statusText}

                console.log(json);
            }catch(err){
                console.log(err)
            }
        }
    </script>
@stop
