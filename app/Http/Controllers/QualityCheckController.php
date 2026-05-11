<?php

namespace App\Http\Controllers;

use App\Models\QualityCheck;
use Illuminate\Http\Request;

class QualityCheckController extends Controller
{
    public function index() { return response()->json(QualityCheck::all()); }
    public function store(Request $request) {
        $qualityCheck = QualityCheck::create($request->all());
        return response()->json($qualityCheck, 201);
    }
    public function show(QualityCheck $qualityCheck) { return response()->json($qualityCheck); }
    public function update(Request $request, QualityCheck $qualityCheck) {
        $qualityCheck->update($request->all());
        return response()->json($qualityCheck);
    }
    public function destroy(QualityCheck $qualityCheck) { $qualityCheck->delete(); return response()->json(null, 204); }
}
