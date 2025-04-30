<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class PersonalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personal_data')->insert([
            'gender'   =>  'male',
            'age'      =>  '27',
            'height'   =>  '190',
            'weight'   =>  '93',
            'arm_l'    =>  '40',
            'arm_r'    =>  '40',
            'chest'    =>  '108',
            'waist'    =>  '90',
            'scruff'   =>  '60',
            'thigh_l'  =>  '80',
            'thigh_r'  =>  '80',
            'calf_l'   =>  '60',
            'calf_r'   =>  '60',
        ]);
    }
}
