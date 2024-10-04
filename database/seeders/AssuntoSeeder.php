<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Assunto;

class AssuntoSeeder extends Seeder
{
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Assunto::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');			
		
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Assunto::create([
                'descricao' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
