<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->unique()->name,
            'ruc'=>$this->faker->numerify('##########'),
            'direccion'=>$this->faker->text(50)
        ];
    }
}
