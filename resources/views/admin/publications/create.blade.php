@extends('layouts.admin')

@section('content')
<div class="flex justify-center items-center py-10">
    <div class="w-full max-w-2xl border border-gray-200 rounded-lg p-10 bg-white shadow-sm">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Add New Publication</h2>

        <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Category</label>
                    <select name="category" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50 outline-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->title }}">{{ $cat->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Upload File</label>
                    <input type="file" name="file" class="w-full border border-gray-300 rounded px-2 py-1 text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Title</label>
                <input type="text" name="title" required class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description</label>
                <textarea name="description" required rows="4" class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm outline-none resize-none"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nepali Date</label>
                    <input type="text" name="nepali_date" placeholder="2082-01-01" class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Publisher</label>
                    <input type="text" name="publisher" class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#1d0647] hover:bg-black text-white font-bold py-3 rounded text-xs uppercase tracking-widest transition">
                Save Publication
            </button>
        </form>
    </div>
</div>
@endsection