<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Publisher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Lalka', 'Pan Tadeusz', 'Wiedźmin', 'Solaris',
            'Ferdydurke', 'Mistrz i Małgorzata', 'Zbrodnia i kara', 'Mały Książę',
            'Rok 1984', 'Folwark zwierzęcy', 'Hrabia Monte Christo', 'Władca Pierścieni',
            'Harry Potter i Kamień Filozoficzny', 'Kod Leonarda da Vinci', 'Alchemik', 'Igrzyska śmierci',
            'Zmierzch', 'Dziewczyna z tatuażem', 'Służące', 'Gra o tron',
            'Opowieść podręcznej', 'Nowy wspaniały świat', 'Opowieści z Narnii', 'Małe kobietki',
            'Wyznania gejszy', 'Woda dla słoni', 'Zaklęta w czasie', 'Dawca',
            'Niezgodna', 'Więzień labiryntu', 'Papierowe miasta', 'Szukając Alaski',
            'Charlie', 'Nostalgia anioła', 'Sekretne życie pszczół',
            'Pamiętnik', 'Szkoła uczuć', 'I wciąż ją kocham', 'Bezpieczna przystań',
            'Szczęściarz', 'Ostatnia piosenka', 'Dla ciebie wszystko', 'Najdłuższa podróż',
            'Spójrz na mnie', 'We dwoje', 'Z każdym oddechem', 'Powrót', 'Życzenie',
            'Kraina snów', 'Iskra', 'Anioł stróż', 'Ślub', 'Na ratunek',
            'Na zakręcie', 'Noce w Rodanthe', 'Wybór'
        ];

        $descriptions = [
            "Poruszająca historia miłości, straty i odkupienia na tle burzliwych wydarzeń historycznych.",
            "Epicka podróż przez fantastyczny świat pełen magii, niebezpieczeństw i niezapomnianych postaci.",
            "Wciągająca zagadka kryminalna, która trzyma w napięciu do ostatniej strony.",
            "Dająca do myślenia wizja ludzkiej kondycji w dystopijnej przyszłości.",
            "Podnosząca na duchu opowieść o przyjaźni i odkrywaniu samego siebie, która rezonuje z czytelnikami w każdym wieku.",
            "Porywająca przygoda, która zabiera czytelnika z głębin oceanu w najdalsze zakątki kosmosu.",
            "Wzruszający pamiętnik, który oferuje wgląd w życie mniej zwyczajne.",
            "Potężna powieść o sile ludzkiego ducha w obliczu przeciwności losu.",
            "Prześmieszna komedia, która z wdziękiem i humorem punktuje wady współczesnego społeczeństwa.",
            "Mrożący krew w żyłach horror, który będzie cię prześladował długo po zakończeniu lektury."
        ];

        return [
            'title' => fake()->randomElement($titles),
            'description' => fake()->randomElement($descriptions) . " " . fake()->paragraph(),
            'isbn' => fake()->unique()->isbn13(),
            'total_copies' => fake()->numberBetween(1, 10),
            'published_year' => fake()->numberBetween(1900, 2024),
            'category_id' => Category::factory(),
            'publisher_id' => Publisher::factory(),
        ];
    }
}