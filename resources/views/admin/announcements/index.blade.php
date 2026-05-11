@extends('layouts.admin')

@section('title', 'Manage Announcements')

@section('content')
<div class="bg-white border border-slate-200 shadow-sm rounded-sm overflow-hidden">
    <div class="bg-[#1d0647] px-6 py-4 text-white text-xs font-bold uppercase tracking-widest flex justify-between items-center">
        <div class="flex items-center">
            <i class="fa-solid fa-list-check mr-2 text-yellow-400"></i>
            Announcement Records
        </div>
        <a href="{{ route('announcements.create') }}" class="bg-yellow-500 text-[#1d0647] px-4 py-1.5 rounded-sm text-[10px] hover:bg-yellow-400 transition-all">
            <i class="fa-solid fa-plus mr-1"></i> Add New
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase text-center border-b border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 uppercase text-[10px] text-slate-500 font-black">Status</th>
                    <th class="px-6 py-4 uppercase text-[10px] text-slate-500 font-black">Title</th>
                    <th class="px-6 py-4 uppercase text-[10px] text-slate-500 font-black">Category</th>
                    <th class="px-6 py-4 text-right uppercase text-[10px] text-slate-500 font-black">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($announcements as $announcement)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="flex items-center text-[10px] font-bold text-emerald-600 uppercase">
                            <i class="fa-solid fa-circle text-[6px] mr-2"></i> Active
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $announcement->title }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded text-[10px] font-bold uppercase border border-indigo-100">
                            {{ $announcement->category->title ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end space-x-3">
                        <a href="{{ route('announcements.edit', $announcement->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Permanent delete?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-10 text-center text-slate-400 italic text-xs uppercase tracking-widest">No records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection