<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $publishedAt = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(6),
            'content' => implode("\n\n", fake()->paragraphs(4)),
            'published' => true,
            'published_at' => $publishedAt,
        ];
    }

    /**
     * Неопубликованный черновик.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'published' => false,
            'published_at' => null,
        ]);
    }
}
