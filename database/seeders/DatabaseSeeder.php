<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\Publisher;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create specific users for testing roles
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // Create random client users
        $clients = User::factory(10)->create(['role' => 'client']);

        // Create other necessary data
        $categories = Category::factory(10)->create();
        $publishers = Publisher::factory(5)->create();
        $authors = Author::factory(20)->create();

        // Create books and attach authors
        $books = Book::factory(50)->recycle($categories)->recycle($publishers)->create();

        foreach ($books as $book) {
            $book->authors()->attach(
                $authors->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        // Create interactions
        Loan::factory(30)->recycle($clients)->recycle($books)->create();
        Reservation::factory(20)->recycle($clients)->recycle($books)->create();
        Review::factory(100)->recycle($clients)->recycle($books)->create();
    }
}
