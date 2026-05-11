<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('warehouse_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packaging_id')->constrained('packagings')->onDelete('cascade');
            $table->string('section');
            $table->decimal('temperature', 5, 2);
            $table->decimal('humidity', 5, 2);
            $table->integer('quantity');
            $table->string('status')->default('In Stock'); // In Stock, Expiring, Out of Stock
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('warehouse_inventories'); }
};