<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    /** @use HasFactory<\Database\Factories\DistributionFactory> */
    use HasFactory;
    protected $fillable = ['warehouse_inventory_id', 'destination', 'vehicle_details', 'delivery_eta', 'status'];


    public function warehouseInventory() {
        return $this->belongsTo(WarehouseInventory::class);
    }

}
