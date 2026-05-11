@extends('layouts.admin')

@section('title', 'Edit Video')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Video Link</h1>
            <p class="text-sm text-slate-500">Update the YouTube URL or details</p>
        </div>
        <a href="{{ route('videos.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form action="{{ route('videos.update', $video->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2 tracking-widest">Video Title</label>
                <input type="text" name="title" value="{{ old('title', $video->title) }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2 tracking-widest">YouTube URL</label>
                <input type="url" name="video_url" value="{{ old('video_url', $video->video_url) }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2 tracking-widest">Description</label>
                <textarea name="description" rows="4" 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none">{{ old('description', $video->description) }}</textarea>
            </div>

            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-[#302171] text-white font-bold py-4 rounded-xl hover:bg-indigo-900 transition-all flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-check mr-2"></i> Update Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection