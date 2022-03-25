@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="content-cards-dash ">
        <div class="card-dash" id="ingresos-mes">
            <div class="content ">
                <h3 class="title">Ingresos de este mes</h3>
                <span class="number"></span>
            </div>
            <div class="content-icon">
                <div class="fas fa-coins"></div>
            </div>
        </div>
        <div class="card-dash" id="pedidos-mes">
            <div class="content">
                <h3 class="title">Pedidos de este Mes</h3>
                <span class="number"></span>
            </div>
            <div class="content-icon">
                <div class="fas fa-boxes"></div>
            </div>
        </div>
        <div class="card-dash" id="pedidos-pendientes">
            <div class="content">
                <h3 class="title">Pedidos Pendientes</h3>
                <span class="number"></span>
            </div>
            <div class="content-icon">
                <div class="fas fa-boxes"></div>
            </div>
        </div>
        <div class="card-dash" id="pedidos-entregados">
            <div class="content ">
                <h3 class="title">Pedidos Entregados</h3>
                <span class="number"></span>
            </div>
            <div class="content-icon">
                <div class="fas fa-truck"></div>
            </div>
        </div>
    </div>
    <div class="content-cards-chart row justify-content-around mt-4">
        <div class="col-lg-6 col-md-6 col-12">
           <div class="card" id="card-chartIngresos">
                <div class="card-body">
                    <h4 class="text-center mb-3">Ingresos ultimos 4 meses</h4>
                    <div class="loader text-center">
                    </div>
                    <canvas id="chartIngresos" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card" id="card-chartPedidos">
                <div class="card-body">
                    <h4 class="text-center mb-3">Pedidos ultimos 4 meses</h4>
                    <div class="loader text-center">
                    </div>
                    <canvas id="chartPedidos" width="400" height="400"></canvas>
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        let urlInfoCards = '{{route('admin.dashboard.getInfoCards')}}';
        let urlIngresosMeses = '{{route('admin.dashboard.getIngresosUltimos4Meses')}}';
        let urlPedidosMeses = '{{route('admin.dashboard.getPedidosUltimos4Meses')}}';
    </script>
    <script type="module" src="{{asset('js/admin/dashboard.js')}}"></script>
@stop
