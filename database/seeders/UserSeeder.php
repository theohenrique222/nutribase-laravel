<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'      =>  'Theo Henrique',
                'email'     =>  'theodoro222@hotmail.com',
                'password'  =>  Hash::make('password'),
            ],
            [
                'name'      =>  'Coach 1',
                'email'     =>  'coach@email.com',
                'password'  =>  Hash::make('password'),
            ],
            [
                'name'      =>  'Coach 2',
                'email'     =>  'coach2@email.com',
                'password'  =>  Hash::make('password'),
            ],
            [
                'name'      =>  'Aluno 1',
                'email'     =>  'aluno@email.com',
                'password'  =>  Hash::make('password'),
            ],
            [
                'name'      =>  'Aluno 2',
                'email'     =>  'aluno2@email.com',
                'password'  =>  Hash::make('password'),
            ],
        ]);
    }
}
