
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registrar mi Empresa</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('admin.miEmpresa.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label >Razon Social</label>
                <input type="text" class="form-control" name="razon_social" value="{{old('razon_social')}}"
                placeholder="nombre de la empresa">
                @error('razon_social')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label >Ruc</label>
                <input type="number" class="form-control" name="ruc" value="{{old('ruc')}}"
                placeholder="ruc de la empresa">
                @error('ruc')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label >Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{old('direccion')}}"
                placeholder="direccion de la empresa">
                @error('direccion')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label >Telefono</label>
                <input type="number" class="form-control" name="telefono" value="{{old('telefono')}}"
                placeholder="telefono de la empresa">
                @error('telefono')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label >Celular</label>
                <input type="number" class="form-control" name="celular" value="{{old('celular')}}"
                placeholder="celular de la empresa">
                @error('celular')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label >Email</label>
                <input type="text" class="form-control" name="email" value="{{old('email')}}"
                placeholder="email de la empresa">
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
                <div class="col-6 d-flex align-items-center justify-content-center">
                    @if(!isset($empresa->logo) || empty($empresa->logo))
                        <img id="imgLogo" src="{{Storage::url('admin/no_image.png')}}" class="img-fluid">
                    @else
                        <img id="imgLogo" src="{{Storage::url($empresa->logo)}}" class="img-fluid">
                    @endif
                </div>
                <div class="col-6">
                    <input type="file" id="fileLogo" name="fileLogo" accept="image/*" class="form-control-file">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum ipsa fuga tempore magnam explicabo eum?
                    </p>
                    @error('fileLogo')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <label >Firma</label>
            <div class="row mb-3">
                <div class="col-6" >
                    @if(!isset($empresa->firma_titular) || empty($empresa->firma_titular))
                        <img  id="imgFirma" src="{{Storage::url('admin/no_image.png')}}" class="img-fluid">
                    @else
                        <img  id="imgFirma" src="{{Storage::url($empresa->firma_titular)}}" class="img-fluid">
                    @endif
                </div>
                <div class="col-6">
                    <input type="file" id="fileFirma" name="fileFirma" accept="image/*" class="form-control-file">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum ipsa fuga tempore magnam explicabo eum?
                    </p>
                    @error('fileFirma')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-3">
                <a href="{{route('admin.miEmpresa.index')}}" class="btn btn-secondary ">Cancelar</a>
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
<script>
    document.addEventListener("change", e=>{
        if(e.target.matches('#fileLogo')){
            const $imgLogo = document.getElementById("imgLogo");
            cambiarImagen(e, $imgLogo)
        }
        if(e.target.matches('#fileFirma')){
            const $imgFirma = document.getElementById("imgFirma");
            cambiarImagen(e,$imgFirma)
        }
    })

    const cambiarImagen = (e, el) =>{
        const fileReader = new FileReader();//detecta los bits q van cargando
            fileReader.readAsDataURL(e.target.files[0]);

            fileReader.addEventListener("progress", e=>{
                el.setAttribute('src','/storage/admin/loader.svg');
            });
            fileReader.addEventListener("loadend", e=>{
                el.setAttribute('src',e.target.result);
            });
    }
</script>
@stop
