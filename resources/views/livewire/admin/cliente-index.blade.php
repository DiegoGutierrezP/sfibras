<div class="card">

    @if (session('msginfo'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('msginfo')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

   {{-- {{$search}} --}}
    <div class="card-header">
        <input  wire:model="search" class="form-control" placeholder="Ingrese nombre o ruc del cliente">
    </div>
    <div class="card-body">
        <table class="table table-striped" >

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>dni</th>
                    <th>ruc</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @if ($clientes->count())
                @foreach ($clientes as $cliente)
                    <tr>
                       <td>{{$cliente->id}}</td>
                       <td>{{$cliente->nombre}}</td>
                       <td>
                        @if (is_null($cliente->dni))
                            -
                        @else
                            {{$cliente->dni}}
                        @endif
                        </td>
                       <td>{{$cliente->ruc}}</td>
                       <td width="10px"><a class="btn btn-primary btn-sm" href="">Editar</a></td>
                       <td width="10px">
                           <form action="" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                           </form>
                       </td>
                    </tr>
                @endforeach
                @else
                    <tr><td colspan="4">No hay registros</td></tr>
                @endif

            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$clientes->links()}}
    </div>
</div>