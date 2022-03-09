@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Orden de Compra {{$oc->codigoOC}}</h1>
@stop

@section('content')
    <div class="card">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link " id="info-oc-tab" data-toggle="tab" href="#info-oc" role="tab" aria-controls="info-oc" aria-selected="true">Informacion</a>
              <a class="nav-item nav-link active" id="files-oc-tab" data-toggle="tab" href="#files-oc" role="tab" aria-controls="files-oc" aria-selected="false">Control y Documentos</a>
              <a class="nav-item nav-link" id="pagos-oc-tab" data-toggle="tab" href="#pagos-oc" role="tab" aria-controls="pagos-oc" aria-selected="false">Pagos</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade " id="info-oc" role="tabpanel" aria-labelledby="info-oc-tab">
                @include('admin.ordenCompra.show-information',[$oc,$fechaEmisionOC,$moneda])
            </div>
            <div class="tab-pane fade show active" id="files-oc" role="tabpanel" aria-labelledby="files-oc-tab" >
                @include('admin.ordenCompra.show-control-files',[$oc])
            </div>
            <div class="tab-pane fade" id="pagos-oc" role="tabpanel" aria-labelledby="pagos-oc-tab">Pagos</div>
          </div>

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        /* const d = document;
        document.addEventListener('DOMContentLoaded', () => {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale:'es',
                    headerToolbar:{
                        left:'prev,next,today',
                        center:'title',
                        right:'dayGridMonth,timeGridWeek,listWeek'
                    },
                    handleWindowResize:true,
                    contentHeight: 600,
                    aspectRatio:  3,
                    dateClick: function(){
                        console.log('ai')
                    }
                });

                calendar.updateSize();
                calendar.render();

        }); */

    </script>
@stop
