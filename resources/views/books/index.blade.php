@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    <aside class="w-full md:w-64 shrink-0">
        <div class="sticky top-24 space-y-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Szukaj</h3>
                <form action="{{ route('books.index') }}" method="GET" class="relative">
                    <label for="search" class="sr-only">Szukaj</label>
                    <input 
                        id="search"
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Tytuł, autor, ISBN..." 
                        class="w-full px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-sm text-sm focus:outline-none focus:border-[#f53003] transition-colors"
                    >
                    <button type="submit" class="absolute right-3 top-2.5 text-[#706f6c]">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </button>
                </form>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Kategorie</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('books.index') }}" class="text-sm {{ !request('category') ? 'text-[#f53003] font-medium' : 'text-[#706f6c] hover:text-[#1b1b18] dark:hover:text-white' }} transition-colors">
                            Wszystkie Kategorie
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('books.index', ['category' => $category->id] + request()->except('category', 'page')) }}" 
                               class="text-sm {{ request('category') == $category->id ? 'text-[#f53003] font-medium' : 'text-[#706f6c] hover:text-[#1b1b18] dark:hover:text-white' }} transition-colors">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>

    <div class="flex-1">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold tracking-tight">Nasza Kolekcja</h1>
            <p class="text-sm text-[#706f6c]">Znaleziono {{ $books->total() }} książek</p>
        </div>

        @if($books->isEmpty())
            <div class="py-20 text-center border border-dashed border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                <p class="text-[#706f6c]">Nie znaleziono książek spełniających kryteria.</p>
                <a href="{{ route('books.index') }}" class="text-[#f53003] text-sm font-medium mt-2 inline-block">Wyczyść filtry</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($books as $book)
                    <div class="group bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg overflow-hidden hover:shadow-xl hover:shadow-[#f530030a] transition-all duration-300">
                        <div class="aspect-3/4 bg-[#fff2f2] dark:bg-[#1D0002] flex items-center justify-center p-8">
                            <div class="text-center">
                                <span class="block text-xs font-bold text-[#f53003] uppercase tracking-widest mb-2">{{ $book->category->name }}</span>
                                <h4 class="font-semibold line-clamp-2 px-4">{{ $book->title }}</h4>
                                <p class="text-xs text-[#706f6c] mt-2">autor: {{ $book->authors->pluck('name')->join(', ') }}</p>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs text-[#706f6c]">ISBN: {{ $book->isbn }}</span>
                                <span class="text-xs font-medium">{{ $book->published_year }}</span>
                            </div>
                            <a href="{{ route('books.show', $book) }}" class="block w-full text-center py-2 border border-[#1b1b18] dark:border-[#eeeeec] rounded-sm text-sm font-medium group-hover:bg-[#1b1b18] group-hover:text-white dark:group-hover:bg-[#eeeeec] dark:group-hover:text-[#1C1C1A] transition-all">
                                Zobacz Szczegóły
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $books->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
