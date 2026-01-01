<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <style>
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen">
    <div id="app">
        <header class="w-full border-b border-[#19140015] dark:border-[#ffffff15] bg-white dark:bg-[#161615] sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-8">
                        <a href="{{ url('/') }}" class="text-xl font-semibold tracking-tight">
                            {{ config('app.name', 'Biblioteka') }}
                        </a>
                        <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                            <a href="{{ route('books.index') }}" class="hover:text-[#f53003] transition-colors {{ request()->routeIs('books.*') ? 'text-[#f53003]' : '' }}">Książki</a>
                            @auth
                                @if(Auth::user()->role === 'client')
                                    <a href="{{ route('client.dashboard') }}" class="hover:text-[#f53003] transition-colors {{ request()->routeIs('client.dashboard') ? 'text-[#f53003]' : '' }}">Mój Panel</a>
                                @endif
                                @if(in_array(Auth::user()->role, ['admin', 'employee']))
                                    <div class="h-4 w-[1px] bg-[#19140015] dark:bg-[#ffffff15] mx-2"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f53003] transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-[#f53003]' : '' }}">Admin</a>
                                    <a href="{{ route('admin.books.index') }}" class="hover:text-[#f53003] transition-colors {{ request()->routeIs('admin.books.*') ? 'text-[#f53003]' : '' }}">Zarządzaj Książkami</a>
                                    <a href="{{ route('admin.loans.index') }}" class="hover:text-[#f53003] transition-colors {{ request()->routeIs('admin.loans.*') ? 'text-[#f53003]' : '' }}">Zarządzaj Wypożyczeniami</a>
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.users.index') }}" class="hover:text-[#f53003] transition-colors {{ request()->routeIs('admin.users.*') ? 'text-[#f53003]' : '' }}">Użytkownicy</a>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-[#f53003] transition-colors">Zaloguj się</a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-block px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm text-sm font-medium hover:opacity-90 transition-opacity">
                                    Zarejestruj się
                                </a>
                            @endif
                        @else
                            <div class="relative flex items-center gap-4">
                                <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="text-sm font-medium text-[#706f6c] hover:text-[#f53003] transition-colors">
                                    Wyloguj
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </div>
                </nav>
            </div>
        </header>

        <main class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 rounded-lg text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-8 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 rounded-lg text-sm font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>