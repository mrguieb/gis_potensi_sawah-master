<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CropRecommendationController extends Controller
{
    public function suggestCrop(Request $request)
    {
        $validated = $request->validate([
            'nitrogen' => 'required|numeric',
            'phosphorus' => 'required|numeric',
            'potassium' => 'required|numeric',
            'ph' => 'required|numeric',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'rainfall' => 'required|numeric',
        ]);

        $n = $validated['nitrogen'];
        $p = $validated['phosphorus'];
        $k = $validated['potassium'];
        $ph = $validated['ph'];
        $temp = $validated['temperature'];
        $humidity = $validated['humidity'];
        $rainfall = $validated['rainfall'];

        // 🔥 Simple rules for recommendation
        if ($ph >= 6 && $ph <= 7 && $rainfall > 150 && $humidity > 70) {
            $crop = "Rice";
        } elseif ($n > 100 && $k > 50 && $temp >= 20 && $temp <= 30) {
            $crop = "Wheat";
        } elseif ($ph >= 5.5 && $ph <= 7.5 && $rainfall < 100) {
            $crop = "Maize";
        } elseif ($ph > 7.5 && $temp >= 18 && $temp <= 28) {
            $crop = "Sugarcane";
        } else {
            $crop = "Tomato";
        }

        return response()->json([
            'recommended_crop' => $crop
        ]);
    }
}
