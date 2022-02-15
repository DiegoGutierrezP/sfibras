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
                        /* Swal.fire(
                        'Good job!',
                        'You clicked the button!',
                        'success'
                        ) */
                        console.log(cliente.id);
                    }

                })
            })
    </script>
@stop
