<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colegiado>
 */
class ColegiadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombres'=>$this->faker->name(),
            'codigo'=>$this->faker->unique()->numberBetween(100000, 999999),
            'dni'=>$this->faker->unique()->numberBetween(10000000, 99999999),
            'paterno'=>$this->faker->name(),
            'materno'=>$this->faker->name(),
            'email'=>$this->faker->name(),
            'direccion'=>$this->faker->sentence(),
            'telefono'=>$this->faker->unique()->numberBetween(100000000, 999999999),
            'capitulo_id'=>$this->faker->numberBetween(1,12)
        ];
    }
}
