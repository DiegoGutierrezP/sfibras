@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1>Lista de Clientes</h1>
@stop

@section('content')

    @livewire('admin.cliente-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>

        /* document.addEventListener("click", e =>{
            if(e.target.matches(".btn-crear-cliente")){
                e.preventDefault();
                $('#createClienteModal').modal('show');
            }
            if(e.target.matches(".btn-editar-cliente")){
                e.preventDefault();
                //Livewire.emitTo('admin.cliente-index','edit',e.target.dataset.cliente);
                //console.log(e.target.dataset.cliente)
            }
        })*/
        Livewire.on('msg-sweet',function(msg){
            Swal.fire({
                position: 'top-end',
                type: 'success',
                text: msg,
                showConfirmButton: false,
                timer: 2000
            })
        })

        Livewire.on('modalEdit',function(){
            $('#updateClienteModal').modal('show');
            //console.log(cliente);
        })
        Livewire.on('modalCreate',function(){
            $('#createClienteModal').modal('show');
            //console.log(cliente);
        })
        Livewire.on('closeModalCliente',function(){
            $('#createClienteModal').modal('hide');
            $('#updateClienteModal').modal('hide');
        })

        Livewire.on('deleteCliente', function (cliente) {
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Se eliminara el cliente "+ cliente.nombre,
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText:'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if(result.value) {
                        Livewire.emitTo('admin.cliente-index','delete',cliente);
                    }

                })
            })
    </script>
@stop
