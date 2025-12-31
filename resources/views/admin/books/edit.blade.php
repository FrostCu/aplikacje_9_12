@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">
    <header>
        <h1 class="text-3xl font-bold tracking-tight">Edytuj Książkę</h1>
        <p class="text-[#706f6c]">Zaktualizuj informacje o książce.</p>
    </header>

    <form action="{{ route('admin.books.update', $book) }}" method="POST" class="space-y-6 bg-white dark:bg-[#161615] p-8 border border-[#19140015] dark:border-[#ffffff15] rounded-xl shadow-sm">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label for="title" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Tytuł</label>
            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 dark:focus:ring-offset-[#161615] transition-all" required>
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="isbn" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">ISBN</label>
                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all" placeholder="np. 978-3-16-148410-0" required>
                @error('isbn') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="published_year" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Rok Wydania</label>
                <input type="number" name="published_year" id="published_year" value="{{ old('published_year', $book->published_year) }}" min="0" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all" required>
                @error('published_year') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="space-y-2">
                <label for="total_copies" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Liczba Egzemplarzy</label>
                <input type="number" name="total_copies" id="total_copies" value="{{ old('total_copies', $book->total_copies) }}" min="0" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all" required>
                @error('total_copies') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="space-y-2">
            <label for="description" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Opis</label>
            <textarea name="description" id="description" rows="5" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all resize-none" placeholder="Krótkie streszczenie książki...">{{ old('description', $book->description) }}</textarea>
            @error('description') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="category_id" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Kategoria</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all cursor-pointer appearance-none" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="publisher_id" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Wydawca</label>
                <select name="publisher_id" id="publisher_id" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all cursor-pointer appearance-none" required>
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                    @endforeach
                </select>
                @error('publisher_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="space-y-2">
            <label for="authors" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Autorzy</label>
            <select name="authors[]" id="authors" multiple class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all h-48 cursor-pointer overflow-y-auto" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ in_array($author->id, old('authors', $book->authors->pluck('id')->toArray())) ? 'selected' : '' }} class="py-1 px-2 rounded hover:bg-gray-100 dark:hover:bg-white/10">{{ $author->name }}</option>
                @endforeach
            </select>
            @error('authors') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end items-center gap-6 pt-6 border-t border-[#19140015] dark:border-[#ffffff15]">
            <a href="{{ route('admin.books.index') }}" class="text-sm font-semibold text-[#706f6c] hover:text-[#1a1a1a] dark:hover:text-white transition-colors">Anuluj</a>
            <button type="submit" class="px-8 py-2.5 bg-[#f53003] text-white text-sm font-bold rounded-lg hover:bg-[#d92902] transition-transform active:scale-95 shadow-lg shadow-[#f530031a]">
                Zapisz Zmiany
            </button>
        </div>
    </form>
</div>
@endsection
