@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="content-cards-dash ">
        <div class="card-dash">
            <div class="content ">
                <h3 class="title">Ingresos de este mes</h3>
                <span class="number">$. 3123</span>
            </div>
            <div class="content-icon">
                <div class="fas fa-coins"></div>
            </div>
        </div>
        <div class="card-dash">
            <div class="content ">
                <h3 class="title">Pedidos de este mes</h3>
                <span class="number">3123</span>
            </div>
            <div class="content-icon">
                <div class="fas fa-boxes"></div>
            </div>
        </div>
        <div class="card-dash">
            <div class="content ">
                <h3 class="title">Pedidos Pendientes</h3>
                <span class="number">3123</span>
            </div>
            <div class="content-icon">
                <div class="fas fa-boxes"></div>
            </div>
        </div>
        <div class="card-dash">
            <div class="content ">
                <h3 class="title">Pedidos Entregados</h3>
                <span class="number">3123</span>
            </div>
            <div class="content-icon">
                <div class="fas fa-truck"></div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop
