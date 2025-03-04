<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CornerPost>
 */
class CornerPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'body' => fake()->paragraphs(30,true),
            'created_at' => $created_at = fake()->dateTimeBetween('-20 days','-5 days'),
            'updated_at' => fake()->dateTimeBetween($created_at, '-5 days'),
            'published_at' => fake()->dateTimeBetween('-5 days', 'now'),
        ];
    }
}
