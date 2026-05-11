@extends('layouts.app')

@section('title', 'Annapurna Polytechnic Institute | Kahundanda, Kaski')

@section('meta_description', 'Welcome to API. We offer Diploma programs in Plant Science and Animal Science. Explore our faculty, principal’s message, and latest notices.')

@section('meta_keywords', 'Annapurna Polytechnic Institute, API Kaski, Plant Science, Animal Science, Technical School Nepal')

@section('content')

{{-- ── TICKER BAR ── --}}
<div class="bg-[#1e1b4b] py-3 border-b border-white/10 relative z-40 shadow-xl">
    <div class="max-w-7xl mx-auto px-6 flex items-center">
        <div
            class="bg-[#FF8A65] text-white text-[10px] font-black px-4 py-1.5 uppercase tracking-[0.2em] mr-6 flex-shrink-0 flex items-center shadow-lg">
            <span class="relative flex h-2 w-2 mr-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
            </span>
            Latest Updates
        </div>

        <marquee class="flex-1 text-white font-black uppercase tracking-widest text-sm" onmouseover="this.stop();"
            onmouseout="this.start();">
            @forelse($notices as $notice)
            <a href="{{ route('notices.show', $notice->id) }}"
                class="mx-12 inline-flex items-center gap-3 hover:text-[#FF8A65] transition-colors">
                <img src="{{ asset('assets/img/new_blink_icon.gif') }}" alt="NEW" class="h-5 w-auto flex-shrink-0">
                <span class="whitespace-nowrap">{{ $notice->title }}</span>
            </a>
            @empty
            <span class="mx-12">Welcome to Annapurna Polytechnic Institute</span>
            @endforelse
        </marquee>
    </div>
</div>

{{-- ── SEQUENTIAL DOCUMENT VIEWER ── --}}
@php
$docs = DB::table('resources')->orderBy('id', 'desc')->take(5)->get();
@endphp

@if($docs->count() > 0)
<div x-data="{ 
        currentIndex: 0, 
        total: {{ $docs->count() }},
        docs: {{ $docs->toJson() }},
        show: true,
        closeAll() {
            this.show = false;
        }
     }" x-show="show" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">

    {{-- Backdrop - Clicking this or the X closes EVERYTHING --}}
    <div class="fixed inset-0 bg-[#1e1b4b]/95 backdrop-blur-md" @click="closeAll()"></div>

    {{-- Modal Box --}}
    <div
        class="relative bg-white w-full max-w-4xl h-[90vh] rounded-[40px] shadow-2xl overflow-hidden flex flex-col animate-in fade-in zoom-in duration-300">

        {{-- Header --}}
        <div class="p-5 bg-white border-b flex items-center justify-between px-8">
            <div class="flex items-center gap-4">
                <span
                    class="text-[10px] font-black bg-[#FF8A65] text-white px-3 py-1 rounded-full uppercase tracking-widest">
                    Update <span x-text="currentIndex + 1"></span> / <span x-text="total"></span>
                </span>
                <template x-if="docs[currentIndex]">
                    <h3 class="text-sm font-black text-[#1e1b4b] uppercase tracking-tight truncate max-w-md"
                        x-text="docs[currentIndex].title"></h3>
                </template>
            </div>
            {{-- Close Button: This stops everything immediately --}}
            <button @click="closeAll()" class="text-slate-300 hover:text-red-500 transition-colors group">
                <span
                    class="text-[10px] font-black uppercase mr-2 opacity-0 group-hover:opacity-100 transition-opacity">Close
                    All</span>
                <i class="fa-solid fa-circle-xmark text-3xl"></i>
            </button>
        </div>

        {{-- Scrollable Content Wrapper --}}
        <div class="flex-1 overflow-y-auto bg-slate-50">

            {{-- Description Section --}}
            <div class="p-8 bg-white">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Description</h4>
                <p class="text-sm text-slate-600 leading-relaxed italic"
                    x-text="docs[currentIndex].description || 'No description available.'"></p>
            </div>

            {{-- Document Viewer Area --}}
            <div class="p-6">
                <div
                    class="bg-white rounded-[32px] overflow-hidden shadow-sm border border-slate-200 h-[600px] relative">
                    <template x-if="docs[currentIndex]">
                        <div class="w-full h-full">
                            {{-- Image Logic --}}
                            <template
                                x-if="['jpg', 'jpeg', 'png', 'webp'].includes(docs[currentIndex].file_path.split('.').pop().toLowerCase())">
                                <div class="w-full h-full flex items-center justify-center p-4">
                                    <img :src="'/storage/' + docs[currentIndex].file_path"
                                        class="max-w-full max-h-full object-contain">
                                </div>
                            </template>

                            {{-- PDF Logic --}}
                            <template x-if="docs[currentIndex].file_path.split('.').pop().toLowerCase() === 'pdf'">
                                <iframe :src="'/storage/' + docs[currentIndex].file_path + '#toolbar=0'"
                                    class="w-full h-full" frameborder="0"></iframe>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Footer Controls --}}
        <div class="p-6 bg-white border-t border-slate-100 flex items-center justify-between px-8">
            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">API Technical Hub • 2026</p>

            <div class="flex gap-3">
                {{-- Show "Next" if not at the end --}}
                <template x-if="currentIndex < total - 1">
                    <button @click="currentIndex++"
                        class="bg-[#003366] text-white px-8 py-4 rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-[#FF8A65] transition-all shadow-lg flex items-center gap-3">
                        Read Next <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </template>

                {{-- Show "Close All" only on the last item --}}
                <template x-if="currentIndex === total - 1">
                    <button @click="closeAll()"
                        class="bg-red-600 text-white px-10 py-4 rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-black transition-all shadow-lg flex items-center gap-3">
                        Finish & Close All <i class="fa-solid fa-check-double"></i>
                    </button>
                </template>
            </div>
        </div>
    </div>
</div>
@endif

<style>
[x-cloak] {
    display: none !important;
}

/* Scrollbar for the inner content */
.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}
</style>
{{-- ── 2. HERO SECTION ── --}}
<section class="relative min-h-[85vh] flex flex-col justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/img/488801969_1128249509344900_3336773468329021175_n.jpg') }}" alt="Students"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-[#013e37]/70"></div>
    </div>

    <div class="relative z-10 max-w-[1440px] mx-auto px-6 lg:px-20 w-full pt-20 pb-32">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <span class="text-white font-bold text-sm tracking-[0.2em] uppercase">Welcome to Annapurna</span>
                <div class="w-12 h-[2px] bg-[#FF8A65]"></div>
            </div>

            <h2 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-5">
                Start Your Technical Journey with <span class="text-[#FF8A65]">CTEVT</span>
            </h2>

            <p class="text-white/75 text-lg max-w-2xl mb-8 leading-relaxed">
                Get hands-on learning and practical knowledge that helps you grow your skills and build a successful
                career.
            </p>

            <div class="flex flex-wrap gap-5">
                <a href="#programs"
                    class="px-8 py-4 bg-[#FF8A65] text-white font-black text-sm uppercase tracking-widest flex items-center gap-2 hover:bg-white hover:text-[#013e37] transition-all">
                    Discover More <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="/contact"
                    class="px-8 py-4 border border-white/30 text-white font-black text-sm uppercase tracking-widest flex items-center gap-2 hover:bg-white hover:text-[#013e37] transition-all">
                            Get in Touch<i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Bottom Hero Features --}}
    <div class="relative z-20 w-full mt-auto">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-20 grid grid-cols-1 md:grid-cols-3">
            <div
                class="bg-[#4b0082] p-8 lg:p-12 text-white border-r border-white/10 flex items-start gap-5 group hover:bg-[#025249] transition-all">
                <div class="text-4xl text-white/50 group-hover:text-[#FF8A65] transition-colors"><i
                        class="fa-solid fa-book-open-reader"></i></div>
                <div>
                    <h4 class="text-xl font-bold mb-3 uppercase tracking-tight">Education Services</h4>
                    <p class="text-white/60 text-sm leading-relaxed">Quality intellectual capital through superior
                        technical collaboration.</p>
                </div>
            </div>
            <div class="bg-[#FF8A65] p-8 lg:p-12 text-white flex items-start gap-5 group shadow-2xl">
                <div class="text-4xl text-white/50"><i class="fa-solid fa-earth-asia"></i></div>
                <div>
                    <h4 class="text-xl font-bold mb-3 uppercase tracking-tight">Technical Hub</h4>
                    <p class="text-white/90 text-sm leading-relaxed">A central point for vocational excellence and
                        industry-ready skills.</p>
                </div>
            </div>
            <div
                class="bg-[#013e37] p-8 lg:p-12 text-white border-l border-white/10 flex items-start gap-5 group hover:bg-[#025249] transition-all">
                <div class="text-4xl text-white/50 group-hover:text-[#FF8A65] transition-colors"><i
                        class="fa-solid fa-certificate"></i></div>
                <div>
                    <h4 class="text-xl font-bold mb-3 uppercase tracking-tight">Diploma Programs</h4>
                    <p class="text-white/60 text-sm leading-relaxed">Comprehensive curriculum recognized by CTEVT and
                        industry partners.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- REDESIGNED PRINCIPAL MESSAGE --}}
<section id="message" class="py-24 bg-slate-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-amber-100 rounded-full blur-3xl opacity-50 -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50 -ml-48 -mb-48"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20 items-center">

            <div class="lg:col-span-5">
                <div class="relative">
                    <div class="aspect-[3/4] rounded-[2rem] overflow-hidden shadow-2xl relative group">
                        @if($principal && $principal->staff_img)
                        <img src="{{ asset('storage/' . $principal->staff_img) }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Principal">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-indigo-900 text-indigo-200">
                            <span>Photo Unavailable</span>
                        </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-indigo-900/40 to-transparent"></div>
                    </div>

                    <div
                        class="absolute -bottom-6 -right-6 md:right-10 bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white max-w-xs">
                        <h4 class="text-xl font-bold text-indigo-950 leading-tight">
                            {{ $principal->staff_name ?? 'Principal Name' }}
                        </h4>
                        <p class="text-amber-600 font-bold text-xs uppercase tracking-widest mt-1">Principal Executive
                        </p>
                    </div>

                    <div
                        class="absolute -top-6 -left-6 w-32 h-32 border-l-4 border-t-4 border-amber-400 rounded-tl-3xl -z-10">
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="relative">
                    <div class="absolute -top-12 -left-8 text-indigo-100 opacity-50 select-none">
                        <svg width="120" height="120" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 7.55228 14.017 7V5C14.017 4.44772 14.4647 4 15.017 4H19.017C20.6739 4 22.017 5.34315 22.017 7V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM2.017 21L2.017 18C2.017 16.8954 2.91239 16 4.017 16H7.017C7.56928 16 8.017 15.5523 8.017 15V9C8.017 8.44772 7.56928 8 7.017 8H3.017C2.46472 8 2.017 7.55228 2.017 7V5C2.017 4.44772 2.46472 4 3.017 4H7.017C8.67386 4 10.017 5.34315 10.017 7V15C10.017 18.3137 7.33071 21 4.017 21H2.017Z" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <span
                            class="inline-block py-1 px-3 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                            Message
                        </span>

                        <h2
                            class="text-4xl md:text-6xl font-extrabold text-indigo-950 tracking-tight leading-[1.1] mb-8">
                            Message from <br>
                            <span class="text-amber-500">Principal.</span>
                        </h2>

                        <div class="prose prose-lg prose-indigo text-slate-600 leading-relaxed max-w-none">
                            <div
                                class="first-letter:text-5xl first-letter:font-bold first-letter:text-indigo-900 first-letter:mr-3 first-letter:float-left">
                                {!! htmlspecialchars_decode($principalMessage->description ?? 'Welcome to Annapurna
                                Polytechnic Institute. Our mission is to bridge the gap between theoretical knowledge
                                and industrial application, ensuring our students are prepared for the challenges of
                                tomorrow.') !!}
                            </div>
                        </div>

                        <div class="mt-12 flex items-center gap-6">
                            <div class="h-[2px] w-12 bg-amber-400"></div>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Office of the
                                Principal</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── 10. CTA BANNER ── --}}
<section class="bg-[#3b0458] py-20 relative overflow-hidden">
    <div class="absolute right-0 top-0 w-1/3 h-full bg-[#FF8A65] skew-x-12 translate-x-20 opacity-10"></div>
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-10">
        <h2 class="text-white text-3xl md:text-4xl font-black uppercase tracking-tighter text-center md:text-left">Ready
            to build your career?</h2>
        <div class="flex gap-4">
            <a href="https://forms.gle/3osJxRicNEhZTScaA" target="_blank"
                class="px-8 py-4 bg-[#FF8A65] text-white font-black text-xs uppercase tracking-widest hover:scale-105 transition-transform shadow-xl">Apply
                Now</a>
            <a href="/downloads"
                class="px-8 py-4 bg-white/10 text-white font-black text-xs uppercase tracking-widest hover:bg-white/20">Syllabus</a>
        </div>
    </div>
</section>



{{-- GALLERY --}}
<section class="py-24 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-black text-[#1e1b4b] uppercase tracking-tighter">Campus Gallery</h2>
            <div class="h-1 w-20 bg-[#FF8A65] mx-auto mt-6"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($galleries as $gallery)
            <a href="{{ route('public.gallery.show', $gallery->id) }}"
                class="relative group aspect-square rounded-2xl overflow-hidden bg-[#1e1b4b]">
                @if(isset($gallery->first_image) && $gallery->first_image)
                <img src="{{ asset('storage/' . $gallery->first_image) }}"
                    class="w-full h-full object-cover opacity-80 group-hover:opacity-40 group-hover:scale-110 transition-all duration-700">
                @else
                <div
                    class="w-full h-full flex items-center justify-center bg-slate-800 text-white/20 text-[10px] uppercase font-bold">
                    No Preview</div>
                @endif
                <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center">
                    <h4
                        class="text-white font-black text-xs md:text-sm uppercase tracking-tighter opacity-0 group-hover:opacity-100 transition-all transform translate-y-4 group-hover:translate-y-0">
                        {{ $gallery->title }}</h4>
                    <span
                        class="text-[#FF8A65] text-[9px] font-bold mt-2 opacity-0 group-hover:opacity-100 uppercase tracking-widest">View
                        Album</span>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-16 text-center">
            <a href="{{ route('public.gallery.index') }}"
                class="inline-block px-12 py-4 border-2 border-[#1e1b4b] text-[#1e1b4b] font-black text-xs uppercase tracking-[0.2em] hover:bg-[#1e1b4b] hover:text-white transition-all">
                Explore Full Media Library
            </a>
        </div>
    </div>
</section>

{{-- ============================================================================
    REDESIGNED INFORMATION HUB - ACADEMIC DASHBOARD STYLE
    ============================================================================ --}}
<section class="py-20 bg-[#f8fafc] relative overflow-hidden">
    {{-- Soft Decorative Blobs --}}
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-50 rounded-full blur-[120px] -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 relative">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

            {{-- ====== COLUMN 1: LATEST STORIES (BLOG) ====== --}}
            <div class="group/col">
                <div class="flex items-end justify-between mb-8 border-b-2 border-slate-200 pb-4">
                    <div>
                        <span class="text-amber-600 font-bold text-[10px] uppercase tracking-[0.2em] block mb-1">Campus
                            Life</span>
                        <h3 class="text-3xl font-black text-indigo-950 tracking-tighter uppercase">Insights</h3>
                    </div>
                    <a href="{{ route('public.blog.index') }}"
                        class="group flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-amber-600 transition-colors uppercase tracking-widest">
                        View All
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="space-y-6">
                    @forelse($blogs->take(2) as $index => $post)
                    <a href="{{ route('public.blog.show', $post->slug) }}"
                        class="group block relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                        <div class="aspect-[16/10] overflow-hidden">
                            <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700">
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-indigo-950 via-indigo-950/20 to-transparent opacity-90">
                        </div>
                        <div class="absolute bottom-0 p-6">
                            <span
                                class="text-amber-400 text-[10px] font-black uppercase tracking-widest mb-2 block">{{ date('M d, Y', strtotime($post->created_at)) }}</span>
                            <h4
                                class="text-white font-bold text-lg leading-tight line-clamp-2 group-hover:text-amber-200 transition-colors">
                                {{ $post->title }}
                            </h4>
                        </div>
                    </a>
                    @empty
                    {{-- Empty State --}}
                    <div class="py-12 px-6 bg-white rounded-2xl border-2 border-dashed border-slate-200 text-center">
                        <p class="text-slate-400 font-bold text-xs uppercase">No stories found</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ====== COLUMN 2: OFFICIAL NOTICES ====== --}}
            <div>
                <div class="flex items-end justify-between mb-8 border-b-2 border-slate-200 pb-4">
                    <div>
                        <span class="text-blue-600 font-bold text-[10px] uppercase tracking-[0.2em] block mb-1">Stay
                            Updated</span>
                        <h3 class="text-3xl font-black text-indigo-950 tracking-tighter uppercase">Notices</h3>
                    </div>
                    <a href="{{ route('notices.all') }}"
                        class="group flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-blue-600 transition-colors uppercase tracking-widest">
                        Archive
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($notices as $notice)
                    <div
                        class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 hover:border-blue-200 hover:shadow-md transition-all duration-300 group">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 text-center">
                                <span
                                    class="block text-xl font-black text-blue-600 leading-none">{{ date('d', strtotime($notice->created_at)) }}</span>
                                <span
                                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ date('M', strtotime($notice->created_at)) }}</span>
                            </div>
                            <div class="h-10 w-[1px] bg-slate-100"></div>
                            <div class="flex-1">
                                <h4
                                    class="text-sm font-bold text-indigo-950 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors cursor-pointer">
                                    {{ $notice->title }}
                                </h4>
                                <p class="text-[10px] text-slate-400 mt-1 font-medium italic">
                                    {{ \Carbon\Carbon::parse($notice->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-12 px-6 bg-white rounded-2xl border-2 border-dashed border-slate-200 text-center">
                        <p class="text-slate-400 font-bold text-xs uppercase">All clear!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ====== COLUMN 3: RESOURCES (DOWNLOADS) ====== --}}
            <div>
                <div class="flex items-end justify-between mb-8 border-b-2 border-slate-200 pb-4">
                    <div>
                        <span
                            class="text-emerald-600 font-bold text-[10px] uppercase tracking-[0.2em] block mb-1">Knowledge
                            Base</span>
                        <h3 class="text-3xl font-black text-indigo-950 tracking-tighter uppercase">Resources</h3>
                    </div>
                    <a href="{{ route('publications.all') }}"
                        class="group flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-emerald-600 transition-colors uppercase tracking-widest">
                        More
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="bg-white rounded-2xl p-2 shadow-sm border border-slate-100">
                    @forelse($publications->take(6) as $item)
                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                        class="flex items-center gap-4 p-3 hover:bg-emerald-50 rounded-xl transition-colors group">
                        <div
                            class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center group-hover:bg-white group-hover:shadow-sm transition-all">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h5
                                class="text-xs font-bold text-indigo-950 truncate tracking-tight group-hover:text-emerald-700">
                                {{ $item->title }}
                            </h5>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">
                                PDF &bull; {{ number_format($item->file_size / 1024, 0) }} KB
                            </span>
                        </div>
                    </a>
                    @empty
                    <div class="py-12 text-center">
                        <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">No resources</p>
                    </div>
                    @endforelse
                </div>

                {{-- Quick Contact/Support Link --}}
                <div class="mt-6 p-4 bg-indigo-950 rounded-2xl relative overflow-hidden group cursor-pointer">
                    <div class="relative z-10">
                        <h5 class="text-white text-sm font-bold">Need Help?</h5>
                        <p class="text-indigo-300 text-[11px] mt-1">Contact the administration for academic inquiries.
                        </p>
                    </div>
                    <div
                        class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
                        <svg width="80" height="80" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- ============================================================================
    CUSTOM CSS ANIMATIONS & STYLES
    ============================================================================ --}}
<style>
/* Fade In Up Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

.transition-transform {
    transition-property: transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

.transition-colors {
    transition-property: color, background-color, border-color;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

/* No hover color change, just scale animations */
a {
    text-decoration: none;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Remove button focus outline */
button:focus,
a:focus {
    outline: none;
}

/* Enhanced line clamp */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .grid.grid-cols-1.md\:grid-cols-3 {
        grid-template-columns: 1fr;
    }

    .grid.grid-cols-2 {
        grid-template-columns: 1fr 1fr;
    }
}

/* Ensure proper spacing */
.space-y-4>*+* {
    margin-top: 1rem;
}

.space-y-3>*+* {
    margin-top: 0.75rem;
}

/* Optional: Add subtle glow on focus */
a:focus-visible {
    outline: 2px solid #FF8A65;
    outline-offset: 2px;
}
</style>

{{-- ── 3. STATS COUNTER ── --}}
<section class="bg-[#3b0458] py-16 relative overflow-hidden border-t border-white/5">
    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full"></div>
    <div class="max-w-[1400px] mx-auto px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            <div class="space-y-2">
                <h3 class="text-white text-4xl lg:text-5xl font-black tracking-tighter">8+</h3>
                <p class="text-[#FF8A65] font-bold text-[10px] lg:text-xs uppercase tracking-widest">Years of Excellence
                </p>
            </div>
            <div class="space-y-2">
                <h3 class="text-white text-4xl lg:text-5xl font-black tracking-tighter">800+</h3>
                <p class="text-[#FF8A65] font-bold text-[10px] lg:text-xs uppercase tracking-widest">Graduated Students
                </p>
            </div>
            <div class="space-y-2">
                <h3 class="text-white text-4xl lg:text-5xl font-black tracking-tighter">2</h3>
                <p class="text-[#FF8A65] font-bold text-[10px] lg:text-xs uppercase tracking-widest">Technical Courses
                </p>
            </div>
            <div class="space-y-2">
                <h3 class="text-white text-4xl lg:text-5xl font-black tracking-tighter">98%</h3>
                <p class="text-[#FF8A65] font-bold text-[10px] lg:text-xs uppercase tracking-widest">Placement Success
                </p>
            </div>
        </div>
    </div>
</section>


{{-- WHAT YOU LEARN SECTION --}}
<section class="py-24 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white p-8 md:p-12 rounded-[40px] border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-[#302171] opacity-[0.02] rounded-bl-full"></div>

            <div class="relative">
                <span
                    class="text-[#FF8A65] font-black text-xs uppercase tracking-[0.4em] mb-4 block text-center md:text-left">Core
                    Competencies</span>
                <h2 class="text-3xl font-black text-[#1e1b4b] uppercase tracking-tight mb-12 text-center md:text-left">
                    What You'll Learn | तपाईंले के सिक्नुहुनेछ</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-microscope text-[#302171] text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-wide">Plant Science</h4>
                            <p class="text-xs text-slate-500 mt-2 leading-relaxed">Agronomy, Seed Technology, and
                                Horticulture production excellence.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-vial-circle-check text-[#302171] text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-wide">Soil & Health</h4>
                            <p class="text-xs text-slate-500 mt-2 leading-relaxed">Advanced soil fertility management
                                and plant protection methods.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-cow text-[#302171] text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-wide">Animal Science</h4>
                            <p class="text-xs text-slate-500 mt-2 leading-relaxed">Livestock health, nutrition, and
                                poultry management systems.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-briefcase text-[#302171] text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-wide">Agribusiness</h4>
                            <p class="text-xs text-slate-500 mt-2 leading-relaxed">Social mobilization, marketing, and
                                agribusiness cooperatives.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(16px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

@endsection