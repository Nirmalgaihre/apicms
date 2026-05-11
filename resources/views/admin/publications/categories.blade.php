@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8 border-b border-gray-100 pb-4 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Publication Categories</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Organize reports, journals, and books</p>
        </div>
        <div class="text-right">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Nepal Time</p>
            <p class="text-xs font-bold text-gray-600">{{ now()->timezone('Asia/Kathmandu')->format('h:i A') }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-3 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded text-xs font-bold uppercase text-center animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- LEFT COLUMN: ADD FORM --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm h-fit">
            <div class="flex items-center gap-2 mb-6">
                <i class="fa-solid fa-folder-plus text-blue-500"></i>
                <h3 class="text-sm font-black text-gray-700 uppercase tracking-widest">Create New</h3>
            </div>

            <form action="{{ route('pub-categories.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Category Title</label>
                    <input type="text" name="title" placeholder="e.g. Research Journals" required 
                           class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                    @error('title')
                        <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-bold py-3 rounded-lg text-[10px] uppercase tracking-widest transition-all shadow-lg shadow-slate-200">
                    Save Publication Category
                </button>
            </form>
        </div>

        {{-- RIGHT COLUMN: LIST TABLE --}}
        <div class="md:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-tighter w-16">ID</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Title</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $cat)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-mono text-gray-300">#{{ $cat->id }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition-colors">{{ $cat->title }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('pub-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Permanently delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition-all p-2 rounded-md hover:bg-red-50">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <i class="fa-solid fa-layer-group text-4xl mb-2"></i>
                                <p class="text-xs font-bold uppercase tracking-widest">No Categories Created</p>
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