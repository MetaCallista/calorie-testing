<?php

namespace App\Helpers;

class CalorieHelper
{
    public static function calculateCalories($gender, $weight, $height, $age)
    {
        // Validasi gender
        $gender = strtolower($gender);
        if ($gender !== 'male' && $gender !== 'female') {
            throw new \InvalidArgumentException("Gender harus 'male' atau 'female'.");
        }
        

        // Perhitungan kalori
        if ($gender === 'male') {
            return 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age);
        } else { // female
            return 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
        }
    }
}
