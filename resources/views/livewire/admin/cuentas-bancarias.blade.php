<div>
    <table class="table">
        <thead>
            <tr>
                <th>Banco</th>
                <th>Nro. Cuenta</th>
                <th>Tipo de cuenta</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentasBancas as $index => $cuenta)
                <tr>
                    <td width="20%">
                        <input type="text" class="form-control"  name="cuentasBancas[{{ $index }}][banco]"
                        placeholder="nombre banco"
                        wire:model="cuentasBancas.{{$index}}.banco">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="cuentasBancas[{{ $index }}][nro_cuenta]"
                        placeholder="numero de cuenta"
                        wire:model="cuentasBancas.{{$index}}.nro_cuenta">
                    </td>
                    <td>
                        <select class="form-control" name="cuentasBancas[{{ $index }}][tipo_cuenta]"
                         wire:model="cuentasBancas.{{$index}}.tipo_cuenta">
                            <option value="soles" selected>Soles</option>
                            <option value="dolares">Dolares</option>
                        </select>
                    </td>
                    <td>
                        <a wire:click.prevent="removeCuenta({{ $index }})"
                                                href="#">Borrar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    @error('cuentasBancas.*.banco')
                        <small class="text-danger">{{$message}}</small><br>
                    @enderror
                    @error('cuentasBancas.*.nro_cuenta')
                        <small class="text-danger">{{$message}}</small><br>
                    @enderror
                </td>
            </tr>

            <tr>
                <td><button class="btn btn-sm btn-secondary" wire:click.prevent="addCuenta">Agregar Cuenta</button></td>
            </tr>
        </tfoot>
    </table>

</div>
