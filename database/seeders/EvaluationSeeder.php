<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormativeUnit;
use App\Models\Evaluation;
use App\Models\EvaluationDetail;
use App\Models\User;
use Carbon\Carbon;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student_user = User::where('name', 'Aitor Tilla')->first();
        $m3uf1 = FormativeUnit::where('name', 'Programació modular')->first();

        $evdate_init = Carbon::now()->subYears(6);
        $evdate_end = Carbon::now()->subYears(5);
        for ($i=0; $i < 5; $i++) {
            $ev = Evaluation::factory()->make([
                'init_date' => $evdate_init,
                'end_date' => $evdate_end,
            ]);
            $ev->save();

            $ev_detail = EvaluationDetail::factory()->make([
                'score' => 9.7 + ((rand() % 3) / 10),
            ]);
            $ev_detail->user()->associate($student_user);
            $ev_detail->evaluation()->associate($ev);
            $ev_detail->formativeUnit()->associate($m3uf1);
            $ev_detail->save();

            $evdate_init->addYear();
            $evdate_end->addYear();
        }
    }
}
