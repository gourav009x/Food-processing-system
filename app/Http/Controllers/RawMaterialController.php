<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    public function index() { return response()->json(RawMaterial::all()); }
    public function store(Request $request) {
        $rawMaterial = RawMaterial::create($request->all());
        return response()->json($rawMaterial, 201);
    }
    public function show(RawMaterial $rawMaterial) { return response()->json($rawMaterial); }
    public function update(Request $request, RawMaterial $rawMaterial) {
        $rawMaterial->update($request->all());
        return response()->json($rawMaterial);
    }
    public function destroy(RawMaterial $rawMaterial) { $rawMaterial->delete(); return response()->json(null, 204); }
}
