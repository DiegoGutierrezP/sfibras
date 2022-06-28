@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <form action="{{route('admin.roles.update',$role)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nombre del Rol</label>
                    <input type="text" class="form-control" name="name" value="{{$role->name}}" placeholder="Nombre del rol">
                    @error('name')
                        <small class="text-danger" >{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Lista de Permisos</label>
                    <div class="ml-4">
                    @foreach ($permisos as $permiso)
                        <label>
                            <input  type="checkbox" name="permissions[]" value="{{$permiso->id}}" {{(in_array($permiso->id,$roper))?'checked':''}} class="form-check-input" >
                            {{$permiso->description}}
                        </label>
                        <br>
                    @endforeach
                    </div>
                </div>
                <br>
                <input type="submit" value="Editar Rol" class="btn btn-primary">
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        @if (Session::has('msg-sweet'))
            let msg = "{{ Session::get('msg-sweet') }}";
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            background:'#E6F4EA',
            toast:true,
            color: '#333',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            })
        @endif
    </script>
@stop
