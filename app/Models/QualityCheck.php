<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityCheck extends Model
{
    /** @use HasFactory<\Database\Factories\QualityCheckFactory> */
    use HasFactory;
    protected $fillable = ['processing_batch_id', 'freshness_score', 'ph_level', 'contamination_risk', 'moisture_level', 'nutritional_retention', 'status', 'notes'];


    public function processingBatch() {
        return $this->belongsTo(ProcessingBatch::class);
    }

}
