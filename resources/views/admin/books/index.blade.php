@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <header class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Zarządzanie Książkami</h1>
            <p class="text-[#706f6c]">Zarządzaj książkami w bibliotece i ich szczegółami.</p>
        </div>
    </header>

    @if(session('success'))
        <div class="p-4 bg-green-50 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden border border-[#19140015] dark:border-[#ffffff15] rounded-lg bg-white dark:bg-[#161615]">
        <table class="w-full text-sm text-left">
            <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#19140015] dark:border-[#ffffff15]">
                <tr>
                    <th class="px-6 py-4 font-semibold">Tytuł</th>
                    <th class="px-6 py-4 font-semibold">Autor(rzy)</th>
                    <th class="px-6 py-4 font-semibold">Kategoria</th>
                    <th class="px-6 py-4 font-semibold">ISBN</th>
                    <th class="px-6 py-4 font-semibold text-right">Akcje</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#19140015] dark:divide-[#ffffff15]">
                @foreach($books as $book)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-medium">
                            <a href="{{ route('books.show', $book) }}" class="hover:text-[#f53003] hover:underline transition-colors" target="_blank">
                                {{ $book->title }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-[#706f6c]">
                            {{ $book->authors->pluck('name')->join(', ') }}
                        </td>
                        <td class="px-6 py-4 text-[#706f6c]">{{ $book->category->name }}</td>
                        <td class="px-6 py-4 text-[#706f6c] font-mono text-xs">{{ $book->isbn }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.books.edit', $book) }}" class="text-[#f53003] hover:underline font-medium">Edytuj</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $books->links() }}
    </div>
</div>
@endsection
