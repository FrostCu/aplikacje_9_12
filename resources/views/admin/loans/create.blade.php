@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">
    <header>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Utwórz Wypożyczenie</h1>
        <p class="text-[#706f6c] text-sm md:text-base">Wypożycz książkę użytkownikowi.</p>
    </header>

    <form action="{{ route('admin.loans.store') }}" method="POST" class="space-y-6 bg-white dark:bg-[#161615] p-4 md:p-8 border border-[#19140015] dark:border-[#ffffff15] rounded-xl shadow-sm">
        @csrf

        <div class="space-y-2">
            <label for="user_id" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Użytkownik</label>
            <select name="user_id" id="user_id" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all cursor-pointer appearance-none" required>
                <option value="">Wybierz użytkownika...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            @error('user_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-2">
            <label for="book_id" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Książka</label>
            <select name="book_id" id="book_id" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all cursor-pointer appearance-none" required>
                <option value="">Wybierz książkę...</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>{{ $book->title }} ({{ $book->isbn }})</option>
                @endforeach
            </select>
            @error('book_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-2">
            <label for="due_date" class="block text-sm font-semibold text-[#1a1a1a] dark:text-[#eeeeee]">Termin Zwrotu</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', now()->addWeeks(2)->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-lg border border-[#19140025] dark:border-[#ffffff20] bg-white dark:bg-[#0a0a0a] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-0 transition-all" required>
            @error('due_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4 sm:gap-6 pt-6 border-t border-[#19140015] dark:border-[#ffffff15]">
            <a href="{{ route('admin.loans.index') }}" class="w-full sm:w-auto text-center text-sm font-semibold text-[#706f6c] hover:text-[#1a1a1a] dark:hover:text-white transition-colors">Anuluj</a>
            <button type="submit" class="w-full sm:w-auto px-8 py-2.5 bg-[#f53003] text-white text-sm font-bold rounded-lg hover:bg-[#d92902] transition-transform active:scale-95 shadow-lg shadow-[#f530031a]">
                Utwórz Wypożyczenie
            </button>
        </div>
    </form>
</div>
@endsection
