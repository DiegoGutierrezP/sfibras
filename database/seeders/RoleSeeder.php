<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //roles
         $role1 = Role::create(['name'=>'Admin']);
         $role2 = Role::create(['name'=>'Employee']);


         //permisos
         Permission::create(['name'=> 'p.admin.home','description'=>'Ver el dashboard'])->syncRoles([$role1,$role2]);

         Permission::create(['name'=> 'p.admin.miEmpresa.edit','description'=>'Editar Empresa'])->syncRoles([$role1]);

         Permission::create(['name'=> 'p.admin.ordenCompra.edit','description'=>'Editar Orden de Compra'])->syncRoles([$role1]);
         Permission::create(['name'=> 'p.admin.ordenCompra.cancel','description'=>'Cancelar Orden de Compra'])->syncRoles([$role1]);
         Permission::create(['name'=> 'p.admin.ordenCompra.show','description'=>'Ver Informacio Orden de Compra'])->syncRoles([$role1]);
         Permission::create(['name'=> 'p.admin.ordenCompra.pdf','description'=>'PDF Orden de Compra'])->syncRoles([$role1]);

         Permission::create(['name'=> 'p.admin.cotizacion.cambiarEstado','description'=>'Cambiar estado cotizacion'])->syncRoles([$role1]);
         Permission::create(['name'=> 'p.admin.cotizacion.delete','description'=>'Eliminar cotizacion'])->syncRoles([$role1]);
         Permission::create(['name'=> 'p.admin.cotizacion.create','description'=>'Crear cotizacion'])->syncRoles([$role1]);
         Permission::create(['name'=> 'p.admin.cotizacion.clonar','description'=>'Clonar cotizacion'])->syncRoles([$role1,$role2]);

         Permission::create(['name'=> 'p.admin.pagos.index','description'=>'Ver Pagos'])->syncRoles([$role1]);
         Permission::create(['name'=> 'p.admin.pagos.create','description'=>'Registar Pagos'])->syncRoles([$role1]);
         Permission::create(['name'=> 'p.admin.pagos.edit','description'=>'Editar Pagos'])->syncRoles([$role1]);
    }
}
