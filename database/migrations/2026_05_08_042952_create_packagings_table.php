<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('packagings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('processing_batch_id')->constrained()->onDelete('cascade');
            $table->string('packaging_type');
            $table->date('packaging_date');
            $table->string('material_used');
            $table->string('seal_quality');
            $table->date('expiry_date');
            $table->string('barcode')->unique();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('packagings'); }
};