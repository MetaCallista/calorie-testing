<?php

namespace App\Helpers;

class CalorieHelper
{
    public static function calculateCalories($gender, $weight, $height, $age)
    {
        // Validasi gender
        if (!is_string($gender) || empty($gender)) {
            throw new \InvalidArgumentException("Gender harus diisi dengan 'male' atau 'female'.");
        }

        $gender = strtolower($gender);
        if ($gender !== 'male' && $gender !== 'female') {
            throw new \InvalidArgumentException("Gender harus 'male' atau 'female'.");
        }

        // Validasi berat dan tinggi
        if ($weight < 10 || $height < 10) {
            throw new \InvalidArgumentException('Berat atau tinggi tidak logis.');
        }

        // Perhitungan kalori
        if ($gender === 'male') {
            return 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age);
        } else { // female
            return 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
        }
    }
}
