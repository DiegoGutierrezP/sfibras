<div wire:init="loadCotis" class="card">

        <div class="card-header">
            <div class="row">
                <div class="col-4 d-flex align-items-center">

                    <select class="form-control" wire:model="cant" style="width: 70px;">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                    <span class="ml-2">registros</span>
                </div>
                <div class="col-8 pl-5">
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
            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Referencia</th>
                            <th>Cliente</th>
                            <th>Emisión</th>
                            <th>Total</th>
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
                                <td>
                                    <a href="{{ route('admin.cotizacion.show', $coti->id) }}"
                                        class="btn btn-sm btn-sfibras"><i class="fas fa-eye"></i></a>
                                    <a href="" class="btn btn-sm btn-sfibras"><i class="fas fa-file-pdf"></i></a>
                                    <a href="" class="btn btn-sm btn-sfibras"><i class="fas fa-trash"></i></a>
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
