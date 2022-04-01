<div wire:init="loadClients" class="card">
    @include('livewire.admin.cliente-create')
    @include('livewire.admin.cliente-update')


        <div class="card-header">
            <a href="" class="btn-crear-cliente btn btn-secondary mb-3" wire:click.prevent="create()">Registrar
                Cliente</a>
            <div class="input-group">
                <input class="form-control py-2 border-right-0" type="search" wire:model="search"
                    placeholder="Ingrese nombre, dni o ruc del cliente">
                <span class="input-group-append">
                    <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                </span>
            </div>
        </div>
    @if (count($clientes))
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dni</th>
                            <th>Ruc</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($clientes->count())
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ is_null($cliente->dni) ? '-' : $cliente->dni }}</td>
                                    <td>{{ is_null($cliente->ruc) ? '-' : $cliente->ruc }}</td>
                                    <td style="min-width: 150px;">
                                        <a class="btn btn-sfibras2 btn-sm"
                                            href="{{ route('admin.clientes.show', $cliente) }}"><i
                                                class="fas fa-eye"></i></a>
                                        <a
                                            class="btn-editar-cliente btn btn-sfibras2 btn-sm"
                                                wire:click.prevent="edit({{ $cliente->id }})"><i
                                                    class="fas fa-pen"></i></a>
                                        {{-- <a wire:click="$emit('deleteCliente',{{ $cliente }})"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No hay registros</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $clientes->links() }}
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
