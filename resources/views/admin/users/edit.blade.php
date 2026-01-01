@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">
    <header>
        <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-[#706f6c] hover:text-[#f53003] transition-colors flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Powrót do Użytkowników
        </a>
        <h1 class="text-3xl font-bold tracking-tight">Edytuj Użytkownika</h1>
        <p class="text-[#706f6c]">Zaktualizuj informacje i rolę dla {{ $user->name }}.</p>
    </header>

    <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#ffffff15] rounded-xl p-8 shadow-sm">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-sm font-semibold">Imię i Nazwisko</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                    class="w-full px-4 py-2 rounded-lg border border-[#19140015] dark:border-[#ffffff15] bg-transparent focus:ring-2 focus:ring-[#f53003] focus:border-transparent outline-none transition-all @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold">Adres Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                    class="w-full px-4 py-2 rounded-lg border border-[#19140015] dark:border-[#ffffff15] bg-transparent focus:ring-2 focus:ring-[#f53003] focus:border-transparent outline-none transition-all @error('email') border-red-500 @enderror"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="role" class="block text-sm font-semibold">Rola Użytkownika</label>
                <select name="role" id="role" 
                    class="w-full px-4 py-2 rounded-lg border border-[#19140015] dark:border-[#ffffff15] bg-white dark:bg-[#161615] focus:ring-2 focus:ring-[#f53003] focus:border-transparent outline-none transition-all @error('role') border-red-500 @enderror"
                    required>
                    <option value="client" {{ old('role', $user->role) === 'client' ? 'selected' : '' }}>Klient</option>
                    <option value="employee" {{ old('role', $user->role) === 'employee' ? 'selected' : '' }}>Pracownik</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-4">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2 rounded-lg font-medium text-[#706f6c] hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                    Anuluj
                </a>
                <button type="submit" class="px-6 py-2 bg-[#f53003] text-white rounded-lg font-medium hover:bg-[#e02b02] transition-colors shadow-sm">
                    Zaktualizuj Użytkownika
                </button>
            </div>
        </form>
    </div>

    @if($user->id !== auth()->id())
    <div class="pt-8 border-t border-[#19140015] dark:border-[#ffffff15]">
        <div class="bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-900/20 rounded-xl p-6 flex items-center justify-between">
            <div>
                <h3 class="text-red-800 dark:text-red-400 font-semibold">Strefa Niebezpieczna</h3>
                <p class="text-red-600/80 dark:text-red-400/60 text-sm">Usunięcie użytkownika jest nieodwracalne.</p>
            </div>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-white dark:bg-transparent border border-red-200 dark:border-red-900/30 text-red-600 hover:bg-red-600 hover:text-white rounded-lg font-medium transition-all" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">
                    Usuń Konto
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
