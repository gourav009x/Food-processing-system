<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('processing_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raw_material_id')->constrained()->onDelete('cascade');
            $table->string('stage')->default('Cleaning'); // Cleaning, Sorting, Cutting, Heating, Drying, Packaging
            $table->decimal('temperature', 5, 2)->nullable();
            $table->integer('duration')->nullable(); // in minutes
            $table->decimal('humidity', 5, 2)->nullable();
            $table->decimal('nutrient_retention', 5, 2)->default(100);
            $table->decimal('energy_usage', 8, 2)->nullable();
            $table->string('operator')->nullable();
            $table->string('status')->default('In Progress');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('processing_batches'); }
};