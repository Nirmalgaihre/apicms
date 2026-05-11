@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200">
    {{-- Header Section --}}
    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-white rounded-t-xl">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Resource Management</h2>
            <p class="text-sm text-slate-500">Manage official documents, PDF reports, and image assets</p>
        </div>
        <a href="{{ route('resources.create') }}" class="bg-[#003366] text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-black transition-all shadow-sm">
            <i class="fa-solid fa-plus mr-2"></i> Register New Resource
        </a>
    </div>

    <div class="p-6">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-lg border border-emerald-100 font-bold text-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">
                        <th class="pb-4 px-4">Preview</th>
                        <th class="pb-4 px-4">Title & Description</th>
                        <th class="pb-4 px-4 text-center">Type</th>
                        <th class="pb-4 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($resources as $res)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        {{-- Preview Column --}}
                        <td class="py-4 px-4">
                            @if(Str::endsWith($res->file_path, '.pdf'))
                                <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center border border-red-100 shadow-sm">
                                    <i class="fa-solid fa-file-pdf text-red-500 text-xl"></i>
                                </div>
                            @else
                                <img src="{{ asset('storage/' . $res->file_path) }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200 shadow-sm">
                            @endif
                        </td>

                        {{-- Title Column --}}
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-700 block">{{ $res->title }}</div>
                            <div class="text-xs text-slate-400 mt-0.5 max-w-xs truncate">{{ $res->description ?? 'No description provided.' }}</div>
                        </td>

                        {{-- File Type Badge --}}
                        <td class="py-4 px-4 text-center">
                            @php
                                $extension = pathinfo($res->file_path, PATHINFO_EXTENSION);
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter 
                                {{ $extension == 'pdf' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $extension }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="py-4 px-4 text-right">
                            <div class="flex justify-end items-center space-x-4">
                                <a href="{{ asset('storage/' . $res->file_path) }}" target="_blank" class="text-slate-400 hover:text-[#003366] transition" title="View File">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('resources.edit', $res->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm transition">
                                    Edit
                                </a>
                                <form action="{{ route('resources.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resource permanently?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-700 font-bold text-sm transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-folder-open text-slate-200 text-5xl mb-3"></i>
                                <p class="text-slate-400 font-medium">No resources found in the database.</p>
                                <a href="{{ route('resources.create') }}" class="text-[#003366] text-sm font-bold mt-2 hover:underline">Click here to add your first one</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection