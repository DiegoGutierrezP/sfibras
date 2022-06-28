@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Roles</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{route('admin.roles.create')}}" class="float-right btn btn-sfibras2"> Crear Rol</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Role</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $rol)
                            <tr>
                                <td>{{$rol->id}}</td>
                                <td>{{$rol->name}}</td>
                                <td width="10px">
                                    <a href="{{route('admin.roles.edit',$rol->id)}}" class="btn btn-sm btn-sfibras2"><i class="fas fa-pen"></i></a>
                                </td>
                                <td width="10px">
                                    <form id="form-delete-rol" action="{{route('admin.roles.destroy',$rol->id)}}" method="POST">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="btn btn-delete-rol btn-sm btn-danger" ><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
<script src="{{ asset('js/admin/rolesIndex.js') }}"></script>

@stop
