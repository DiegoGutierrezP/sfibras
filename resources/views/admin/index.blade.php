
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
   <div class="content-cards-dash ">
        <div class="card-dash">Pedidos Pendientes</div>
        <div class="card-dash">Pendientes de Pago</div>
        <div class="card-dash">Cotizaciones generadas</div>
        <div class="card-dash">Pedidos Entregados</div>
   </div>
   <div class="card mt-3">
       <div class="card-body">

       </div>
   </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')

@stop
