<?php

$dir = __DIR__;

// 1. Users Table Migration
$usersMigration = glob($dir . '/database/migrations/*_create_users_table.php')[0];
$usersContent = file_get_contents($usersMigration);
$usersContent = str_replace(
    "\$table->string('password');",
    "\$table->string('password');\n            \$table->string('role')->default('Processing Staff');",
    $usersContent
);
file_put_contents($usersMigration, $usersContent);

// 2. Raw Materials Table Migration
$rmMigration = glob($dir . '/database/migrations/*_create_raw_materials_table.php')[0];
file_put_contents($rmMigration, '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'raw_materials\', function (Blueprint $table) {
            $table->id();
            $table->string(\'name\');
            $table->string(\'category\');
            $table->string(\'supplier\');
            $table->decimal(\'quantity\', 10, 2);
            $table->string(\'unit\');
            $table->date(\'arrival_date\');
            $table->integer(\'freshness_score\')->default(100);
            $table->integer(\'nutrition_value\')->default(100);
            $table->string(\'batch_no\')->unique();
            $table->string(\'image\')->nullable();
            $table->string(\'status\')->default(\'Pending\');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'raw_materials\'); }
};');

// 3. Processing Batches Migration
$pbMigration = glob($dir . '/database/migrations/*_create_processing_batches_table.php')[0];
file_put_contents($pbMigration, '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'processing_batches\', function (Blueprint $table) {
            $table->id();
            $table->foreignId(\'raw_material_id\')->constrained()->onDelete(\'cascade\');
            $table->string(\'stage\')->default(\'Cleaning\'); // Cleaning, Sorting, Cutting, Heating, Drying, Packaging
            $table->decimal(\'temperature\', 5, 2)->nullable();
            $table->integer(\'duration\')->nullable(); // in minutes
            $table->decimal(\'humidity\', 5, 2)->nullable();
            $table->decimal(\'nutrient_retention\', 5, 2)->default(100);
            $table->decimal(\'energy_usage\', 8, 2)->nullable();
            $table->string(\'operator\')->nullable();
            $table->string(\'status\')->default(\'In Progress\');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'processing_batches\'); }
};');

// 4. Quality Checks Migration
$qcMigration = glob($dir . '/database/migrations/*_create_quality_checks_table.php')[0];
file_put_contents($qcMigration, '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'quality_checks\', function (Blueprint $table) {
            $table->id();
            $table->foreignId(\'processing_batch_id\')->constrained()->onDelete(\'cascade\');
            $table->integer(\'freshness_score\');
            $table->decimal(\'ph_level\', 4, 2);
            $table->string(\'contamination_risk\')->default(\'Low\');
            $table->decimal(\'moisture_level\', 5, 2);
            $table->decimal(\'nutritional_retention\', 5, 2);
            $table->enum(\'status\', [\'Pass\', \'Fail\']);
            $table->text(\'notes\')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'quality_checks\'); }
};');

// 5. Packagings Migration
$pkgMigration = glob($dir . '/database/migrations/*_create_packagings_table.php')[0];
file_put_contents($pkgMigration, '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'packagings\', function (Blueprint $table) {
            $table->id();
            $table->foreignId(\'processing_batch_id\')->constrained()->onDelete(\'cascade\');
            $table->string(\'packaging_type\');
            $table->date(\'packaging_date\');
            $table->string(\'material_used\');
            $table->string(\'seal_quality\');
            $table->date(\'expiry_date\');
            $table->string(\'barcode\')->unique();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'packagings\'); }
};');

// 6. Warehouse Inventories Migration
$wiMigration = glob($dir . '/database/migrations/*_create_warehouse_inventories_table.php')[0];
file_put_contents($wiMigration, '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'warehouse_inventories\', function (Blueprint $table) {
            $table->id();
            $table->foreignId(\'packaging_id\')->constrained(\'packagings\')->onDelete(\'cascade\');
            $table->string(\'section\');
            $table->decimal(\'temperature\', 5, 2);
            $table->decimal(\'humidity\', 5, 2);
            $table->integer(\'quantity\');
            $table->string(\'status\')->default(\'In Stock\'); // In Stock, Expiring, Out of Stock
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'warehouse_inventories\'); }
};');

// 7. Distributions Migration
$distMigration = glob($dir . '/database/migrations/*_create_distributions_table.php')[0];
file_put_contents($distMigration, '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'distributions\', function (Blueprint $table) {
            $table->id();
            $table->foreignId(\'warehouse_inventory_id\')->constrained()->onDelete(\'cascade\');
            $table->string(\'destination\');
            $table->string(\'vehicle_details\');
            $table->dateTime(\'delivery_eta\');
            $table->string(\'status\')->default(\'Pending\'); // Pending, In Transit, Delivered, Delayed
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'distributions\'); }
};');

// Update Models with Fillables
$models = [
    'User' => "    protected \$fillable = [\n        'name',\n        'email',\n        'password',\n        'role',\n    ];",
    'RawMaterial' => "    protected \$fillable = ['name', 'category', 'supplier', 'quantity', 'unit', 'arrival_date', 'freshness_score', 'nutrition_value', 'batch_no', 'image', 'status'];",
    'ProcessingBatch' => "    protected \$fillable = ['raw_material_id', 'stage', 'temperature', 'duration', 'humidity', 'nutrient_retention', 'energy_usage', 'operator', 'status'];",
    'QualityCheck' => "    protected \$fillable = ['processing_batch_id', 'freshness_score', 'ph_level', 'contamination_risk', 'moisture_level', 'nutritional_retention', 'status', 'notes'];",
    'Packaging' => "    protected \$fillable = ['processing_batch_id', 'packaging_type', 'packaging_date', 'material_used', 'seal_quality', 'expiry_date', 'barcode'];",
    'WarehouseInventory' => "    protected \$fillable = ['packaging_id', 'section', 'temperature', 'humidity', 'quantity', 'status'];",
    'Distribution' => "    protected \$fillable = ['warehouse_inventory_id', 'destination', 'vehicle_details', 'delivery_eta', 'status'];"
];

foreach ($models as $model => $fillable) {
    $modelFile = $dir . '/app/Models/' . $model . '.php';
    if(file_exists($modelFile)) {
        $content = file_get_contents($modelFile);
        if($model == 'User') {
            $content = preg_replace("/protected \\\$fillable = \[.*?\];/s", $fillable, $content);
        } else {
            $content = str_replace("use HasFactory;", "use HasFactory;\n$fillable", $content);
        }
        file_put_contents($modelFile, $content);
    }
}

echo "Database schemas and models updated successfully.\n";
