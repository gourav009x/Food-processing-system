<?php

namespace App\Http\Controllers;

use App\Models\WarehouseInventory;
use Illuminate\Http\Request;

class WarehouseInventoryController extends Controller
{
    public function index() { return response()->json(WarehouseInventory::all()); }
    public function store(Request $request) {
        $warehouseInventory = WarehouseInventory::create($request->all());
        return response()->json($warehouseInventory, 201);
    }
    public function show(WarehouseInventory $warehouseInventory) { return response()->json($warehouseInventory); }
    public function update(Request $request, WarehouseInventory $warehouseInventory) {
        $warehouseInventory->update($request->all());
        return response()->json($warehouseInventory);
    }
    public function destroy(WarehouseInventory $warehouseInventory) { $warehouseInventory->delete(); return response()->json(null, 204); }
}
