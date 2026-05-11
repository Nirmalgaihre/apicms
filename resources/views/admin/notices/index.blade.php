@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">Manage Notices</h2>
        <a href="{{ route('notices.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-xs font-bold uppercase hover:bg-blue-700 transition">
            + Add New Notice
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Date (BS)</th>
                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($notices as $notice)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $notice->title }}</div>
                        <div class="text-xs text-gray-400">By: {{ $notice->publisher }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-[10px] font-bold bg-gray-100 text-gray-600 rounded uppercase">
                            {{ $notice->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $notice->nepali_date }}
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
    <a href="{{ route('notices.edit', $notice->id) }}" class="text-blue-600 hover:text-blue-900 text-xs font-bold uppercase">Edit</a>
    
    <form action="{{ route('notices.destroy', $notice->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this notice?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900 text-xs font-bold uppercase">Delete</button>
    </form>
</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 text-sm italic">
                        No notices found. Start by adding one!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $notices->links() }}
    </div>
</div>
@endsection