@extends('adminlte::page')

@section('title', 'Orden de Compra')

@section('content_header')
    <h1>Registrar Orden de Compra</h1>
@stop

@section('content')


@if (is_null($cotizacion))
    @include('admin.ordenCompra.create-info-nosent')
@else
    @include('admin.ordenCompra.create-info-sent')
@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')

@stop
