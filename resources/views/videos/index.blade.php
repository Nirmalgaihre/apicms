@extends('layouts.app') {{-- Change this to match your public layout name --}}
@section('title', 'Video Gallery | Watch API in Action')
@section('meta_description', 'Watch videos from Annapurna Polytechnic Institute. View our technical workshops, event recordings, and campus tours for Plant and Animals Science.')
@section('meta_author', 'Nirmal Gaihre')
@section('meta_keywords', 'API Videos, Polytechnic Workshops Video, Annapurna Institute YouTube, Technical Training Nepal')
@section('content')
<div class="bg-[#302171] py-16 md:py-24 mb-12 relative overflow-hidden">
    <div class="absolute top-0 right-0 p-20 opacity-10">
        <i class="fa-solid fa-play text-white text-9xl"></i>
    </div>
    <div class="max-w-[1400px] mx-auto px-6 text-center relative z-10">
        <h1 class="text-3xl md:text-5xl font-black text-white mb-4 uppercase tracking-tighter">Video Gallery</h1>
        <div class="flex justify-center items-center gap-3">
            <span class="h-1 w-12 bg-[#FF8A65] rounded-full"></span>
            <p class="text-white/80 font-bold text-xs md:text-sm uppercase tracking-[0.2em]">Visual Highlights of API</p>
            <span class="h-1 w-12 bg-[#FF8A65] rounded-full"></span>
        </div>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-6 pb-24">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
        @forelse($videos as $video)
            <div class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100 flex flex-col h-full">
                
                <div class="relative aspect-video bg-black overflow-hidden">
                    <video class="w-full h-full object-cover" controls preload="metadata">
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <div class="p-8 flex flex-col flex-1">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 bg-[#302171]/5 text-[#302171] text-[10px] font-black uppercase tracking-widest rounded-lg">
                            Campus Media
                        </span>
                        <span class="text-slate-400 text-[11px] font-bold">
                            <i class="fa-regular fa-calendar-days mr-1 text-[#FF8A65]"></i>
                            {{ $video->created_at->format('M d, Y') }}
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-[#302171] leading-tight mb-3 group-hover:text-[#FF8A65] transition-colors">
                        {{ $video->title }}
                    </h3>
                    
                    @if($video->description)
                        <p class="text-slate-500 text-sm font-medium leading-relaxed line-clamp-3">
                            {{ $video->description }}
                        </p>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-32 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <div class="w-24 h-24 bg-white shadow-xl rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-clapperboard text-[#302171] text-3xl opacity-20"></i>
                </div>
                <h3 class="text-2xl font-black text-[#302171] uppercase tracking-tighter">No Videos Yet</h3>
                <p class="text-slate-500 font-bold text-sm mt-2 uppercase tracking-widest">We are currently recording fresh content!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection