<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    /** @use HasFactory<\Database\Factories\PackagingFactory> */
    use HasFactory;
    protected $fillable = ['processing_batch_id', 'packaging_type', 'packaging_date', 'material_used', 'seal_quality', 'expiry_date', 'barcode'];


    public function processingBatch() {
        return $this->belongsTo(ProcessingBatch::class);
    }
    public function warehouseInventories() {
        return $this->hasMany(WarehouseInventory::class);
    }

}
