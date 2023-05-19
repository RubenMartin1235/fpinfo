<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormativeUnit>
 */
class FormativeUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'shortname' => 'UF'.fake()->randomNumber(2),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
