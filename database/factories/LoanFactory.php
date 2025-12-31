<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loanDate = fake()->dateTimeBetween('-3 months', 'now');
        $dueDate = (clone $loanDate)->modify('+2 weeks');
        
        $returnedDate = null;
        if (fake()->boolean(70)) {
            $returnedDate = fake()->dateTimeBetween($loanDate, 'now');
        }

        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'returned_date' => $returnedDate,
        ];
    }
}