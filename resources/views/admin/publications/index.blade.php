@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b flex justify-between items-center bg-slate-50">
        <h2 class="font-bold text-slate-800">Manage Publications</h2>
        <a href="{{ route('publications.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded text-[10px] font-bold uppercase">Add New</a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 text-green-700 text-xs font-bold text-center uppercase">{{ session('success') }}</div>
    @endif

    <table class="w-full text-left">
        <thead class="bg-slate-100 border-b">
            <tr>
                <th class="px-6 py-3 text-[10px] font-black text-slate-400 uppercase">Title & Publisher</th>
                <th class="px-6 py-3 text-[10px] font-black text-slate-400 uppercase">Category</th>
                <th class="px-6 py-3 text-[10px] font-black text-slate-400 uppercase">File</th>
                <th class="px-6 py-3 text-[10px] font-black text-slate-400 uppercase text-right">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($publications as $pub)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4">
                    <p class="text-sm font-bold text-slate-700">{{ $pub->title }}</p>
                    <p class="text-[10px] text-slate-400 uppercase">{{ $pub->publisher }} | {{ $pub->nepali_date }}</p>
                </td>
                <td class="px-6 py-4 text-xs text-slate-500 font-semibold">{{ $pub->category }}</td>
                <td class="px-6 py-4">
                    @if($pub->file_path)
                        <a href="{{ asset('storage/'.$pub->file_path) }}" target="_blank" class="text-indigo-500 text-xs hover:underline"><i class="fa-solid fa-file-pdf"></i> View</a>
                    @else
                        <span class="text-gray-300 text-xs italic">No File</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right space-x-3">
    <a href="{{ route('publications.edit', $pub->id) }}" class="text-blue-500 hover:text-blue-700">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    <form action="{{ route('publications.destroy', $pub->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
        @csrf @method('DELETE')
        <button class="text-red-400 hover:text-red-600"><i class="fa-solid fa-trash"></i></button>
    </form>
</td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-10 text-center text-slate-400 italic text-xs">No publications found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection