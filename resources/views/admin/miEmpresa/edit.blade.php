
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Información de la Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.miEmpresa.update',$empresa)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label >Razon Social</label>
                    <input type="text" class="form-control" name="razon_social" value="{{$empresa->razon_social}}">
                    @error('razon_social')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label >Ruc</label>
                    <input type="number" class="form-control" name="ruc" value="{{$empresa->ruc}}">
                    @error('ruc')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label >Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="{{$empresa->direccion}}">
                    @error('direccion')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label >Telefono</label>
                    <input type="number" class="form-control" name="telefono" value="{{$empresa->telefono}}">
                    @error('telefono')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label >Celular</label>
                    <input type="number" class="form-control" name="celular" value="{{$empresa->celular}}">
                    @error('celular')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label >Email</label>
                    <input type="text" class="form-control" name="email" value="{{$empresa->email}}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Cuentas Bancarias</label>
                    <div class="card">
                        @livewire('admin.cuentas-bancarias')
                    </div>
                </div>
                <label >Logo</label>
                <div class="row mb-3">
                    <div class="col-6">
                        @if(!isset($empresa->logo) || empty($empresa->logo))
                            <img src="{{Storage::url('admin/no_image.png')}}" class="img-fluid">
                        @else
                            <img src="{{Storage::url($empresa->logo)}}" class="img-fluid">
                        @endif
                    </div>
                    <div class="col-6">
                        <input type="file" class="form-control-file">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum ipsa fuga tempore magnam explicabo eum?
                        </p>
                    </div>
                </div>
                <label >Firma</label>
                <div class="row mb-3">
                    <div class="col-6">
                        @if(!isset($empresa->firma_titular) || empty($empresa->firma_titular))
                            <img src="{{Storage::url('admin/no_image.png')}}" class="img-fluid">
                        @else
                            <img src="{{Storage::url($empresa->firma_titular)}}" class="img-fluid">
                        @endif
                    </div>
                    <div class="col-6">
                        <input type="file" class="form-control-file">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum ipsa fuga tempore magnam explicabo eum?
                        </p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{route('admin.miEmpresa.show',$empresa)}}" class="btn btn-secondary ">Cancelar</a>
                    <button type="submit" class="btn btn-primary ">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
@stop
