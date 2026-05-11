@extends('layouts.admin')

@section('title', 'New Announcement')

@section('content')
<div class="max-w-4xl bg-white border border-slate-200 shadow-sm rounded-sm">
    <div class="bg-[#1d0647] px-6 py-4 text-white font-bold uppercase text-xs tracking-widest border-b border-indigo-900">
        Create Short-Term Program Notice
    </div>
    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Notice Title</label>
                <input type="text" name="title" class="w-full border border-slate-200 text-sm p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 rounded" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Category Selection</label>
                <select name="category_id" class="w-full border border-slate-200 text-sm p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 rounded">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Attachment (PDF/Image)</label>
                <input type="file" name="attachment" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Content Details</label>
                <textarea name="description" rows="6" class="w-full border border-slate-200 text-sm p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 rounded"></textarea>
            </div>
        </div>
        <div class="pt-6 border-t border-slate-100 flex justify-end">
            <button class="bg-[#1d0647] text-white px-12 py-3 text-xs font-bold uppercase tracking-widest hover:bg-indigo-900 transition-all shadow-md rounded-sm">
                Save and Publish
            </button>
        </div>
    </form>
</div>
@endsection