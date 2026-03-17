<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Student;

class NutritionCalculator
{
    public function calculate($data)
    {
        $student = Student::findOrFail($data['student_id']);
        $profile = Profile::where('student_id', $student->id)->firstOrFail();

        $weight = $data['weight'];    // kg
        $height = $data['height'];    // cm
        $age = $profile->age;
        $gender = $profile->gender;

        $neck = $data['neck'] ?? 0;  // pescoço
        $waist = $data['waist'] ?? 0; // cintura
        $hip = $data['hip'] ?? 0;   // quadril, só para mulheres

        // 1️⃣ TMB (Harris-Benedict)
        if ($gender === 'male') {
            $tmb = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } else {
            $tmb = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        // 2️⃣ Água diária
        $water = $weight * 35; // ml

        // 3️⃣ Macronutrientes aproximados
        $proteins = round($weight * 1.8, 1);   // g/dia (1.8g por kg)
        $carbs = round($weight * 4, 1);     // g/dia (aprox 4g por kg)
        $fat = round($weight * 1, 1);     // g/dia (aprox 1g por kg)

        // 4️⃣ Gordura corporal aproximada (Navy Method)
        if ($gender === 'male') {
            // Homens: log10(waist - neck)
            $fat_percent = 495 / (1.0324 - 0.19077 * log10($waist - $neck) + 0.15456 * log10($height)) - 450;
        } else {
            // Mulheres: log10(waist + hip - neck)
            $fat_percent = 495 / (1.29579 - 0.35004 * log10($waist + $hip - $neck) + 0.22100 * log10($height)) - 450;
        }

        return [
            'tmb' => round($tmb, 1),
            'water' => round($water, 1),
            'proteins' => $proteins,
            'carbs' => $carbs,
            'fat' => $fat,
            'fat_percent' => round($fat_percent, 1)
        ];
    }
}
