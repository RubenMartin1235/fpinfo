<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $interval = new \DateInterval('P1Y');
        $end_date = (new \DateTime())->add($interval);
        return [
            'init_date'=>now(),
            'end_date'=>$end_date->format('Y-m-d H:i:s'),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
