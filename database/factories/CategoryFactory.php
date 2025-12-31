<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Fikcja', 'Science Fiction', 'Kryminał', 'Thriller', 'Romans',
            'Fantasy', 'Biografia', 'Historia', 'Poradnik', 'Biznes',
            'Podróże', 'Kulinaria', 'Nauka', 'Technologia', 'Sztuka',
            'Filozofia', 'Psychologia', 'Zdrowie', 'Dla dzieci', 'Komiks'
        ];

        return [
            'name' => fake()->unique()->randomElement($categories),
        ];
    }
}