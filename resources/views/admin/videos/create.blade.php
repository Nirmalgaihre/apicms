@extends('layouts.admin')

@section('title', 'Add Video')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Add YouTube Video</h1>
            <p class="text-sm text-slate-500">Add a YouTube link to the institute gallery</p>
        </div>
        <a href="{{ route('videos.index') }}" class="flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to Gallery
        </a>
    </div>

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
        <i class="fa-solid fa-circle-exclamation mr-2"></i> {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form action="{{ route('videos.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2 tracking-widest">Video Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                    placeholder="Enter video title">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2 tracking-widest">YouTube URL</label>
                <input type="url" name="video_url" value="{{ old('video_url') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                    placeholder="https://www.youtube.com/watch?v=...">
                <p class="text-[10px] text-slate-400 mt-2 italic">Copy the full link from your browser address bar.</p>
                @error('video_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2 tracking-widest">Description (Optional)</label>
                <textarea name="description" rows="4" 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                    placeholder="Provide some context...">{{ old('description') }}</textarea>
            </div>

            <div class="pt-4 flex items-center space-x-4">
                <button type="submit" 
                        class="flex-1 bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-link mr-2"></i> Save to Gallery
                </button>
                <a href="{{ route('videos.index') }}" class="px-8 py-4 text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection