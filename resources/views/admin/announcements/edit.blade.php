@extends('layouts.admin')

@section('title', 'Edit Announcement')

@section('content')
<div class="max-w-4xl bg-white border border-slate-200 shadow-sm rounded-sm mx-auto">
    <div class="bg-[#1d0647] px-6 py-4 text-white font-bold uppercase text-xs tracking-widest border-b border-indigo-900 flex justify-between items-center">
        <span>Edit Announcement</span>
        <a href="{{ route('announcements.index') }}" class="text-[10px] bg-white/10 hover:bg-white/20 px-3 py-1 rounded">Back to List</a>
    </div>
    
    <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Notice Title</label>
                <input type="text" name="title" value="{{ old('title', $announcement->title) }}" class="w-full border border-slate-200 text-sm p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 rounded" required>
            </div>
            
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Category</label>
                <select name="category_id" class="w-full border border-slate-200 text-sm p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 rounded">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $announcement->category_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Change Attachment</label>
                <input type="file" name="file_path" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @if($announcement->file_path)
                    <p class="text-[10px] mt-2 text-indigo-500 font-bold italic">
                        <i class="fa-solid fa-paperclip mr-1"></i> Current file: {{ basename($announcement->file_path) }}
                    </p>
                @endif
            </div>

            <div class="md:col-span-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Content Details</label>
                <textarea name="description" rows="6" class="w-full border border-slate-200 text-sm p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 rounded">{{ old('description', $announcement->description) }}</textarea>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100 flex justify-end">
            <button class="bg-yellow-500 text-[#1d0647] px-12 py-3 text-xs font-bold uppercase tracking-widest hover:bg-yellow-400 transition-all shadow-md rounded-sm">
                Update Announcement
            </button>
        </div>
    </form>
</div>
@endsection