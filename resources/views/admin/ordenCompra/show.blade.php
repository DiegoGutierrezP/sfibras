@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Orden de Compra</h1>
@stop

@section('content')
    <div class="card">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="info-oc-tab" data-toggle="tab" href="#info-oc" role="tab" aria-controls="info-oc" aria-selected="true">Informacion</a>
              <a class="nav-item nav-link" id="files-oc-tab" data-toggle="tab" href="#files-oc" role="tab" aria-controls="files-oc" aria-selected="false">Documentos</a>
              <a class="nav-item nav-link" id="pagos-oc-tab" data-toggle="tab" href="#pagos-oc" role="tab" aria-controls="pagos-oc" aria-selected="false">Pagos</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="info-oc" role="tabpanel" aria-labelledby="info-oc-tab">information</div>
            <div class="tab-pane fade" id="files-oc" role="tabpanel" aria-labelledby="files-oc-tab">Files</div>
            <div class="tab-pane fade" id="pagos-oc" role="tabpanel" aria-labelledby="pagos-oc-tab">Pagos</div>
          </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
