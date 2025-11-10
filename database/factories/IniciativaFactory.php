<?php

namespace Database\Factories;

use App\Models\Iniciativa;
use App\Models\Estado;
use Illuminate\Database\Eloquent\Factories\Factory;

class IniciativaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Iniciativa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'estado_id' => Estado::factory(),
            'titulo' => $this->faker->sentence(),
            'descricao' => $this->faker->paragraph(),
            'tipo' => $this->faker->randomElement(['água', 'ecologia', 'saneamento', 'energia', 'conservação']),
            'status' => $this->faker->randomElement(['em_andamento', 'concluído', 'planejado']),
            'data_inicio' => $this->faker->date(),
            'data_fim' => $this->faker->date(),
            'impacto_estimado' => $this->faker->text(),
            'investimento' => $this->faker->randomFloat(2, 1000, 1000000),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'imagens' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]),
        ];
    }
}
