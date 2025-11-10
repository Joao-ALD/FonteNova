<?php

namespace Database\Factories;

use App\Models\Estado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sigla' => $this->faker->unique()->stateAbbr(),
            'nome' => $this->faker->state(),
            'regiao' => $this->faker->randomElement(['Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul']),
            'dados_geograficos' => json_encode(['path' => 'M12,2L4.5,20.29L5.21,21L12,18L18.79,21L19.5,20.29L12,2Z']),
        ];
    }
}
