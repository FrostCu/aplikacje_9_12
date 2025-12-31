@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <header class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Zarządzanie Użytkownikami</h1>
            <p class="text-[#706f6c]">Zarządzaj użytkownikami biblioteki i ich rolami.</p>
        </div>
    </header>

    <div class="overflow-hidden border border-[#19140015] dark:border-[#ffffff15] rounded-lg bg-white dark:bg-[#161615]">
        <table class="w-full text-sm text-left">
            <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#19140015] dark:border-[#ffffff15]">
                <tr>
                    <th class="px-6 py-4 font-semibold">Imię i Nazwisko</th>
                    <th class="px-6 py-4 font-semibold">Email</th>
                    <th class="px-6 py-4 font-semibold">Rola</th>
                    <th class="px-6 py-4 font-semibold">Dołączono</th>
                    <th class="px-6 py-4 font-semibold text-right">Akcje</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#19140015] dark:divide-[#ffffff15]">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-[#706f6c]">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-widest rounded {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'employee' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-[#706f6c] text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-[#f53003] hover:underline font-medium">Edytuj</a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $users->links() }}
    </div>
</div>
@endsection
