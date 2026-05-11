@extends('layouts.app')

@section('title', 'Video Gallery')

@section('content')
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-12 border-l-4 border-yellow-500 pl-6">
            <h1 class="text-4xl font-black text-[#1d0647] uppercase tracking-tight">
                Video <span class="text-yellow-500">Gallery</span>
            </h1>
            <p class="text-slate-500 mt-2 font-medium">Watch our latest programs, event highlights, and tutorials.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($videos as $video)
            <div class="bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="aspect-video bg-black">
                    <iframe 
                        class="w-full h-full" 
                        src="{{ $video->video_url }}" 
                        title="{{ $video->title }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-[#1d0647] mb-3 leading-tight">
                        {{ $video->title }}
                    </h3>
                    @if($video->description)
                    <p class="text-slate-600 text-sm leading-relaxed line-clamp-2">
                        {{ $video->description }}
                    </p>
                    @endif
                </div>
                
                <div class="px-6 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        <i class="fa-solid fa-play mr-1 text-yellow-500"></i> Video Content
                    </span>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-white border border-dashed border-slate-300 rounded-sm">
                <i class="fa-solid fa-video-slash text-4xl text-slate-200 mb-4"></i>
                <p class="text-slate-500 font-medium">No videos have been uploaded yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection