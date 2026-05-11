@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Manage Notice Categories</h2>
        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Add or remove categories for the notice board</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-3 bg-green-50 text-green-700 border border-green-200 rounded text-xs font-bold uppercase text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm h-fit">
            <h3 class="text-sm font-black text-gray-400 uppercase mb-6 tracking-widest">New Category</h3>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-600 mb-2">Category Name</label>
                    <input type="text" name="name" placeholder="e.g. Results" required 
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-blue-500 outline-none">
                </div>
                <button type="submit" class="w-full bg-[#333] hover:bg-black text-white font-bold py-2 rounded text-xs uppercase transition">
                    Save Category
                </button>
            </form>
        </div>

        <div class="md:col-span-2 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase">ID</th>
                        <th class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase">Category Name</th>
                        <th class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $cat)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-xs font-bold text-gray-400">{{ $cat->id }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">{{ $cat->name }}</td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-400 text-xs italic">No categories found. Add one on the left.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection