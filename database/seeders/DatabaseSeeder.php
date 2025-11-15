<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Theo Henrique',
            'email' => 'admin@teste.com',
            'password' => 'password'
        ]);
        Product::create([
            'name' => 'Arroz',
            'portion_unit' => 'g',
            'observation' => 'Com pouco sal'
        ]);
        Product::create([
            'name' => 'Feijão',
            'portion_unit' => 'g',
            'observation' => 'Sem Observações'
        ]);
        Product::create([
            'name' => 'Creatina',
            'portion_unit' => 'Un',
            'observation' => 'Tomar a noite'
        ]);
    }
}
