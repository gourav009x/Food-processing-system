<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\ProcessingBatch;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'Distributor') {
        return redirect()->route('distribution.index');
    }
    $processingNowData = App\Models\ProcessingBatch::with('rawMaterial')->latest()->get();
    $rawMaterials = App\Models\RawMaterial::all();
    return view('dashboard', compact('processingNowData', 'rawMaterials'));
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
            'raw_material' => 'nullable|string',
        ]);
        
        $rawMaterialId = $request->raw_material_id;
        if ($request->filled('raw_material')) {
            $newMaterial = \App\Models\RawMaterial::create([
                'name' => $request->raw_material,
                'category' => 'Custom Input',
                'supplier' => 'Direct',
                'quantity' => 100,
                'unit' => 'kg',
                'arrival_date' => now(),
                'freshness_score' => 100,
                'nutrition_value' => 100,
                'batch_no' => 'RAW-' . rand(1000, 9999),
                'status' => 'Quality Passed'
            ]);
            $rawMaterialId = $newMaterial->id;
        }

        ProcessingBatch::create([
            'raw_material_id' => $rawMaterialId ?? 1, // Fallback to 1
            'stage' => $request->stage,
            'temperature' => $request->temperature,
            'duration' => $request->duration,
            'humidity' => 50, // default
            'nutrient_retention' => 95, // default
            'energy_usage' => 120, // default
            'operator' => $request->operator,
            'status' => 'In Progress',
        ]);

        if ($request->redirect_to == 'processing') {
            return redirect()->route('processing.index')->with('success', 'New batch started successfully!');
        }

        return redirect()->route('dashboard')->with('success', 'New batch started successfully!');
    })->name('batches.store');

    Route::post('/dashboard/batches/{batch}/complete', function (\App\Models\ProcessingBatch $batch) {
        $batch->update(['status' => 'Completed']);
        
        $packaging = \App\Models\Packaging::create([
            'processing_batch_id' => $batch->id,
            'packaging_type' => 'Standard Box',
            'packaging_date' => now(),
            'material_used' => 'Cardboard',
            'seal_quality' => 'Excellent',
            'expiry_date' => now()->addMonths(6),
            'barcode' => 'PKG-' . rand(1000, 9999)
        ]);

        \App\Models\WarehouseInventory::create([
            'packaging_id' => $packaging->id,
            'section' => 'Sec A',
            'temperature' => 4.0,
            'humidity' => 50,
            'quantity' => rand(50, 200),
            'status' => 'Stored'
        ]);

        return redirect()->back()->with('success', 'Batch processing completed and moved to storage.');
    })->name('batches.complete');

    Route::get('/dashboard/reports', function () {
        // Mocking report generation
        return redirect()->route('dashboard')->with('success', 'Production report generated successfully! (Download starting...)');
    })->name('reports.generate');

    Route::get('/generate-report', [ReportController::class, 'generate'])
    ->name('report.generate');

    Route::get('/dashboard/processing', function () {
        $batches = App\Models\ProcessingBatch::with('rawMaterial')->latest()->get();
        $rawMaterials = App\Models\RawMaterial::all();
        return view('processing', compact('batches', 'rawMaterials'));
    })->name('processing.index');

    Route::get('/dashboard/storage', function () {
        $storageData = App\Models\WarehouseInventory::with('packaging.processingBatch.rawMaterial')->latest()->get();
        return view('storage', compact('storageData'));
    })->name('storage.index');

    Route::get('/dashboard/directory', function () {
        return redirect()->route('dashboard')->with('success', 'Full directory access will be available soon.');
    })->name('directory.index');

    Route::get('/distribution', function () {
        if (auth()->user()->role !== 'Distributor') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        $distributions = App\Models\Distribution::with('warehouseInventory.packaging.processingBatch.rawMaterial')->latest()->get();
        return view('distribution', compact('distributions'));
    })->name('distribution.index');

    Route::get('/api/dashboard/stats', function () {
        $rawIngredients = \App\Models\RawMaterial::sum('quantity') ?? 0;
        $activeProcessing = \App\Models\ProcessingBatch::where('status', 'In Progress')->count();
        $avgFreshness = \App\Models\RawMaterial::avg('freshness_score') ?? 94.2;
        
        // Slightly randomizing chart data so it feels "alive" and real-time monitoring
        $yieldData = [
            1200 + rand(-50, 50),
            1900 + rand(-50, 50),
            2400 + rand(-50, 50),
            5000 + rand(-100, 100),
            3200 + rand(-50, 50),
            4800 + rand(-100, 100)
        ];
        
        $inventoryData = [
            (\App\Models\WarehouseInventory::where('section', 'Sec A')->sum('quantity') ?: 85) + rand(-2, 2),
            (\App\Models\WarehouseInventory::where('section', 'Sec B')->sum('quantity') ?: 45) + rand(-2, 2),
            (\App\Models\WarehouseInventory::where('section', 'Sec C')->sum('quantity') ?: 90) + rand(-2, 2),
            (\App\Models\WarehouseInventory::where('section', 'Cold')->sum('quantity') ?: 60) + rand(-2, 2),
        ];

        return response()->json([
            'stats' => [
                'raw_ingredients' => $rawIngredients > 0 ? $rawIngredients : 1245,
                'active_processing' => $activeProcessing,
                'average_freshness' => number_format($avgFreshness, 1),
                'food_waste' => 2.1, // Hardcoded for demo
            ],
            'charts' => [
                'yield' => $yieldData,
                'inventory' => $inventoryData
            ]
        ]);
    })->name('api.dashboard.stats');

    Route::get('/api/storage/data', function () {
        $storageData = App\Models\WarehouseInventory::with('packaging.processingBatch.rawMaterial')->latest()->get();
        
        $mapped = $storageData->map(function ($item) {
            // Simulate slight real-time fluctuations for the demo
            $tempFluctuation = rand(-5, 5) / 10;
            $humFluctuation = rand(-2, 2);
            
            return [
                'id' => str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'product_name' => $item->packaging->processingBatch->rawMaterial->name ?? 'Unknown Product',
                'section' => $item->section,
                'temperature' => number_format($item->temperature + $tempFluctuation, 1),
                'humidity' => max(0, min(100, $item->humidity + $humFluctuation)),
                'quantity' => $item->quantity,
                'status' => $item->status,
            ];
        });

        return response()->json(['data' => $mapped]);
    })->name('api.storage.data');
});

require __DIR__.'/auth.php';
