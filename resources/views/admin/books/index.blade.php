@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <header>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Zarządzanie Książkami</h1>
        <p class="text-[#706f6c] text-sm md:text-base">Zarządzaj książkami w bibliotece i ich szczegółami.</p>
    </header>

    <div class="overflow-x-auto border border-[#19140015] dark:border-[#ffffff15] rounded-lg bg-white dark:bg-[#161615]">
        <table class="w-full text-sm text-left">
            <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#19140015] dark:border-[#ffffff15]">
                <tr>
                    <th class="px-4 md:px-6 py-4 font-semibold">Tytuł</th>
                    <th class="hidden sm:table-cell px-6 py-4 font-semibold">Autorzy</th>
                    <th class="hidden md:table-cell px-6 py-4 font-semibold">Kategoria</th>
                    <th class="hidden lg:table-cell px-6 py-4 font-semibold">ISBN</th>
                    <th class="px-4 md:px-6 py-4 font-semibold text-right">Akcje</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#19140015] dark:divide-[#ffffff15]">
                @foreach($books as $book)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-4 md:px-6 py-4 font-medium">
                            <div class="flex flex-col">
                                <a href="{{ route('books.show', $book) }}" class="hover:text-[#f53003] hover:underline transition-colors truncate max-w-[150px] sm:max-w-none" target="_blank" rel="noopener noreferrer">
                                    {{ $book->title }}
                                </a>
                                <span class="sm:hidden text-[10px] text-[#706f6c]">{{ $book->authors->pluck('name')->first() }}...</span>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell px-6 py-4 text-[#706f6c]">
                            {{ $book->authors->pluck('name')->join(', ') }}
                        </td>
                        <td class="hidden md:table-cell px-6 py-4 text-[#706f6c]">{{ $book->category->name }}</td>
                        <td class="hidden lg:table-cell px-6 py-4 text-[#706f6c] font-mono text-xs">{{ $book->isbn }}</td>
                        <td class="px-4 md:px-6 py-4 text-right">
                            <a href="{{ route('admin.books.edit', $book) }}" class="text-[#f53003] hover:underline font-medium">Edytuj</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="overflow-x-auto">
        {{ $books->links() }}
    </div>
</div>
@endsection
