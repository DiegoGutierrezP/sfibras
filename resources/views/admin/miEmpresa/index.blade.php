@extends('adminlte::page')

@section('title', 'Mi Empresa')

@section('content_header')
    <h1>Mi Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.miEmpresa.create')}}" class="btn btn-secondary">Registrar Empresa</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Razon Social</th>
                        <th>Ruc</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{$empresa->id}}</td>
                        <td>{{$empresa->razon_social}}</td>
                        <td>{{$empresa->ruc}}</td>
                        <td width="10px">
                            <a class="btn btn-light " href="{{route('admin.miEmpresa.show',$empresa)}}"><i class="fas fa-eye"></i></a>
                        </td>
                        <td width="10px">
                            <a  class="btn-delete-empresa btn btn-danger" data-empresa="{{$empresa->id}}"><i data-empresa="{{$empresa->id}}" class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
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
                icon: 'success',
                text: msg,
                showConfirmButton: false,
                timer: 2000
            })
        @endif


        document.addEventListener("click" , e=>{
            if(e.target.matches(['.btn-delete-empresa','.btn-delete-empresa *'])){
                e.preventDefault();
                let url = '{{ route("admin.miEmpresa.destroy", ":empresa") }}';
                url = url.replace(':empresa', e.target.dataset.empresa);

                //console.log(e.target.dataset.empresa);
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
                        console.log(url)

                        let options ={
                            method:"DELETE",
                            headers:{
                                "Content-type":"application/json; charset=utf-8",
                                "X-CSRF-TOKEN":"{{csrf_token()}}"
                            }
                        }
                        deleteEmpresa(url,options)
                    }

                })
            }
        })

        async function deleteEmpresa(url,options){
            try{
                let res = await fetch(url,options),
                 json = await res.json();

                 if(!res.ok) throw {status:res.status, statusText: res.statusText}

                if(json.response){
                    location.reload();
                    /* Swal.fire({
                        position: 'top-end',
                        type: json.type,
                        text: json.message,
                        showConfirmButton: false,
                        timer: 2000
                    }); */
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: json.type,
                        text: json.message,
                        showConfirmButton: false,
                    });
                    console.log(json);
                }

            }catch(err){
                console.log(err)
            }
        }
    </script>
@stop
