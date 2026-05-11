@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-black text-[#1d0647] uppercase border-l-4 border-yellow-500 pl-4 mb-10">Video <span class="text-yellow-500">Gallery</span></h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($videos as $video)
            <div class="bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm hover:shadow-lg transition-all">
                <div class="aspect-video bg-black">
                    <video class="w-full h-full" controls preload="metadata" controlsList="nodownload">
                        <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-[#1d0647] mb-2 uppercase tracking-tight">{{ $video->title }}</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">{{ $video->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection