<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('quality_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('processing_batch_id')->constrained()->onDelete('cascade');
            $table->integer('freshness_score');
            $table->decimal('ph_level', 4, 2);
            $table->string('contamination_risk')->default('Low');
            $table->decimal('moisture_level', 5, 2);
            $table->decimal('nutritional_retention', 5, 2);
            $table->enum('status', ['Pass', 'Fail']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('quality_checks'); }
};