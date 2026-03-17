<?php

namespace App\Services;

use App\Models\Profile;

class NutritionCalculator
{
    public function calculate(array $data)
    {
        $weight = $data['weight'];
        $height = $data['height'];
        $age = $data['age'];
        $gender = $data['gender'];

        if ($gender === 'male') {
            $tmb = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } else {
            $tmb = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        $water = $weight * 35;

        return [
            'tmb' => $tmb,
            'water' => $water
        ];
    }
}
