<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::insert([
           [
               'user_id' => 4,
               'coach_id' => 1,
           ],
            [
                'user_id' => 5,
                'coach_id' => 2,
            ]
        ]);
    }
}
