@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agenda</h1>
@stop

@section('content')
    <div>
        <div id="agenda">

        </div>
    </div>
    {{-- Modal calendar --}}
    <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Calendar Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-agenda">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" name="title" id="title">
                            <small class="text-danger error-title"></small>
                        </div>
                        <div class="form-group">
                            <label for="descrip">Descripcion</label>
                            <textarea name="descripcion" id="descrip" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="start">Fecha de Inicio</label>
                            <input type="datetime-local" name="start" class="form-control" id="start">
                            <small class="text-danger error-start"></small>
                        </div>
                        <div class="form-group">
                            <label for="end">Fecha de Final</label>
                            <input type="datetime-local" name="end" class="form-control" id="end">
                            <small class="text-danger error-end"></small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn-registrar-event btn btn-primary" data-row="">Registrar</button>
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
        let urlGetEvents = '{{route('admin.agenda.getEvents')}}';
        let urlStoreEvent = '{{route('admin.agenda.storeEvent')}}';
    </script>
    <script type="module" src="{{ asset('js/admin/agenda.js') }}"></script>
@stop
