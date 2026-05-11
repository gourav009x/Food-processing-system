<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseInventory extends Model
{
    /** @use HasFactory<\Database\Factories\WarehouseInventoryFactory> */
    use HasFactory;
    protected $fillable = ['packaging_id', 'section', 'temperature', 'humidity', 'quantity', 'status'];


    public function packaging() {
        return $this->belongsTo(Packaging::class);
    }
    public function distributions() {
        return $this->hasMany(Distribution::class);
    }

}
