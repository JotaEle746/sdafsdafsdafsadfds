<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capitulo>
 */
class CapituloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->randomElement(['Capitulo de Sistemas', 'Capitulo de Minas', 'Capitulo de Agricultura', 'Capitulo de Ambiental', 'Capitulo de Civil']),
            'decano'=>$this->faker->name()
        ];
    }
}
