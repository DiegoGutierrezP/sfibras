@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agenda</h1>
@stop

@section('content')
    <div class="card" >
        <div class="card-body" >
            <div id="agenda">

            </div>
        </div>
    </div>
    {{-- Modal calendar --}}
    <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Evento</h5>
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
    {{-- Modal calendar show/update--}}
    <div class="modal fade" id="calendarShowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-event">
                        @csrf
                        <input type="hidden" name="id_event" value="">
                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" name="title" id="title" readonly>
                            <small class="text-danger error-title"></small>
                        </div>
                        <div class="form-group">
                            <label for="descrip">Descripcion</label>
                            <textarea name="descripcion" id="descrip" class="form-control" rows="2" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label for="start">Fecha de Inicio</label>
                            <input type="datetime-local" name="start" class="form-control" id="start" readonly>
                            <small class="text-danger error-start"></small>
                        </div>
                        <div class="form-group">
                            <label for="end">Fecha de Final</label>
                            <input type="datetime-local" name="end" class="form-control" id="end" readonly>
                            <small class="text-danger error-end"></small>
                        </div>
                    </form>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkEditarEvent">
                        <label class="form-check-label" for="checkEditarEvent">Editar Evento</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn-update-event btn btn-primary d-none" >Actualizar</button>
                    <button type="button" class="btn-delete-event btn btn-danger"><i class="fas fa-trash"></i></button>
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
        let urlUpdateEvent = '{{route('admin.agenda.updateEvent')}}';
        let urlDeleteEvent = '{{route('admin.agenda.deleteEvent',':id')}}';
    </script>
    <script type="module" src="{{ asset('js/admin/agenda.js') }}"></script>
@stop
