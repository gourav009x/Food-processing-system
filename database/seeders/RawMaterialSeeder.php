<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\RawMaterial::firstOrCreate(
            ['batch_no' => 'RAW-001'],
            [
                'name' => 'Organic Tomatoes',
                'category' => 'Vegetables',
                'supplier' => 'Local Organic Farm',
                'quantity' => 1245.00,
                'unit' => 'kg',
                'arrival_date' => now(),
                'freshness_score' => 98,
                'nutrition_value' => 100,
                'status' => 'Pending Quality Check'
            ]
        );
    }
}
