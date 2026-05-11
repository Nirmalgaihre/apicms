@extends('layouts.admin')
@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Gallery Management</h2>
            <p class="text-sm text-slate-500">Manage albums and event photos</p>
        </div>
        <a href="{{ route('gallery.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition">
            Create New Album
        </a>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 text-emerald-700 rounded-lg border border-emerald-100 font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full text-left">
            <thead>
                <tr class="text-xs font-bold text-slate-400 uppercase tracking-widest border-b">
                    <th class="pb-4 px-4">Preview</th>
                    <th class="pb-4 px-4">Title</th>
                    <th class="pb-4 px-4 text-center">Photos</th>
                    <th class="pb-4 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($galleries as $gallery)
                <tr class="hover:bg-slate-50">
                    <td class="py-4 px-4">
                        @if($gallery->thumbnail_path)
                            <img src="{{ asset('storage/' . $gallery->thumbnail_path) }}" class="w-12 h-12 rounded object-cover border">
                        @else
                            <div class="w-12 h-12 bg-slate-100 rounded flex items-center justify-center text-[10px] text-slate-400">NO THUMB</div>
                        @endif
                    </td>
                    <td class="py-4 px-4 font-semibold text-slate-700">{{ $gallery->title }}</td>
                    <td class="py-4 px-4 text-center">
                        <span class="bg-indigo-50 text-indigo-600 px-2.5 py-1 rounded-full text-xs font-bold">{{ $gallery->images_count }}</span>
                    </td>
                    <td class="py-4 px-4 text-right">
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('gallery.edit', $gallery->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Delete everything?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection