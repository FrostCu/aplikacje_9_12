@extends('layouts.app')

@section('content')
<div class="space-y-12">
    <header>
        <h1 class="text-3xl font-bold tracking-tight">Admin Dashboard</h1>
        <p class="text-[#706f6c]">Overview of library operations and statistics.</p>
    </header>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
            <span class="text-xs font-bold text-[#706f6c] uppercase tracking-widest">Total Books</span>
            <p class="text-3xl font-bold mt-1">{{ $stats['books_count'] }}</p>
        </div>
        <div class="p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
            <span class="text-xs font-bold text-[#706f6c] uppercase tracking-widest">Registered Users</span>
            <p class="text-3xl font-bold mt-1">{{ $stats['users_count'] }}</p>
        </div>
        <div class="p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
            <span class="text-xs font-bold text-[#706f6c] uppercase tracking-widest">Active Loans</span>
            <p class="text-3xl font-bold mt-1 text-[#f53003]">{{ $stats['active_loans'] }}</p>
        </div>
        <div class="p-6 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
            <span class="text-xs font-bold text-[#706f6c] uppercase tracking-widest">Pending Reservations</span>
            <p class="text-3xl font-bold mt-1">{{ $stats['pending_reservations'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Loans -->
        <div class="space-y-6">
            <h2 class="text-xl font-semibold">Recent Loans</h2>
            <div class="overflow-hidden border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                <table class="w-full text-sm text-left">
                    <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#19140015] dark:border-[#ffffff15]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">User</th>
                            <th class="px-4 py-3 font-semibold">Book</th>
                            <th class="px-4 py-3 font-semibold">Date</th>
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

        <!-- Recent Reservations -->
        <div class="space-y-6">
            <h2 class="text-xl font-semibold">Recent Reservations</h2>
            <div class="overflow-hidden border border-[#19140015] dark:border-[#ffffff15] rounded-lg">
                <table class="w-full text-sm text-left">
                    <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#19140015] dark:border-[#ffffff15]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">User</th>
                            <th class="px-4 py-3 font-semibold">Book</th>
                            <th class="px-4 py-3 font-semibold">Date</th>
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
