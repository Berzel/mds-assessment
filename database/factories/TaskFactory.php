<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words($this->faker->numberBetween(1, 5), true),
            'description' => $this->faker->paragraphs($this->faker->numberBetween(1, 5), true),
            'status' => $this->faker->randomElement(['pending', 'progress', 'completed'])
        ];
    }
}
