<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Livro;
use Faker\Factory as Faker;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Livro::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Livro::create([
                'titulo' => substr($faker->sentence(3), 0, 40), // Gera um título com 3 palavras
                'editora' => $faker->company, // Gera uma editora aleatória
                'edicao' => $faker->numberBetween(1, 5), // Gera um número de edição entre 1 e 5
                'ano_publicacao' => $faker->year, // Gera um ano aleatório
                'valor' => $faker->randomFloat(2, 10, 100), // Gera um valor entre 10.00 e 100.00
                'isbn' => $faker->unique()->isbn13, // Gera um ISBN único
                'created_at' => now(), // Data de criação
                'updated_at' => now(), // Data de atualização
            ]);
        }
    }
}

