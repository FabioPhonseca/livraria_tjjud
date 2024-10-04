<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\LivroAssunto;

class LivroAssuntoSeeder extends Seeder
{
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        LivroAssunto::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');			
		
        foreach (range(1, 10) as $index) {
            LivroAssunto::create([
                'livro_codl' => rand(1, 10),
                'assunto_codas' => rand(1, 10),
            ]);
        }
    }
}
