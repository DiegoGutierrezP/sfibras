<div>
    <a href="{{route('admin.ordenCompra.show',$ordenCompras->id)}}"
        class="btn btn-sm btn-sfibras2"><i class="fas fa-eye"></i></a>
    <a href="{{route('admin.ordenCompra.edit',$ordenCompras->id)}}" class="btn btn-sm btn-sfibras2"><i class="fas fa-pen"></i></a>
    <a href="" class="btn btn-sm btn-sfibras2"><i class="fas fa-file-pdf"></i></a>
    <button class="btn-cancel-oc btn btn-sm btn-danger font-weight-bold" @if ($ordenCompras->estadoPedido == 4) disabled @endif data-oc="{{$ordenCompras->id}}" data-codigo="{{$ordenCompras->codigoOC}}">X</button>
</div>
