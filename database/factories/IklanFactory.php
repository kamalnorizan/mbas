<?php

namespace Database\Factories;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Iklan>
 */
class IklanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d');
        $endDate = $this->faker->dateTimeBetween($startDate, strtotime('+1 week'))->format('Y-m-d');
        return [
            'uuid'=> Uuid::uuid4(),
            'title'=> $this->faker->sentence,
            'description'=> $this->faker->paragraph,
            'image'=> $this->faker->imageUrl,
            'start_date'=> $startDate,
            'end_date'=> $endDate,
            'is_active'=> $this->faker->boolean,
            'created_by'=> rand(1, 10),
        ];
    }
}
