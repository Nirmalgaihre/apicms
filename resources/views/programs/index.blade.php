@extends('layouts.app')

@section('title', 'Short-Term Program')
@section('meta_description', 'Explore short-term skill development programs at Annapurna Polytechnic Institute. Intensive vocational training designed for quick employment in various technical fields.')
@section('meta_author', 'Nirmal Gaihre')
@section('meta_keywords', 'Vocational Training Nepal, Short term courses Kaski, Skill development API, CTEVT short courses')
@section('content')
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-12">
            <h1 class="text-4xl font-black text-[#1d0647] tracking-tight uppercase">
                Short-Term <span class="text-yellow-500">Programs</span>
            </h1>
            <p class="text-slate-500 mt-2 font-medium">Discover upcoming opportunities, workshops, and notices.</p>
            <div class="w-20 h-1.5 bg-[#1d0647] mt-4"></div>
        </div>

        @foreach($categoriesWithAnnouncements as $category)
            @if($category->announcements->count() > 0)
            <div class="mb-16">
                <div class="flex items-center mb-8">
                    <h2 class="text-sm font-black uppercase tracking-[0.2em] text-white bg-[#1d0647] px-4 py-2 rounded-sm shadow-sm">
                        {{ $category->name }}
                    </h2>
                    <div class="flex-grow border-t-2 border-slate-200 ml-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($category->announcements as $announcement)
                    <div class="bg-white border border-slate-200 rounded-sm hover:border-yellow-500 hover:shadow-xl transition-all duration-300 group overflow-hidden flex flex-col">
                        <div class="p-8 flex-grow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    <i class="fa-regular fa-calendar-days mr-1"></i> 
                                    {{ $announcement->created_at->format('M d, Y') }}
                                </span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-slate-800 mb-4 group-hover:text-[#1d0647] leading-snug">
                                {{ $announcement->title }}
                            </h3>
                            
                            <p class="text-slate-600 text-sm leading-relaxed line-clamp-3">
                                {{ strip_tags($announcement->description) }}
                            </p>
                        </div>

                        <div class="px-8 py-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                            <a href="{{ route('public.program.show', $announcement->id) }}" 
                               class="text-[11px] font-black uppercase tracking-widest text-[#1d0647] hover:text-yellow-600 transition-colors flex items-center">
                                View Details <i class="fa-solid fa-arrow-right-long ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach

        @if($categoriesWithAnnouncements->every(fn($cat) => $cat->announcements->isEmpty()))
            <div class="text-center py-20 bg-white border border-dashed border-slate-300 rounded-lg">
                <i class="fa-solid fa-folder-open text-4xl text-slate-200 mb-4"></i>
                <p class="text-slate-500 font-medium">No active programs found at the moment.</p>
            </div>
        @endif
    </div>
</div>
@endsection