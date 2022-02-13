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

@stop
