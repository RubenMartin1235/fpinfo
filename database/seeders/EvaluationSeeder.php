<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormativeUnit;
use App\Models\Evaluation;
use App\Models\User;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ev = Evaluation::factory()->create([
            'init_date' => now(),
            'end_date' => now()->addYear(),
        ]);
    }
}
