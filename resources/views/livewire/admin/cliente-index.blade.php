<div class="card">
    @include('livewire.admin.cliente-create')
    @include('livewire.admin.cliente-update')

    {{-- @if (session('msginfo'))
        <div class="alert alert-success alert-dismissible fade show my-3 mx-2" role="alert">
            <strong>{{session('msginfo')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif --}}

    <div class="card-header">
        <a href="" class="btn-crear-cliente btn btn-secondary mb-3" wire:click.prevent="create()">Registrar Cliente</a>
        {{-- <input  type="search"
                wire:model="search"
                placeholder="Ingrese nombre, dni o ruc del cliente"
                class="form-control" > --}}
                <div class="input-group">
                    <input class="form-control py-2 border-right-0" type="search"  wire:model="search"
                    placeholder="Ingrese nombre, dni o ruc del cliente">
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                    </span>
                </div>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>dni</th>
                        <th>ruc</th>
                        <th>Dirección</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($clientes->count())
                    @foreach ($clientes as $cliente)
                        <tr>
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->nombre}}</td>
                        <td>{{is_null($cliente->dni)? '-' : $cliente->dni}}</td>
                        <td>{{is_null($cliente->ruc)? '-' : $cliente->ruc}}</td>
                        <td>{{$cliente->direccion}}</td>
                        <td width="10px"><a class="btn-editar-cliente btn btn-light btn-sm"   wire:click.prevent="edit({{ $cliente->id }})"><i class="fas fa-pen"></i></a></td>
                        <td width="10px">
                            <a wire:click="$emit('deleteCliente',{{$cliente}})"  class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i></a>
                        </td>
                        </tr>
                    @endforeach
                    @else
                        <tr><td colspan="4">No hay registros</td></tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{$clientes->links()}}
    </div>


</div>
