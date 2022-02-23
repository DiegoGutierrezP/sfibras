<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-8 pl-5">
                <div class="input-group">
                    <input class="form-control py-2 border-right-0" type="search"
                    placeholder="Ingrese codigo o nombre del cliente">
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                    </span>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table table-bordered">
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
                        <td>{{$coti->id}}</td>
                        <td>{{$coti->referenciaCoti}}</td>
                        <td>{{$coti->cliente->nombre}}</td>
                        <td>{{$coti->fechaEmision}}</td>
                        <td>{{$coti->precioTotalCoti}}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-sfibras"><i class="fas fa-eye"></i></a>
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
        {{$cotizaciones->links()}}
    </div>
</div>
