
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Cotizaciones</h1>
@stop

@section('content')
    @livewire('admin.cotizacion-index')
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
                timer: 3000,
                timerProgressBar: true,
            })
        @endif

        const d = document;
        d.addEventListener("click",e=>{
            if(e.target.matches(['.btn-delete-coti','.btn-delete-coti *'])){
                e.preventDefault();

                Swal.fire({
                    title: 'Esta seguro?',
                    text: "No podras recuperar la cotización",
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText:'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if(result.value) {
                        //console.log(e.target.dataset.coti);
                        let url = '{{ route('cotizacion.delete', ':id') }}';
                        url = url.replace(':id', e.target.dataset.coti);
                        let obj ={
                            url:url,
                            ops:{
                                method: "DELETE",
                                headers: {
                                    "Content-type": "application/json; charset=utf-8",
                                    "X-CSRF-TOKEN":"{{csrf_token()}}"
                                }
                            },
                            success: json=>{
                                Livewire.emitTo('admin.cotizacion-index','render');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: json.data.icon,
                                    title: json.data.msg,
                                    background:'#E6F4EA',
                                    toast:true,
                                    color: '#333',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                })
                            },
                            error: err => {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: err.data.icon,
                                    title: err.data.msg,
                                    background:'#FFD2D2',
                                    toast:true,
                                    color: '#D8000C',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                })
                            },
                        }
                        ajaxDelete(obj);
                    }

                })
            }
        })

        async function ajaxDelete(obj){
            let {url,success,error,ops} = obj;
            try{
                let res = await fetch(url,ops),
                json = await res.json();
                if(!res.ok) throw {status: res.status , statusText: res.statusText};
                success(json);
            }catch(err){
                console.log(err);
                error(err);
            }
        }

    </script>
@stop
