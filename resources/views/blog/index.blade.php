@extends('layouts.app')
@section('title', 'Blog - Latest Post')
@section('meta_description', 'Stay updated with the latest blog posts and articles from Nirmal Gaihre.')
@section('meta_author', 'Nirmal Gaihre')

@section('scripts')
    {{-- Alpine.js for skeleton logic --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-black text-[#1e1b4b] uppercase mb-10 border-b pb-4">Latest Blog Posts</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
            <div class="border rounded-xl overflow-hidden bg-white hover:shadow-lg transition flex flex-col">
                
                {{-- Image / Skeleton Container --}}
                <div class="relative aspect-video bg-slate-100 overflow-hidden" 
                     x-data="{ loaded: false }" 
                     x-init="if ($refs.thumb.complete) loaded = true">
                    
                    <a href="{{ route('public.blog.show', $post->slug) }}" class="block w-full h-full">
                        @if($post->thumbnail)
                            {{-- 1. Skeleton --}}
                            <div x-show="!loaded" class="absolute inset-0 animate-shimmer bg-slate-200"></div>

                            {{-- 2. Actual Image --}}
                            <img 
                                x-ref="thumb"
                                src="{{ asset('storage/' . $post->thumbnail) }}" 
                                @load="loaded = true"
                                class="w-full h-full object-cover transition-opacity duration-500"
                                :class="loaded ? 'opacity-100' : 'opacity-0'"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <span class="text-xs font-bold uppercase tracking-widest">No Image</span>
                            </div>
                        @endif
                    </a>
                </div>

                {{-- Content --}}
                <div class="p-5 flex-grow">
                    <p class="text-[10px] font-bold text-[#FF8A65] uppercase mb-2">
                        {{ $post->created_at->format('M d, Y') }}
                    </p>
                    <h2 class="text-xl font-bold text-slate-800 leading-tight">
                        <a href="{{ route('public.blog.show', $post->slug) }}" class="hover:text-[#302171]">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="mt-3 text-slate-500 text-sm line-clamp-2">
                        {{ strip_tags($post->description) }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</div>

<style>
    /* Custom Moving Shimmer Effect */
    .animate-shimmer {
        background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
        background-size: 200% 100%;
        animation: shimmer-animation 1.5s infinite linear;
    }

    @keyframes shimmer-animation {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
</style>
@endsection