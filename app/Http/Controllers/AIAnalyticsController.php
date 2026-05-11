<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AIAnalyticsController extends Controller
{
    public function predictShelfLife(Request $request) {
        // Simple logic to predict shelf life based on humidity, temperature, freshness
        $temp = $request->input('temperature', 20);
        $humidity = $request->input('humidity', 50);
        $freshness = $request->input('freshness_score', 100);
        $baseDays = 30;
        $predictedDays = $baseDays * ($freshness / 100) - (($temp - 4) * 0.5) - (($humidity - 40) * 0.2);
        return response()->json(['predicted_shelf_life_days' => max(1, round($predictedDays))]);
    }
    public function predictQualityScore(Request $request) {
        $ph = $request->input('ph_level', 7);
        $moisture = $request->input('moisture_level', 15);
        $score = 100 - abs(7 - $ph) * 10 - abs(12 - $moisture) * 2;
        return response()->json(['predicted_quality_score' => max(0, min(100, $score))]);
    }
}
