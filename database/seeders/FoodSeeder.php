<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::insert([
            [
                'name' => 'Frango Grelhado',
                'calories' => 120,
                'protein' => 100,
                'carbs' => 20,
                'fat' => 30,
            ],
            [
                'name' => 'Arroz',
                'calories' => 120,
                'protein' => 100,
                'carbs' => 20,
                'fat' => 30,
            ],
            [
                'name' => 'Feijão',
                'calories' => 120,
                'protein' => 100,
                'carbs' => 20,
                'fat' => 30,
            ],
        ]);
    }
}
