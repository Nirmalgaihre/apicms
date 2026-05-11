@extends('layouts.app')
@section('title', $post->title)
@section('meta_description', Str::limit(strip_tags($post->description), 155))
@section('meta_author', 'Nirmal Gaihre')

@section('scripts')
    {{-- Alpine.js for skeletons and popup --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')
{{-- wrapper with popup state --}}
<div class="max-w-4xl mx-auto px-6 py-12" x-data="{ open: false, activeImage: '' }">
    <a href="{{ route('public.blog.index') }}" class="text-sm font-bold text-slate-400 hover:text-[#FF8A65] uppercase tracking-widest">← Back to Blog</a>
    
    <h1 class="text-4xl font-black text-[#1e1b4b] mt-6 mb-8">{{ $post->title }}</h1>

    {{-- Main Thumbnail with Skeleton --}}
    @if($post->thumbnail)
        @php $thumbUrl = asset('storage/' . $post->thumbnail); @endphp
        <div class="relative w-full mb-10 overflow-hidden rounded-2xl shadow-xl bg-slate-200" 
             x-data="{ loaded: false }" 
             x-init="if ($refs.thumb.complete) loaded = true">
            
            <div x-show="!loaded" class="w-full h-64 md:h-96 animate-shimmer bg-slate-300"></div>

            <img 
                x-ref="thumb"
                src="{{ $thumbUrl }}" 
                @load="loaded = true"
                @click="open = true; activeImage = '{{ $thumbUrl }}'"
                class="w-full h-auto cursor-zoom-in transition-opacity duration-500"
                :class="loaded ? 'opacity-100' : 'opacity-0 absolute inset-0'"
            >
        </div>
    @endif

    <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed">
        {!! htmlspecialchars_decode($post->description) !!}
    </div>

    {{-- Related Photos with Skeletons --}}
    @if($post->images->count() > 0)
        <div class="mt-16 pt-10 border-t">
            <h3 class="font-bold text-slate-800 uppercase mb-6">Related Photos</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($post->images as $img)
                    @php $relatedUrl = asset('storage/' . $img->image_path); @endphp
                    <div class="relative overflow-hidden rounded-lg border bg-slate-100" 
                         x-data="{ loaded: false }" 
                         x-init="if ($refs.relImg.complete) loaded = true">
                        
                        <div x-show="!loaded" class="aspect-square animate-shimmer bg-slate-200"></div>

                        <img 
                            x-ref="relImg"
                            src="{{ $relatedUrl }}" 
                            @load="loaded = true"
                            @click="open = true; activeImage = '{{ $relatedUrl }}'"
                            class="aspect-square object-cover w-full cursor-zoom-in transition-opacity duration-500 hover:scale-105"
                            :class="loaded ? 'opacity-100' : 'opacity-0 absolute inset-0'"
                        >
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- --- LIGHTBOX POPUP --- --}}
    <div 
        x-show="open" 
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 p-4"
        @keydown.escape.window="open = false"
        x-cloak
    >
        <button @click="open = false" class="absolute top-6 right-6 text-white/70 hover:text-white text-5xl font-thin">&times;</button>
        <div class="max-w-5xl w-full flex justify-center" @click.away="open = false">
            <img :src="activeImage" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl object-contain">
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    
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