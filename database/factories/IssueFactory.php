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
        $criterias = [
            'critical', 'mayor', 'minor'
        ];
        return [
            'department_id' => $this->faker->numberBetween(1, 3),
            'findings' => $this->faker->text(20),
            'criteria' => $criterias[array_rand($criterias)],
            'additonal_data' => $this->faker->text(),
            // 'root_cause_analysis' => $this->faker->text(),
            // 'corrective_actions' => $this->faker->text(),
            'target_time' => $this->faker->dateTime(),
            'status' => 'pending',
        ];
    }
}
