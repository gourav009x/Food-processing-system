<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\ProcessingBatch;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Actions
    Route::post('/dashboard/batches', function (Request $request) {
        $request->validate([
            'stage' => 'required|string',
            'temperature' => 'required|numeric',
            'duration' => 'required|numeric',
            'operator' => 'required|string',
        ]);
        
        ProcessingBatch::create([
            'raw_material_id' => $request->raw_material_id ?? 1, // Fallback to 1
            'stage' => $request->stage,
            'temperature' => $request->temperature,
            'duration' => $request->duration,
            'humidity' => 50, // default
            'nutrient_retention' => 95, // default
            'energy_usage' => 120, // default
            'operator' => $request->operator,
            'status' => 'In Progress',
        ]);

        return redirect()->route('dashboard')->with('success', 'New batch started successfully!');
    })->name('batches.store');

    Route::get('/dashboard/reports', function () {
        // Mocking report generation
        return redirect()->route('dashboard')->with('success', 'Production report generated successfully! (Download starting...)');
    })->name('reports.generate');
});

require __DIR__.'/auth.php';
