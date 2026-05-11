<?php

$dir = __DIR__;

function addRelation($file, $relationCode) {
    if(file_exists($file)) {
        $content = file_get_contents($file);
        // insert before the last closing brace
        $content = preg_replace('/}(?=[^}]*$)/', "\n$relationCode\n}", $content);
        file_put_contents($file, $content);
    }
}

// RawMaterial
addRelation($dir . '/app/Models/RawMaterial.php', "
    public function processingBatches() {
        return \$this->hasMany(ProcessingBatch::class);
    }
");

// ProcessingBatch
addRelation($dir . '/app/Models/ProcessingBatch.php', "
    public function rawMaterial() {
        return \$this->belongsTo(RawMaterial::class);
    }
    public function qualityChecks() {
        return \$this->hasMany(QualityCheck::class);
    }
    public function packagings() {
        return \$this->hasMany(Packaging::class);
    }
");

// QualityCheck
addRelation($dir . '/app/Models/QualityCheck.php', "
    public function processingBatch() {
        return \$this->belongsTo(ProcessingBatch::class);
    }
");

// Packaging
addRelation($dir . '/app/Models/Packaging.php', "
    public function processingBatch() {
        return \$this->belongsTo(ProcessingBatch::class);
    }
    public function warehouseInventories() {
        return \$this->hasMany(WarehouseInventory::class);
    }
");

// WarehouseInventory
addRelation($dir . '/app/Models/WarehouseInventory.php', "
    public function packaging() {
        return \$this->belongsTo(Packaging::class);
    }
    public function distributions() {
        return \$this->hasMany(Distribution::class);
    }
");

// Distribution
addRelation($dir . '/app/Models/Distribution.php', "
    public function warehouseInventory() {
        return \$this->belongsTo(WarehouseInventory::class);
    }
");

echo "Relations updated successfully.\n";
