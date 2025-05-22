<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CalorieFeatureTest extends TestCase
{
    public function test_form_page_loads_correctly()
    {
        $response = $this->get('/calorie');
        $response->assertStatus(200);
        $response->assertSee('Hitung Kalori Harian Anda');
    }

    public function test_valid_data_returns_calorie_result()
    {
        $response = $this->post('/calorie', [
            'gender' => 'male',
            'weight' => 70,
            'height' => 175,
            'age' => 25
        ]);

        $response->assertStatus(200);
        $response->assertSee('Kebutuhan Kalori Harian Anda');
    }

    public function test_invalid_data_shows_validation_errors()
    {
        $response = $this->post('/calorie', [
            'gender' => 'alien',
            'weight' => -10,
            'height' => 'abc',
            'age' => 0
        ]);

        $response->assertSessionHasErrors(['gender', 'weight', 'height', 'age']);
    }
}
