@extends('layouts.app')

@section('content')
<div class="space-y-12">
    <header>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Panel Administratora</h1>
        <p class="text-[#706f6c] text-sm md:text-base">Przegląd operacji i statystyk biblioteki.</p>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('admin.books.index') }}" class="block p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg hover:bg-gray-50 dark:hover:bg-[#1f1f1e] transition-colors">
            <span class="text-[10px] md:text-xs font-bold text-[#706f6c] uppercase tracking-widest">Wszystkie Książki</span>
            <p class="text-2xl md:text-3xl font-bold mt-1">{{ $stats['books_count'] }}</p>
        </a>
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" class="block p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg hover:bg-gray-50 dark:hover:bg-[#1f1f1e] transition-colors">
                <span class="text-[10px] md:text-xs font-bold text-[#706f6c] uppercase tracking-widest">Użytkownicy</span>
                <p class="text-2xl md:text-3xl font-bold mt-1">{{ $stats['users_count'] }}</p>
            </a>
        @else
            <div class="p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                <span class="text-[10px] md:text-xs font-bold text-[#706f6c] uppercase tracking-widest">Użytkownicy</span>
                <p class="text-2xl md:text-3xl font-bold mt-1">{{ $stats['users_count'] }}</p>
            </div>
        @endif
        <div class="p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
            <span class="text-[10px] md:text-xs font-bold text-[#706f6c] uppercase tracking-widest">Aktywne Wypożyczenia</span>
            <p class="text-2xl md:text-3xl font-bold mt-1 text-[#f53003]">{{ $stats['active_loans'] }}</p>
        </div>
        <div class="p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
            <span class="text-[10px] md:text-xs font-bold text-[#706f6c] uppercase tracking-widest">Oczekujące Rezerwacje</span>
            <p class="text-2xl md:text-3xl font-bold mt-1">{{ $stats['pending_reservations'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-6">
            <h2 class="text-xl font-semibold">Ostatnie Wypożyczenia</h2>
            <div class="overflow-x-auto border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                <table class="w-full text-sm text-left whitespace-nowrap md:whitespace-normal">
                    <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#19140015] dark:border-[#ffffff15]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Użytkownik</th>
                            <th class="px-4 py-3 font-semibold">Książka</th>
                            <th class="px-4 py-3 font-semibold">Data</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#19140015] dark:divide-[#ffffff15]">
                        @foreach($recent_loans as $loan)
                            <tr class="bg-white dark:bg-[#161615]">
                                <td class="px-4 py-3 font-medium">{{ $loan->user->name }}</td>
                                <td class="px-4 py-3 text-[#706f6c]">{{ $loan->book->title }}</td>
                                <td class="px-4 py-3 text-[#706f6c]">{{ $loan->loan_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <h2 class="text-xl font-semibold">Ostatnie Rezerwacje</h2>
            <div class="overflow-x-auto border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                <table class="w-full text-sm text-left whitespace-nowrap md:whitespace-normal">
                    <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#19140015] dark:border-[#ffffff15]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Użytkownik</th>
                            <th class="px-4 py-3 font-semibold">Książka</th>
                            <th class="px-4 py-3 font-semibold">Data</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#19140015] dark:divide-[#ffffff15]">
                        @foreach($recent_reservations as $res)
                            <tr class="bg-white dark:bg-[#161615]">
                                <td class="px-4 py-3 font-medium">{{ $res->user->name }}</td>
                                <td class="px-4 py-3 text-[#706f6c]">{{ $res->book->title }}</td>
                                <td class="px-4 py-3 text-[#706f6c]">{{ $res->reserved_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
