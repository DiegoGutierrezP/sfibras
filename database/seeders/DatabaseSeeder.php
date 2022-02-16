<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Cliente::factory(15)->create();
        $this->call(UserSeeder::class);
        $this->call(EmpresaSeeder::class);
    }
}
