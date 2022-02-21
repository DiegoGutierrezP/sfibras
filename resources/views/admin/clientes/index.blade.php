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

        Livewire.on('msg-sweet',function(msg){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                background:'#E6F4EA',
                toast:true,
                color: '#333',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
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
