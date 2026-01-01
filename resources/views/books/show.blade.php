@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex flex-col md:flex-row gap-12">
        <div class="w-full md:w-1/3">
            <div class="aspect-3/4 bg-[#fff2f2] dark:bg-[#1D0002] flex items-center justify-center p-12 rounded-lg shadow-inner">
                <div class="text-center">
                    <svg class="w-24 h-24 mx-auto text-[#f5300320]" fill="currentColor" viewBox="0 0 24 24"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5z"/></svg>
                    <p class="text-xs font-bold text-[#f53003] uppercase tracking-widest mt-4">{{ $book->category->name }}</p>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-medium text-[#706f6c]">
                    <li><a href="{{ route('books.index') }}" class="hover:text-[#1b1b18] dark:hover:text-white transition-colors">Książki</a></li>
                    <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li class="text-[#1b1b18] dark:text-white">{{ $book->title }}</li>
                </ol>
            </nav>

            <h1 class="text-4xl font-bold tracking-tight mb-2">{{ $book->title }}</h1>
            <p class="text-xl text-[#706f6c] mb-6"> {{ $book->authors->pluck('name')->join(', ') }}</p>

            <div class="flex flex-wrap gap-4 mb-8">
                <div class="px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                    <span class="block text-[10px] uppercase font-bold text-[#706f6c]">ISBN</span>
                    <span class="text-sm font-medium">{{ $book->isbn }}</span>
                </div>
                <div class="px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                    <span class="block text-[10px] uppercase font-bold text-[#706f6c]">Rok</span>
                    <span class="text-sm font-medium">{{ $book->published_year }}</span>
                </div>
                <div class="px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                    <span class="block text-[10px] uppercase font-bold text-[#706f6c]">Wydawca</span>
                    <span class="text-sm font-medium">{{ $book->publisher->name }}</span>
                </div>
                <div class="px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                    <span class="block text-[10px] uppercase font-bold text-[#706f6c]">Dostępne Egzemplarze</span>
                    <span class="text-sm font-medium {{ $book->available_copies > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $book->available_copies }} / {{ $book->total_copies }}
                    </span>
                </div>
            </div>

            <div class="prose dark:prose-invert max-w-none mb-10">
                <h3 class="text-lg font-semibold mb-2">Opis</h3>
                <p class="text-[#706f6c] leading-relaxed">{{ $book->description }}</p>
            </div>

            <div class="flex gap-4">
                @auth
                    @php
                        $userReservation = $book->reservations->where('user_id', Auth::id())->first();
                    @endphp

                    @if($userReservation)
                        <button disabled class="flex-1 py-4 bg-zinc-100 dark:bg-zinc-800 text-[#706f6c] border border-zinc-200 dark:border-zinc-700 rounded-sm font-semibold cursor-not-allowed">
                            Zarezerwowana
                        </button>
                    @elseif($book->available_copies < 1)
                        <button disabled class="flex-1 py-4 bg-zinc-100 dark:bg-zinc-800 text-red-600 border border-zinc-200 dark:border-zinc-700 rounded-sm font-semibold cursor-not-allowed">
                            Obecnie Niedostępna
                        </button>
                    @else
                        <form action="{{ route('reservations.store') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="w-full py-4 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm font-semibold hover:opacity-90 transition-opacity cursor-pointer">
                                Zarezerwuj tę Książkę
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="flex-1 block text-center py-4 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm font-semibold hover:opacity-90 transition-opacity">
                        Zaloguj się aby zarezerwować
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <section class="mt-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold tracking-tight">Opinie Użytkowników</h2>
        </div>

        @auth
            @if(!$book->reviews->where('user_id', Auth::id())->first())
                <div class="mb-12 p-6 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg border border-[#f5300320]">
                    <h3 class="text-lg font-semibold mb-4">Napisz Opinię</h3>
                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        
                        <div>
                            <label for="rating" class="block text-xs font-bold uppercase tracking-widest text-[#706f6c] mb-2">Ocena</label>
                            <select id="rating" name="rating" class="w-full md:w-32 px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-sm text-sm focus:outline-none focus:border-[#f53003]">
                                <option value="5">5 - Doskonała</option>
                                <option value="4">4 - Dobra</option>
                                <option value="3">3 - Średnia</option>
                                <option value="2">2 - Słaba</option>
                                <option value="1">1 - Fatalna</option>
                            </select>
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="comment" class="block text-xs font-bold uppercase tracking-widest text-[#706f6c] mb-2">Komentarz</label>
                            <textarea id="comment" name="comment" rows="4" class="w-full px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-sm text-sm focus:outline-none focus:border-[#f53003] min-h-10" placeholder="Podziel się swoimi przemyśleniami o tej książce..."></textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="px-8 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm text-sm font-semibold hover:opacity-90 transition-opacity cursor-pointer">
                            Wyślij Opinię
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        @if($book->reviews->isEmpty())
            <div class="py-12 text-center border border-dashed border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                <p class="text-[#706f6c]">Brak opinii. Bądź pierwszy!</p>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($book->reviews as $review)
                    <div class="p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#fff2f2] dark:bg-[#1D0002] flex items-center justify-center text-[#f53003] font-bold">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold">{{ $review->user->name }}</h4>
                                    <span class="text-xs text-[#706f6c]">{{ $review->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-[#f53003]">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-[#706f6c] opacity-30' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-[#706f6c] leading-relaxed">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
