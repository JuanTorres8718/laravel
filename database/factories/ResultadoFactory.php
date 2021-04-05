<?php

namespace Database\Factories;

use App\Models\Resultado;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resultado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_resultado'=>$this->faker->id_resultado,
            'nombre_resultado'=>$this->faker->nombre_resultado,
        ];
    }
}
