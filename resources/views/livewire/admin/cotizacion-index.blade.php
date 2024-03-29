<div wire:init="loadCotis" class="card">

        <div class="card-header">

                <div class="d-flex align-items-center mb-2">
                    <select class="form-control" wire:model="cant" style="width: 70px;">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                    <span class="ml-2">registros</span>
                </div>
                <div class="row">
                <div class="col-lg-4 col-md-4 col-12 d-flex align-items-center mb-2">
                    <select wire:model="estado" class="form-control">
                        <option value="">Todos</option>
                        <option value="1">Pendiente</option>
                        <option value="2">Aceptado</option>
                        <option value="3">Aceptado/Modificado</option>
                        <option value="4">Expirado</option>
                        <option value="5">Rechazado</option>
                    </select>
                </div>
                <div class="col-lg-8 col-md-8 col-12 pl-lg-5 pl-md-5 pl-0 mb-2">
                    <div class="input-group">
                        <input class="form-control py-2 border-right-0" type="search" wire:model="search"
                            placeholder="Ingrese codigo o nombre del cliente">
                        <span class="input-group-append">
                            <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                        </span>
                    </div>

                </div>
            </div>

        </div>
    @if (count($cotizaciones))
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Referencia</th>
                            <th>Cliente</th>
                            <th>Emisión</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cotizaciones as $coti)
                            <tr>
                                <td>{{ $coti->codigoCoti }}</td>
                                <td>{{ $coti->referenciaCoti? $coti->referenciaCoti: '-' }}</td>
                                <td>{{ $coti->clienteNombre }}</td>
                                <td>{{ $coti->fechaEmision }}</td>
                                <td>{{ $coti->tipoMoneda == 'soles' ? 'S/. ' . $coti->precioTotalCoti : '$. ' . $coti->precioTotalCoti }}
                                </td>
                                <td width="10px">
                                    @if ($coti->estado == 1)
                                        <h5 ><span class=" badge badge-warning ">Pendiente</span></h5>
                                    @elseif($coti->estado == 2)
                                        <h5><span class=" badge badge-success" >Aceptado</span></h5>
                                    @elseif($coti->estado == 3)
                                        <h5><span class=" badge badge-primary" >Aceptado/Modificado</span></h5>
                                    @elseif($coti->estado == 4)
                                        <h5><span class=" badge badge-secondary" >Expirado</span></h5>
                                    @elseif($coti->estado == 5)
                                        <h5><span class=" badge badge-danger" >Rechazado</span></h5>
                                    @endif
                                </td>
                                <td style="min-width:160px;">
                                    <a href="{{ route('admin.cotizacion.show', $coti->id) }}"
                                        class="btn btn-sm btn-sfibras2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.cotizacion.pdf', $coti->id) }}" class="btn btn-sm btn-sfibras2"><i class="fas fa-file-pdf"></i></a>
                                    <a href="{{ route('admin.cotizacion.clonar', $coti->id) }}" class="btn btn-sm btn-sfibras2"><i class="fas fa-copy"></i></a>
                                    <a href="" class="btn-delete-coti btn btn-sm btn-danger" data-coti="{{$coti->id}}"><i data-coti="{{$coti->id}}" class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $cotizaciones->links() }}
        </div>
    @else
        <div class="d-flex align-items-center justify-content-center my-5">
            @if ($search)
                No se encontraron registros
            @else
                <img src="{{Storage::url('admin/loader.svg')}}" alt="loader">
            @endif

        </div>
    @endif

</div>
