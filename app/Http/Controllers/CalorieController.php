<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CalorieHelper;
use Illuminate\Support\Facades\Validator;

class CalorieController extends Controller
{
    public function showForm()
    {
        // Kirim view dengan input kosong agar form tetap bisa pakai old()
        return view('calculator_calorie', [
            'input' => [],
        ]);
    }

    public function calculate(Request $request)
    {
        // Validasi manual agar bisa redirect balik dengan error dan input
        $validator = Validator::make($request->all(), [
            'gender' => 'required|in:male,female',
            'weight' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'age' => 'required|integer|min:1',
        ]);

        // Jika validasi gagal, redirect kembali ke /calorie dengan input dan error
        if ($validator->fails()) {
            return redirect()->route('form')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Ambil data tervalidasi
        $validated = $validator->validated();

        // Hitung kalori
        try {
            $calories = CalorieHelper::calculateCalories(
                $validated['gender'],
                $validated['weight'],
                $validated['height'],
                $validated['age']
            );
        } catch (\Exception $e) {
            // Jika terjadi error logika di helper, tampilkan sebagai error flash
            return redirect()->route('form')
                             ->withErrors(['error' => $e->getMessage()])
                             ->withInput();
        }

        // Kirim data ke view
        return view('calculator_calorie', [
            'input' => $validated,
            'calories' => round($calories),
        ]);
    }
}
