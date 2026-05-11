@extends('layouts.admin')

@section('title', 'Staff Categories')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    
    <div class="mb-8 flex justify-between items-center border-b border-slate-100 pb-5">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Staff Categories</h2>
            <p class="text-xs text-slate-500 mt-1 uppercase tracking-wider">Organize faculty and administration hierarchy</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                    <h3 class="text-xs font-bold text-slate-600 uppercase tracking-widest">Add New Category</h3>
                </div>
                <form action="{{ route('staff-categories.store') }}" method="POST" class="p-6">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-widest">Category Name</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                <i class="fa-solid fa-tag text-xs"></i>
                            </span>
                            <input type="text" name="title" required placeholder="e.g. Teaching Faculty" 
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none text-sm transition-all">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-md active:scale-95">
                        <i class="fa-solid fa-plus mr-2"></i> Save Category
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Order</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Category Title</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Management</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($categories as $cat)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-xs font-mono font-bold text-slate-400">#{{ str_pad($cat->position, 2, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-slate-700">{{ $cat->title }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <form action="{{ route('staff-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Remove this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <i class="fa-solid fa-folder-open text-slate-200 text-4xl mb-4"></i>
                                <p class="text-xs text-slate-400 font-medium">No categories defined yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection