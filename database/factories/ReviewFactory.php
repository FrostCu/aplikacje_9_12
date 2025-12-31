<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $comments = [
            "Absolutne arcydzieło! Nie mogłem się oderwać.",
            "Trochę wolna w środku, ale zakończenie było tego warte.",
            "Nie w moim guście. Postacie wydawały się płaskie.",
            "Niesamowita budowa świata i rozwój postaci.",
            "Solidna lektura, polecam fanom gatunku.",
            "Rozczarowująca. Spodziewałem się więcej po recenzjach.",
            "Pięknie napisana i głęboko poruszająca.",
            "Szybka akcja i ekscytująca, prawdziwy pożeracz stron.",
            "Myląca fabuła, miałem trudności z jej ukończeniem.",
            "Jedna z najlepszych książek, jakie przeczytałem w tym roku!"
        ];

        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->randomElement($comments),
        ];
    }
}