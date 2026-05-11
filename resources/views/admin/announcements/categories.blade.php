@extends('layouts.admin')

@section('title', 'Program Categories')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="bg-white border border-slate-200 shadow-sm rounded-sm h-fit">
        <div class="bg-[#1d0647] px-6 py-4 text-white text-xs font-bold uppercase">Add New Category</div>
        <form action="{{ route('announcements.categories.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="text" name="name" class="w-full border border-slate-200 text-sm p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 rounded" placeholder="Category Name" required>
            <button class="w-full bg-yellow-500 text-[#1d0647] py-3 text-xs font-bold uppercase tracking-widest hover:bg-yellow-400 transition-colors shadow-sm rounded-sm">
                Add Category
            </button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white border border-slate-200 shadow-sm rounded-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b">
                <tr>
                    <th class="px-6 py-4 uppercase text-[10px] text-slate-500 font-black">Category Name</th>
                    <th class="px-6 py-4 text-right uppercase text-[10px] text-slate-500 font-black">Control</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($categories as $cat)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $cat->name }}</td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-slate-400 hover:text-red-500 transition-colors"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection