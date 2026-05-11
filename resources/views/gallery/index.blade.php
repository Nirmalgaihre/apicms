@extends('layouts.app')

@section('title', 'Photo Gallery | Annapurna Polytechnic Institute')

@section('meta_description', 'Explore campus life at Annapurna Polytechnic Institute. Browse our photo gallery featuring facilities, student labs, and events in Kahundanda, Kaski.')
@section('meta_author', 'Nirmal Gaihre')

@section('content')
<style>
    [x-cloak] { display: none !important; }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    .animate-shimmer {
        background: linear-gradient(90deg, #f1f5f9 25%, #f8fafc 50%, #f1f5f9 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite linear;
    }
</style>

<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- Page Header --}}
        <div class="mb-12">
            <h1 class="text-3xl font-black text-[#1e1b4b] uppercase tracking-tight">Photo Gallery</h1>
            <p class="text-slate-500 mt-2">Memories and events at Annapurna Polytechnic Institute</p>
            <div class="h-1 w-16 bg-[#004a99] mt-4"></div>
        </div>

        {{-- Gallery Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($galleries as $gallery)
                <a href="{{ route('public.gallery.show', $gallery->id) }}" 
                   class="group" 
                   x-data="{ loaded: false }">
                    
                    <div class="bg-white p-3 rounded-2xl shadow-sm group-hover:shadow-xl transition-all duration-300 border border-slate-100">
                        
                        {{-- Image Container --}}
                        <div class="aspect-video rounded-xl overflow-hidden bg-slate-200 relative">
                            
                            {{-- Skeleton Loader --}}
                            <div x-show="!loaded" 
                                 class="absolute inset-0 animate-shimmer">
                            </div>

                            @if($gallery->images->first())
                                <img src="{{ asset('storage/' . $gallery->images->first()->image_path) }}" 
                                     @load="loaded = true"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     :class="loaded ? 'opacity-100' : 'opacity-0'"
                                     style="transition: opacity 0.4s ease-in-out;"
                                     alt="{{ $gallery->title }}">
                            @endif
                            
                            {{-- Photo Count Badge --}}
                            <div class="absolute top-3 right-3 bg-[#004a99]/80 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full border border-white/20"
                                 x-show="loaded" x-cloak>
                                <i class="fa-solid fa-camera mr-1"></i>
                                {{ $gallery->images->count() }}+ Photos
                            </div>
                        </div>

                        {{-- Gallery Info --}}
                        <div class="mt-4 px-2 pb-2">
                            {{-- Text Skeletons --}}
                            <div x-show="!loaded" class="space-y-3">
                                <div class="h-5 bg-slate-100 rounded w-5/6 animate-pulse"></div>
                                <div class="h-3 bg-slate-100 rounded w-1/3 animate-pulse"></div>
                            </div>

                            {{-- Real Content --}}
                            <div x-show="loaded" x-cloak>
                                <h2 class="text-lg font-bold text-slate-800 uppercase tracking-tight group-hover:text-[#004a99] transition-colors">
                                    {{ $gallery->title }}
                                </h2>
                                <div class="flex items-center gap-2 mt-1">
                                    <i class="fa-regular fa-calendar text-slate-400 text-[10px]"></i>
                                    <p class="text-slate-400 text-xs font-medium">
                                        {{ $gallery->created_at->format('F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Empty State --}}
        @if($galleries->isEmpty())
            <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                <i class="fa-solid fa-images text-slate-200 text-6xl mb-4"></i>
                <p class="text-slate-400 font-medium">No gallery albums found.</p>
            </div>
        @endif

    </div>
</div>
@endsection