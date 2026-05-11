@extends('layouts.admin')

@section('content')
<!-- Developer Protection Notice -->
<div class="mb-6 p-4 bg-amber-50 border-l-4 border-amber-400 text-amber-800 rounded shadow-sm flex items-center">
    <i class="fa-solid fa-shield-halved text-xl mr-4 text-amber-500"></i>
    <p class="text-xs font-medium">
        <strong class="uppercase">System Notice:</strong>
        The developer account (<span class="font-bold text-amber-900">gaihrenirmal2021@gmail.com</span>) manages core
        data and database integrity.
        This account is locked and cannot be removed to prevent system failure. <b>DO NOT attempt to remove or modify
            this administrative access.</b>
    </p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b flex justify-between items-center bg-slate-50/50">
        <h2 class="font-bold text-slate-700 uppercase text-xs tracking-widest">System Administrators</h2>
        <a href="{{ route('users.create') }}"
            class="bg-[#1d0647] text-white px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest">Add New
            Admin</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-white border-b text-[10px] uppercase font-bold text-slate-400">
                <tr>
                    <th class="px-8 py-4">User</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Created</th>
                    <th class="px-8 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-4 flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f1f5f9&color=64748b"
                            class="w-8 h-8 rounded-full border">
                        <div>
                            <div class="flex items-center space-x-2">
                                <p class="text-sm font-bold text-slate-700">{{ $user->name }}</p>
                                @if($user->email === 'gaihrenirmal2021@gmail.com')
                                <span
                                    class="bg-amber-100 text-amber-700 text-[8px] font-black px-1.5 py-0.5 rounded border border-amber-200 uppercase">Developer</span>
                                @endif
                            </div>
                            <p class="text-[10px] text-slate-400">{{ $user->email }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-indigo-50 text-indigo-600 rounded text-[10px] font-bold uppercase">
                            {{ $user->role ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-400">
                        {{ $user->created_at?->format('M d, Y') ?? 'No Date' }}
                    </td>
                    <td class="px-8 py-4 text-right space-x-3">
                        @if($user->email !== 'gaihrenirmal2021@gmail.com')
                        <!-- Standard Admin Actions -->
                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700"
                            title="Edit Admin">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Are you sure you want to delete this admin?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors"
                                title="Delete Admin">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        @else
                        <!-- Protected Developer Actions (Disabled Icons) -->
                        <span class="text-slate-200 cursor-not-allowed" title="System protected: Cannot edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>

                        <button type="button" class="text-slate-200 cursor-not-allowed"
                            title="System protected: Cannot delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center text-slate-400 text-sm">
                        No administrators found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection