
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

@stop
