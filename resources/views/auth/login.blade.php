@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-lg overflow-hidden shadow-sm">
        <div class="px-8 py-6 border-b border-[#19140015] dark:border-[#ffffff15]">
            <h2 class="text-xl font-bold tracking-tight">{{ __('Login') }}</h2>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-widest text-[#706f6c] mb-2">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        class="w-full px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-sm text-sm focus:outline-none focus:border-[#f53003] transition-colors @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-widest text-[#706f6c] mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-2 bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-sm text-sm focus:outline-none focus:border-[#f53003] transition-colors @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input class="h-4 w-4 text-[#f53003] focus:ring-[#f53003] border-[#19140015] rounded-sm" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="ml-2 block text-sm text-[#706f6c]" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm font-semibold hover:opacity-90 transition-opacity cursor-pointer">
                    {{ __('Login') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection