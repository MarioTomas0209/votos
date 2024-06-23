<?php

namespace Database\Seeders;

use App\Models\Comparison;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComparisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comparison::factory()->count(5)->create();

    }
}
