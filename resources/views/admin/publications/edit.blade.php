@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b bg-slate-50/50 flex justify-between items-center">
        <h2 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Edit Publication</h2>
        <a href="{{ route('publications.index') }}" class="text-slate-400 hover:text-slate-600 text-xs font-bold uppercase tracking-widest">Back</a>
    </div>

    <form action="{{ route('publications.update', $publication->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Publication Title</label>
                <input type="text" name="title" value="{{ old('title', $publication->title) }}" class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition text-sm text-slate-600 font-medium" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Publisher</label>
                    <input type="text" name="publisher" value="{{ old('publisher', $publication->publisher) }}" class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition text-sm text-slate-600 font-medium" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Nepali Date</label>
                    <input type="text" name="nepali_date" value="{{ old('nepali_date', $publication->nepali_date) }}" class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition text-sm text-slate-600 font-medium" placeholder="2080-01-01">
                </div>
            </div>

            <div>
    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Category</label>
    <select name="category_id" class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition text-sm text-slate-600 font-medium">
        <option value="">Select Category</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" 
                {{ (old('category_id', $publication->category_id) == $cat->id) ? 'selected' : '' }}>
                {{ $cat->title }}
            </option>
        @endforeach
    </select>
    @error('category_id') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
</div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Update File (Leave blank to keep current)</label>
                <div class="flex items-center space-x-4">
                    <input type="file" name="file" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition">
                    @if($publication->file_path)
                        <span class="text-[10px] text-slate-400 italic">Current: {{ basename($publication->file_path) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-[#1d0647] text-white py-4 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-500/20 hover:bg-[#2d0a6b] transition duration-300">
                Update Publication
            </button>
        </div>
    </form>
</div>
@endsection