<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'razon_social'=>'SFIBRAS EIRL',
            'logo'=>'admin/sfibraslogo.png',
            'ruc'=>'20607075116',
            'direccion'=>'Av. Huaynacápac Mz BC Lt 12 Urb. Bellavista Jicamarca – Anexo 22',
            'telefono'=>'5555555',
            'celular'=>'994881486',
            'email'=>'ventas@sggfibrasyservicios.com'
        ]);
    }
}
