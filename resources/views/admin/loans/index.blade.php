@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Wypożyczenia</h1>
            <p class="text-[#706f6c] text-sm md:text-base">Zarządzaj wypożyczeniami książek i zwrotami.</p>
        </div>
        <a href="{{ route('admin.loans.create') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-[#f53003] text-white text-sm font-bold rounded-lg hover:bg-[#d92902] transition-colors shadow-sm">
            Nowe Wypożyczenie
        </a>
    </header>

    <div class="overflow-x-auto border border-[#19140015] dark:border-[#ffffff15] rounded-lg bg-white dark:bg-[#161615]">
        <table class="w-full text-sm text-left">
            <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#19140015] dark:border-[#ffffff15]">
                <tr>
                    <th class="px-4 md:px-6 py-4 font-semibold">Użytkownik</th>
                    <th class="px-4 md:px-6 py-4 font-semibold">Książka</th>
                    <th class="hidden md:table-cell px-6 py-4 font-semibold">Wypożyczono</th>
                    <th class="hidden lg:table-cell px-6 py-4 font-semibold">Termin</th>
                    <th class="px-4 md:px-6 py-4 font-semibold">Status</th>
                    <th class="px-4 md:px-6 py-4 font-semibold text-right">Akcje</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#19140015] dark:divide-[#ffffff15]">
                @foreach($loans as $loan)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-4 md:px-6 py-4 font-medium">{{ $loan->user->name }}</td>
                        <td class="px-4 md:px-6 py-4 text-[#706f6c]">
                            <div class="flex flex-col">
                                <span class="truncate max-w-[120px] sm:max-w-none">{{ $loan->book->title }}</span>
                                <span class="md:hidden text-[10px] text-[#706f6c]">{{ $loan->loan_date }}</span>
                            </div>
                        </td>
                        <td class="hidden md:table-cell px-6 py-4 text-[#706f6c]">{{ $loan->loan_date }}</td>
                        <td class="hidden lg:table-cell px-6 py-4 text-[#706f6c]">{{ $loan->due_date }}</td>
                        <td class="px-4 md:px-6 py-4">
                            @if($loan->returned_date)
                                <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-widest rounded bg-green-100 text-green-700">Zwrócono</span>
                            @elseif(\Carbon\Carbon::parse($loan->due_date)->isPast())
                                <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-widest rounded bg-red-100 text-red-700">Zaległe</span>
                            @else
                                <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-widest rounded bg-blue-100 text-blue-700">Aktywne</span>
                            @endif
                        </td>
                        <td class="px-4 md:px-6 py-4 text-right">
                            @if(!$loan->returned_date)
                                <form action="{{ route('admin.loans.update', $loan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="return" value="1">
                                    <button type="submit" class="text-[#f53003] hover:underline font-medium text-xs md:text-sm">Zwróć</button>
                                </form>
                            @else
                                <span class="text-[#706f6c] text-[10px] md:text-xs whitespace-nowrap">{{ $loan->returned_date }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="overflow-x-auto">
        {{ $loans->links() }}
    </div>
</div>
@endsection
