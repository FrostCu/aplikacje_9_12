@extends('layouts.app')

@section('content')
    <div class="space-y-12">
        <section class="text-center space-y-4 py-8">
            <h1 class="text-4xl font-bold tracking-tight text-[#1b1b18] dark:text-[#EDEDEC]">
                Witamy w Bibliotece
            </h1>
            <p class="text-lg text-[#706f6c] dark:text-[#A1A09A] max-w-2xl mx-auto">
                Odkryj swoją następną ulubioną książkę w naszej obszernej kolekcji. Wypożyczaj, rezerwuj i oceniaj książki z łatwością.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-6">
                <a href="{{ route('books.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#1b1b18] hover:bg-black md:text-lg transition-colors">
                    Przeglądaj Książki
                </a>
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] text-base font-medium rounded-md text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] hover:bg-gray-50 dark:hover:bg-[#1C1C1A] md:text-lg transition-colors">
                        Dołącz Teraz
                    </a>
                @endguest
            </div>
        </section>

        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Najnowsze Dodatki</h2>
                <a href="{{ route('books.index') }}" class="text-sm font-medium text-[#f53003] hover:underline">Zobacz wszystkie &rarr;</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($books as $book)
                    <div class="group relative flex flex-col bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                        <div class="aspect-2/3 bg-gray-100 dark:bg-[#1C1C1A] relative overflow-hidden">
                             <div class="absolute inset-0 flex items-center justify-center text-gray-400 dark:text-gray-600">
                                <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                             </div>
                        </div>
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] line-clamp-1">
                                <a href="{{ route('books.show', $book) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $book->title }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                {{ $book->authors->pluck('name')->join(', ') }}
                            </p>
                            <div class="mt-4 flex items-center justify-between text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                <span>{{ $book->published_year }}</span>
                                @if($book->category)
                                    <span class="px-2 py-1 bg-gray-100 dark:bg-[#1C1C1A] rounded-full text-xs">
                                        {{ $book->category->name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-[#706f6c] dark:text-[#A1A09A]">
                        <p>Brak dostępnych książek w tej chwili.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection
