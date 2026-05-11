<?php

namespace App\Http\Controllers;

use App\Models\ProcessingBatch;
use Illuminate\Http\Request;

class ProcessingBatchController extends Controller
{
    public function index() { return response()->json(ProcessingBatch::all()); }
    public function store(Request $request) {
        $processingBatch = ProcessingBatch::create($request->all());
        return response()->json($processingBatch, 201);
    }
    public function show(ProcessingBatch $processingBatch) { return response()->json($processingBatch); }
    public function update(Request $request, ProcessingBatch $processingBatch) {
        $processingBatch->update($request->all());
        return response()->json($processingBatch);
    }
    public function destroy(ProcessingBatch $processingBatch) { $processingBatch->delete(); return response()->json(null, 204); }
}
