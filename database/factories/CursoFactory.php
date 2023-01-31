<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->sentence(),
            'temario'=>$this->faker->text(),
            'duracion'=>$this->faker->numberBetween(10,20),
            'fecha_inicio'=>$this->faker->date(),
            'fecha_fin'=>$this->faker->date(),
            'descripcioncertificado'=>$this->faker->sentence(),
            'encabezado'=>$this->faker->randomElement(['0','1']),
            'codigo'=>$this->faker->randomElement(['1','2','3','4','5']),
            'certificado'=>$this->faker->sentence(),
            'footer'=>$this->faker->randomElement(['0','1','2']),
            'capitulo_id'=>$this->faker->numberBetween(1,12),
            'estado'=>$this->faker->randomElement(['1','2','3'])
        ];
    }
}
