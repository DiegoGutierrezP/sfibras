<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Diego Gutierrez',
            'email' => 'diego.gup.75@gmail.com',
            'password' => bcrypt('diego123')
        ])->assignRole('Admin');

        User::factory(10)->create();
    }
}
