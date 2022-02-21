<div wire:ignore.self class="modal fade" id="updateClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar informacion del cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form >
                    <div class="form-group mb-3">
                        <label >Nombre del Cliente</label>
                        <input type="text" class="form-control"  wire:model="nombre" placeholder="nombre del cliente">
                        @error('nombre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label >Dni</label>
                        <input type="number" class="form-control" wire:model="dni" placeholder="dni del cliente">
                        @error('dni')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label >Ruc del Cliente</label>
                        <input type="number" class="form-control" wire:model="ruc" placeholder="ruc del cliente">
                        @error('ruc')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label >Telefono del Cliente</label>
                        <input type="number" class="form-control" wire:model="telefono" placeholder="telefono del cliente">
                        @error('telefono')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label >Email del Cliente</label>
                        <input type="text" class="form-control" wire:model="email" placeholder="email del cliente">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label >Dirección del Cliente</label>
                        <input type="text" class="form-control" wire:model="direccion" placeholder="ruc del cliente">
                        @error('direccion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:loading.attr="disabled" wire:target="update"  wire:click.prevent="update()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
