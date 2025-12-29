<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
use App\Models\Category;
use App\Models\Publisher;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'isbn' => fake()->unique()->isbn13(),
            'published_year' => fake()->year(),
            'category_id' => Category::factory(),
            'publisher_id' => Publisher::factory(),
        ];
    }
}
