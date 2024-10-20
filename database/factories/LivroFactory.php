<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(2),
            'editora' => $this->faker->company,
            'edicao' => $this->faker->numberBetween(1, 10),
            'ano_publicacao' => $this->faker->year,
            'valor' => $this->faker->randomFloat(2, 10, 100),
            'isbn' => $this->faker->isbn13,
            'imagem_capa' => null,  
        ];
    }
}
