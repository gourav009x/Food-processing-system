<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    /** @use HasFactory<\Database\Factories\RawMaterialFactory> */
    use HasFactory;
    protected $fillable = ['name', 'category', 'supplier', 'quantity', 'unit', 'arrival_date', 'freshness_score', 'nutrition_value', 'batch_no', 'image', 'status'];


    public function processingBatches() {
        return $this->hasMany(ProcessingBatch::class);
    }

}
