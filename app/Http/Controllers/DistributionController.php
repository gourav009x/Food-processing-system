<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    public function index() { return response()->json(Distribution::all()); }
    public function store(Request $request) {
        $distribution = Distribution::create($request->all());
        return response()->json($distribution, 201);
    }
    public function show(Distribution $distribution) { return response()->json($distribution); }
    public function update(Request $request, Distribution $distribution) {
        $distribution->update($request->all());
        return response()->json($distribution);
    }
    public function destroy(Distribution $distribution) { $distribution->delete(); return response()->json(null, 204); }
}
