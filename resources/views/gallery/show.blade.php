@extends('layouts.app')

@section('title', $gallery->title . ' - Annapurna Polytechnic Institute')

@section('meta_description', Str::limit($gallery->description ?? 'View our photo gallery at Annapurna Polytechnic Institute, Kaski.', 150))

@section('meta_keywords', 'Annapurna Polytechnic Institute, API Gallery, Kaski Technical School, ' . $gallery->title)

@push('meta_tags')
    @php
        // Use the first image of the gallery as the meta image, or a default if empty
        $firstImage = $gallery->images->first();
        $metaImageUrl = $firstImage 
            ? asset('storage/' . $firstImage->image_path) 
            : asset('assets/img/484148101_966497299002090_7946760972799036593_n.jpg');
    @endphp

    {{-- Social Media Meta Tags --}}
    <meta property="og:title" content="{{ $gallery->title }} | API Gallery" />
    <meta property="og:description" content="{{ Str::limit($gallery->description, 100) }}" />
    <meta property="og:image" content="{{ $metaImageUrl }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $gallery->title }}">
    <meta name="twitter:description" content="{{ Str::limit($gallery->description, 100) }}">
    <meta name="twitter:image" content="{{ $metaImageUrl }}">
@endpush

@section('scripts')
    {{-- Alpine.js is required for the Skeleton and Popup logic --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')
{{-- 
    Main Wrapper 
    open: controls popup visibility
    activeImage: stores the URL of the image to show in popup
--}}
<div class="bg-slate-50 min-h-screen py-16" x-data="{ open: false, activeImage: '' }">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- Breadcrumb / Back --}}
        <a href="{{ route('public.gallery.index') }}" class="inline-flex items-center text-blue-600 font-bold text-xs uppercase tracking-widest hover:text-blue-800 transition mb-6">
            <span class="mr-2">←</span> Back to Gallery
        </a>

        <header class="mb-12">
            <h1 class="text-4xl font-black text-slate-900 uppercase tracking-tight mb-4">
                {{ $gallery->title }}
            </h1>
            @if($gallery->description)
                <p class="text-slate-600 max-w-3xl text-lg leading-relaxed">
                    {{ $gallery->description }}
                </p>
            @endif
        </header>

        {{-- Gallery Grid --}}
        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
            @forelse($gallery->images as $image)
                @php $fullImageUrl = asset('storage/' . $image->image_path); @endphp
                
                {{-- Individual Image Card --}}
                <div class="break-inside-avoid" 
                     x-data="{ loaded: false }" 
                     x-init="if ($refs.img.complete) loaded = true">
                    
                    <div 
                        class="relative group cursor-zoom-in rounded-2xl overflow-hidden bg-slate-200 border border-slate-200 shadow-sm transition-all duration-300 hover:shadow-xl"
                        @click="open = true; activeImage = '{{ $fullImageUrl }}'"
                    >
                        {{-- 1. Skeleton Loader --}}
                        <div 
                            x-show="!loaded" 
                            class="w-full bg-slate-300 animate-shimmer"
                            style="height: 300px;"
                        ></div>

                        {{-- 2. Actual Image --}}
                        <img 
                            x-ref="img"
                            src="{{ $fullImageUrl }}" 
                            alt="{{ $gallery->title }}"
                            class="w-full h-auto block transition-all duration-700 ease-out group-hover:scale-105"
                            :class="loaded ? 'opacity-100' : 'opacity-0 absolute inset-0'"
                            @load="loaded = true"
                        >

                        {{-- Hover Effect Overlay --}}
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center border-2 border-dashed border-slate-200 rounded-3xl">
                    <p class="text-slate-400 font-medium italic">No photos available in this album.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- --- LIGHTBOX MODAL --- --}}
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/95 p-4"
        @keydown.escape.window="open = false"
        x-cloak
    >
        {{-- Close Button --}}
        <button @click="open = false" class="absolute top-6 right-6 text-white/50 hover:text-white text-5xl font-thin z-[110]">&times;</button>

        {{-- Popup Image Container --}}
        <div class="relative max-w-5xl w-full flex items-center justify-center" @click.away="open = false">
            <img 
                :src="activeImage" 
                class="max-w-full max-h-[90vh] rounded-lg shadow-2xl object-contain"
                x-show="open"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="scale-95"
                x-transition:enter-end="scale-100"
            >
        </div>
    </div>
</div>

<style>
    /* Prevent flickering before Alpine.js initializes */
    [x-cloak] { display: none !important; }

    /* Moving Shimmer Effect */
    .animate-shimmer {
        background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
        background-size: 200% 100%;
        animation: shimmer-animation 1.5s infinite linear;
    }

    @keyframes shimmer-animation {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
</style>
@endsection