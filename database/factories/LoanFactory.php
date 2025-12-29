<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
use App\Models\User;
use App\Models\Book;

class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'loan_date' => fake()->dateTimeThisMonth(),
            'due_date' => fake()->dateTimeThisMonth('+2 weeks'),
            'returned_date' => fake()->optional(0.7)->dateTimeThisMonth(),
        ];
    }
}
