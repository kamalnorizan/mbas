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
        $article = '';
        for ($i = 0; $i < 2; $i++) {
            $article .= "<p>";
            for ($j = 0; $j < 2; $j++) {
                $article .= $this->faker->paragraph;
            }
            $article .= "</p>";
        }
        //random date between 2024-11-01 and 2025-02-04

        $random_date = Carbon::parse('2024-11-01')->addDays(rand(0, Carbon::parse('2025-02-03')->diffInDays('2024-11-01')));

        return [
            'title' => $this->faker->sentence,
            'uuid' => Uuid::uuid4(),
            'content' => $article,
            'status' => rand(0, 2),
            'user_id' => rand(4, 6),
            'category_id' => rand(1, 10),
            'view_count' => rand(1, 1000),
            'like_count' => rand(1, 1000),
            'created_at' => $random_date,
            'updated_at' => $random_date,
        ];
    }
}
