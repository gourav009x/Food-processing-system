<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingBatch extends Model
{
    /** @use HasFactory<\Database\Factories\ProcessingBatchFactory> */
    use HasFactory;
    protected $fillable = ['raw_material_id', 'stage', 'temperature', 'duration', 'humidity', 'nutrient_retention', 'energy_usage', 'operator', 'status'];


    public function rawMaterial() {
        return $this->belongsTo(RawMaterial::class);
    }
    public function qualityChecks() {
        return $this->hasMany(QualityCheck::class);
    }
    public function packagings() {
        return $this->hasMany(Packaging::class);
    }

}
