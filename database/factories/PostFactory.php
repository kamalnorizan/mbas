<?php

namespace Database\Factories;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
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
        return [
            'title' => $this->faker->sentence,
            'uuid' => Uuid::uuid4(),
            'content' => $this->faker->paragraph,
            'status' => 1,
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 10),
            'view_count' => rand(1, 1000),
            'like_count' => rand(1, 1000),
            'created_at' => Carbon::parse('2024-01-01')->addDays(rand(1, 350)),
        ];
    }
}
