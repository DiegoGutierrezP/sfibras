@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Orden de Compra {{$oc->codigoOC}}</h1>
@stop

@section('content')
    <div class="card">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="info-oc-tab" data-toggle="tab" href="#info-oc" role="tab" aria-controls="info-oc" aria-selected="true">Informacion</a>
              <a class="nav-item nav-link" id="files-oc-tab" data-toggle="tab" href="#files-oc" role="tab" aria-controls="files-oc" aria-selected="false">Control y Documentos</a>
              <a class="nav-item nav-link" id="pagos-oc-tab" data-toggle="tab" href="#pagos-oc" role="tab" aria-controls="pagos-oc" aria-selected="false">Pagos</a>
            </div>
          </nav>
          <input type="hidden" value="{{$oc->id}}" class="id-oc">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="info-oc" role="tabpanel" aria-labelledby="info-oc-tab">
                @include('admin.ordenCompra.show-information',[$oc,$fechaEmisionOC,$moneda])
            </div>
            <div class="tab-pane fade" id="files-oc" role="tabpanel" aria-labelledby="files-oc-tab" >
                @include('admin.ordenCompra.show-control-files',[$oc])
            </div>
            <div class="tab-pane fade" id="pagos-oc" role="tabpanel" aria-labelledby="pagos-oc-tab">
                @include('admin.ordenCompra.show-pagos',[$oc,$moneda])
            </div>
          </div>

    </div>
    {{-- Modal Files --}}
    <div class="modal fade bd-example-modal-lg" id="filesOCModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header py-2">
                <a href="" id="descargar-fileOC" download>Descargar</a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="body">
                <div class="content-object d-none">
                    <object  id="fileshow-oc" data="" type="" width="100%" style="min-height: 80vh;"  >
                        No support
                      </object>
                </div>
                <div class="d-none content-img-file p-2 bg-secondary text-center">
                    <img src="" alt="" style="max-width:100%;max-height: 800px;">
                </div>
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

        let urlUpdateDatesOC = '{{ route('admin.ordenCompra.updateDatesOC') }}';
        let urlAddFilesOC = '{{ route('admin.files.addFilesOC') }}';
        let urlUpdateFilesOC = '{{ route('admin.files.updateFilesOC') }}';
        let urlDeleteFilesOC = '{{ route('admin.files.deleteFilesOC', ':id') }}';
        let urlGetFilesOC = '{{ route('admin.files.getFilesOC', ':id') }}';
        let urlGetDatesOC = '{{ route('admin.ordenCompra.getDatesOC', ':id') }}';
        let urlAddPagosOC = '{{ route('admin.pagos.addPagosOC') }}';
        let urlUpdatePagosOC = '{{ route('admin.pagos.updatePagosOC') }}';
        let urlGetPagosOC = '{{ route('admin.pagos.getPagosOC', ':id') }}';
        let token = "{{ csrf_token() }}";

        /* var idOC = d.querySelector(".id-oc").value;

        document.addEventListener("DOMContentLoaded",async ()=>{
            await cargarStepsDate();
            await cargarFilesOC();
            let res1 = await cargarPagosOC();
            //await calcularInfoPagos();//espera la respuesta de cargarPagosOC

        })

        function showFileModal(tipo_archivo,url){
            let $objectTag = d.querySelector("#filesOCModal #fileshow-oc"),
                $imgFile = d.querySelector("#filesOCModal .content-img-file"),
                $descarga = d.querySelector("#filesOCModal #descargar-fileOC");
                //$objectTag.classList.add('d-none');
                d.querySelector("#filesOCModal .content-object").classList.add('d-none');
                $imgFile.classList.add('d-none');
                let ext = tipo_archivo.split('/').pop();
                $objectTag.innerHTML = '';
                if(ext=="pdf"){
                    //$objectTag.setAttribute('data', `/storage/${url}`);
                    //$objectTag.setAttribute('type', tipo_archivo);
                    //$objectTag.classList.remove('d-none');
                    var object = document.querySelector('#filesOCModal #fileshow-oc');
                    object.setAttribute('data', `/storage/${url}`);
                    var clone = object.cloneNode(true);
                    var parent = object.parentNode;
                    parent.removeChild(object );
                    parent.appendChild(clone );
                    d.querySelector("#filesOCModal .content-object").classList.remove('d-none');

                }else if(ext == "pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
                    $imgFile.querySelector('img').src=`/storage/${url}`;
                    $imgFile.querySelector('img').alt=url;
                    $imgFile.classList.remove('d-none');
                }
                $descarga.href=`/storage/${url}`;
                //console.log($objectTag);
                $("#filesOCModal").modal("show");
        }
        function validateFile($inputFile,$errorFile,data = ''){
            let bandera =false;
            if($inputFile.value !=''){
                let ext = $inputFile.value.split('.').pop();
                if(ext == "pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
                    let sizeMegaBytes = $inputFile.files[0].size/1024;//lo pasamos de bytes a kilobytes
                    if(ext == "pdf"){
                        if(sizeMegaBytes < 1024){//en kilobytes
                            bandera = true;
                        }else{
                            $errorFile.textContent = "El archivo excede los 1mb";
                        }
                    }else{
                        if(sizeMegaBytes < 3072){//menor a 3 mb
                            bandera = true;
                        }else{
                            $errorFile.textContent = "La imagen excede los 3mb";
                        }
                    }
                }else{
                    $errorFile.textContent = "Solo se aceptan formatos pdf o imagenes";
                }
            }else{
                if(data == 'noNecesary'){
                    bandera = true;
                }else{
                  $errorFile.textContent = "El campo file es necesario";
                }
            }
            return bandera;
        }
        function swalSuccess(icon,msg){
            Swal.fire({
                position: 'top-end',
                icon: icon,
                title: msg,
                background:'#E6F4EA',
                toast:true,
                color: '#333',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            })
        }
        async function ajax(obj){
            let {url,ops,success,error} = obj;
            try{
                let res = await fetch(url,ops);
                let json = await res.json();
                if (!res.ok) throw {
                    status: res.status,
                    statusText: res.statusText
                };
                success(json);
                return true;
            }catch(err){
                console.log(err);
                error(err);
                return false;
            }
        } */
    </script>
    <script type="module" src="{{asset('js/admin/ocShow.js')}}"></script>
@stop
