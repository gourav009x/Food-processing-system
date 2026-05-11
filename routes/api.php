<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\RawMaterial;
use App\Models\ProcessingBatch;
use App\Models\QualityCheck;
use App\Models\WarehouseInventory;
use App\Models\Distribution;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('raw-materials', \App\Http\Controllers\RawMaterialController::class);
    Route::apiResource('processing-batches', \App\Http\Controllers\ProcessingBatchController::class);
    Route::apiResource('quality-checks', \App\Http\Controllers\QualityCheckController::class);
    Route::apiResource('warehouse-inventories', \App\Http\Controllers\WarehouseInventoryController::class);
    Route::apiResource('distributions', \App\Http\Controllers\DistributionController::class);
    
    Route::post('/predict/shelf-life', [\App\Http\Controllers\AIAnalyticsController::class, 'predictShelfLife']);
    Route::post('/predict/quality-score', [\App\Http\Controllers\AIAnalyticsController::class, 'predictQualityScore']);
});
