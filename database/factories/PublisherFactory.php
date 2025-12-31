<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publisher>
 */
class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $publishers = [
            'Znak', 'Wydawnictwo Literackie', 'Rebis', 'Agora',
            'Prószyński i S-ka', 'Wydawnictwo Kobiece', 'Nasza Księgarnia', 'Muza',
            'Albatros', 'Czarna Owca', 'Sonia Draga', 'W.A.B.',
            'Zysk i S-ka', 'Mag', 'Helion',
            'PWN', 'Bukowy Las', 'Filia', 'Marginesy', 'Otwarte'
        ];

        return [
            'name' => fake()->randomElement($publishers),
        ];
    }
}