@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.roles.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nombre del Rol</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nombre del rol">
                    @error('name')
                        <small class="text-danger" >{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Lista de Permisos</label>
                    <div class="ml-4">
                    @foreach ($permisos as $permiso)
                        <label>
                            <input  type="checkbox" name="permissions[]" value="{{$permiso->id}}" @if(is_array(old('permissions')) && in_array($permiso->id, old('permissions'))) checked @endif class="form-check-input" >
                            {{$permiso->description}}
                        </label>
                        <br>
                    @endforeach
                    </div>
                </div>
                <br>
                <input type="submit" value="Crear Rol" class="btn btn-primary">
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')

@stop
