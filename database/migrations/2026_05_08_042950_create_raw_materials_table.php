<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('supplier');
            $table->decimal('quantity', 10, 2);
            $table->string('unit');
            $table->date('arrival_date');
            $table->integer('freshness_score')->default(100);
            $table->integer('nutrition_value')->default(100);
            $table->string('batch_no')->unique();
            $table->string('image')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('raw_materials'); }
};