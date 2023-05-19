<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormativeUnit;
use App\Models\Evaluation;
use App\Models\User;
use Carbon\Carbon;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evdate_init = Carbon::now()->subYears(6);
        $evdate_end = Carbon::now()->subYears(5);
        for ($i=0; $i < 5; $i++) {
            $ev = Evaluation::factory()->create([
                'init_date' => $evdate_init,
                'end_date' => $evdate_end,
            ]);
            $evdate_init->addYear();
            $evdate_end->addYear();
        }
    }
}
