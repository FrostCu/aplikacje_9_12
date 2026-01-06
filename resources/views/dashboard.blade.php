@extends('layouts.app')

@section('content')
<div class="space-y-12">
    <header>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Twój Panel</h1>
        <p class="text-[#706f6c] text-sm md:text-base">Witaj ponownie, {{ Auth::user()->name }}. Zarządzaj swoimi aktywnościami w bibliotece tutaj.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <h2 class="text-xl font-semibold">Aktualne Wypożyczenia</h2>
            @if($loans->isEmpty())
                <div class="p-8 text-center border border-dashed border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                    <p class="text-[#706f6c]">Nie masz żadnych aktywnych wypożyczeń.</p>
                    <a href="{{ route('books.index') }}" class="text-[#f53003] text-sm font-medium mt-2 inline-block">Przeglądaj Książki</a>
                </div>
            @else
                <div class="grid gap-4">
                    @foreach($loans as $loan)
                        <div class="p-4 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-16 bg-[#fff2f2] dark:bg-[#1D0002] flex items-center justify-center rounded shrink-0 text-[#f53003]">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-sm">{{ $loan->book->title }}</h4>
                                    <p class="text-xs text-[#706f6c]">Wypożyczono {{ $loan->loan_date }}</p>
                                </div>
                            </div>
                            <div class="sm:text-right">
                                <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest {{ $loan->returned_date ? 'text-green-500' : 'text-[#f53003]' }}">
                                    {{ $loan->returned_date ? 'Zwrócono' : 'Termin: ' . $loan->due_date }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="space-y-8">
            <div class="space-y-4">
                <h3 class="font-semibold">Twoje Rezerwacje</h3>
                @if($reservations->isEmpty())
                    <p class="text-xs text-[#706f6c]">Brak aktywnych rezerwacji.</p>
                @else
                    @foreach($reservations as $reservation)
                        <div class="text-sm py-2 border-b border-[#19140015] dark:border-[#ffffff15] flex items-center justify-between gap-4">
                            <span class="truncate pr-4">{{ $reservation->book->title }}</span>
                            <span class="text-[10px] text-[#706f6c] shrink-0">{{ $reservation->reserved_date }}</span>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="space-y-4">
                <h3 class="font-semibold">Twoje Opinie</h3>
                @if($reviews->isEmpty())
                    <p class="text-xs text-[#706f6c]">Nie napisałeś jeszcze żadnej opinii.</p>
                @else
                    @foreach($reviews as $review)
                        <div class="p-3 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded text-xs">
                            <div class="flex items-center justify-between mb-1 gap-4">
                                <span class="font-medium truncate">{{ $review->book->title }}</span>
                                <span class="text-[#f53003] shrink-0">{{ $review->rating }}/5</span>
                            </div>
                            <p class="text-[#706f6c] line-clamp-2">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
