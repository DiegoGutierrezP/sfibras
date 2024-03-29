<div>
    <a href="{{ route('admin.cotizacion.show', $cotis->id) }}"
        class="btn btn-sm btn-sfibras2"><i class="fas fa-eye"></i></a>
    <a href="{{ route('admin.cotizacion.pdf', $cotis->id) }}" class="btn btn-sm btn-sfibras2"><i class="fas fa-file-pdf"></i></a>
    @can('p.admin.cotizacion.clonar')
        <a href="{{ route('admin.cotizacion.clonar', $cotis->id) }}" class="btn btn-sm btn-sfibras2"><i class="fas fa-copy"></i></a>
    @endcan
    @can('p.admin.cotizacion.delete')
        <a href="" class="btn-delete-coti btn btn-sm btn-danger" data-coti="{{$cotis->id}}"><i data-coti="{{$cotis->id}}" class="fas fa-trash"></i></a>
    @endcan
</div>
