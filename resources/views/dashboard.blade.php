@extends('layouts.app')

@section('content')
<div class="space-y-12">
    <header>
        <h1 class="text-3xl font-bold tracking-tight">Your Dashboard</h1>
        <p class="text-[#706f6c]">Welcome back, {{ Auth::user()->name }}. Manage your library activities here.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Loans Section -->
        <div class="lg:col-span-2 space-y-6">
            <h2 class="text-xl font-semibold">Current Loans</h2>
            @if($loans->isEmpty())
                <div class="p-8 text-center border border-dashed border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                    <p class="text-[#706f6c]">You don't have any active loans.</p>
                    <a href="{{ route('books.index') }}" class="text-[#f53003] text-sm font-medium mt-2 inline-block">Browse Books</a>
                </div>
            @else
                <div class="grid gap-4">
                    @foreach($loans as $loan)
                        <div class="p-4 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-16 bg-[#fff2f2] dark:bg-[#1D0002] flex items-center justify-center rounded text-[#f53003]">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-sm">{{ $loan->book->title }}</h4>
                                    <p class="text-xs text-[#706f6c]">Borrowed on {{ $loan->loan_date }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold uppercase tracking-widest {{ $loan->return_date ? 'text-green-500' : 'text-[#f53003]' }}">
                                    {{ $loan->return_date ? 'Returned' : 'Due: ' . $loan->due_date }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-8">
            <div class="p-6 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg">
                <h3 class="font-bold text-[#f53003] mb-2">Need Help?</h3>
                <p class="text-sm text-[#706f6c] mb-4">If you have any issues with your loans or reservations, please contact our support.</p>
                <a href="mailto:support@library.com" class="text-sm font-bold text-[#1b1b18] dark:text-white underline">Contact Support</a>
            </div>

            <div class="space-y-4">
                <h3 class="font-semibold">Your Reservations</h3>
                @if($reservations->isEmpty())
                    <p class="text-xs text-[#706f6c]">No active reservations.</p>
                @else
                    @foreach($reservations as $reservation)
                        <div class="text-sm py-2 border-b border-[#19140015] dark:border-[#ffffff15] flex items-center justify-between">
                            <span class="truncate pr-4">{{ $reservation->book->title }}</span>
                            <span class="text-[10px] text-[#706f6c] shrink-0">{{ $reservation->reserved_date }}</span>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="space-y-4">
                <h3 class="font-semibold">Your Reviews</h3>
                @if($reviews->isEmpty())
                    <p class="text-xs text-[#706f6c]">You haven't written any reviews yet.</p>
                @else
                    @foreach($reviews as $review)
                        <div class="p-3 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded text-xs">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-medium truncate">{{ $review->book->title }}</span>
                                <span class="text-[#f53003]">{{ $review->rating }}/5</span>
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
