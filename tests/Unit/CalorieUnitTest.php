<?php

namespace Tests\Unit;

use App\Helpers\CalorieHelper;
use PHPUnit\Framework\TestCase;

class CalorieUnitTest extends TestCase
{
    public function test_calculate_male_calorie()
    {
        $weight = 70;
        $height = 175;
        $age = 25;
        $result = CalorieHelper::calculateCalories('male', $weight, $height, $age);

        $expected = 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age);
        $this->assertEquals(round($expected), round($result), "Kalori pria tidak sesuai");
    }

    public function test_calculate_female_calorie()
    {
        $weight = 60;
        $height = 160;
        $age = 30;
        $result = CalorieHelper::calculateCalories('female', $weight, $height, $age);

        $expected = 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
        $this->assertEquals(round($expected), round($result), "Kalori wanita tidak sesuai");
    }

    public function test_empty_gender_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        CalorieHelper::calculateCalories('', 60, 160, 30);
    }

    public function test_gender_case_insensitive()
    {
        $weight = 65;
        $height = 170;
        $age = 28;

        $resultMale = CalorieHelper::calculateCalories('MALE', $weight, $height, $age);
        $expectedMale = 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age);
        $this->assertEquals(round($expectedMale), round($resultMale));

        $resultFemale = CalorieHelper::calculateCalories('FeMaLe', $weight, $height, $age);
        $expectedFemale = 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
        $this->assertEquals(round($expectedFemale), round($resultFemale));
    }


    // Test untuk batas minimum yang valid secara logis (berat & tinggi = 10)
    public function test_logical_minimum_values()
    {
        $weight = 10;
        $height = 10;
        $age = 1;

        $result = CalorieHelper::calculateCalories('male', $weight, $height, $age);
        $expected = 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age);
        $this->assertEquals(round($expected), round($result));
    }

    public function test_large_values()
    {
        $weight = 200;
        $height = 220;
        $age = 80;

        $result = CalorieHelper::calculateCalories('female', $weight, $height, $age);
        $expected = 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
        $this->assertEquals(round($expected), round($result));
    }
}
