<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

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
            'title' => fake()->sentence(5),
            'slug' => fake()->slug(),
            'num_of_views' => fake()->numberBetween(0, 200),
            'description' => fake()->paragraph(10),
            'commentable' => fake()->randomElement([1, 0]),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'status' => fake()->randomElement([1, 0]),
        ];
    }
}
