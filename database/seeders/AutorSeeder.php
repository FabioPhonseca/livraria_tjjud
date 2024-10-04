<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Autor;


class AutorSeeder extends Seeder
{
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Autor::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');	
		
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Autor::create([
                'nome' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
