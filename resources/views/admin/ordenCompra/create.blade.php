@extends('adminlte::page')

@section('title', 'Orden de Compra')

@section('content_header')
    <h1>Registrar Orden de Compra</h1>
@stop

@section('content')
    {{$cotizacion}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
