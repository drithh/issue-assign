<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => 1,
            'findings' => $this->faker->text(20),
            'criteria' => $this->faker->text(),
            'requirements' => $this->faker->text(),
            'root_cause_analysis' => $this->faker->text(),
            'corrective_actions' => $this->faker->text(),
            'target_time' => $this->faker->dateTime(),
            'is_accepted' => false,
        ];
    }
}
