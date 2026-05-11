@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4">
        
        <a href="{{ route('public.short-term') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#1d0647] mb-8 transition-colors">
            <i class="fa-solid fa-chevron-left mr-2"></i> Back to Programs
        </a>

        <article class="bg-white border border-slate-200 shadow-sm rounded-sm overflow-hidden">
            <div class="bg-[#1d0647] p-10 md:p-14 text-white relative">
                <div class="absolute top-0 right-0 w-32 h-1 bg-yellow-500"></div>
                
                <div class="inline-block bg-yellow-500 text-[#1d0647] px-3 py-1 text-[10px] font-black uppercase rounded-sm mb-6">
                    {{ $program->category->name }}
                </div>
                
                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-6">
                    {{ $program->title }}
                </h1>
                
                <div class="flex items-center text-indigo-200 text-xs font-bold uppercase tracking-widest">
                    <span class="mr-6"><i class="fa-solid fa-calendar-day mr-2 text-yellow-500"></i> Posted: {{ $program->created_at->format('F d, Y') }}</span>
                    <span><i class="fa-solid fa-hashtag mr-2 text-yellow-500"></i> Ref: #{{ $program->id }}</span>
                </div>
            </div>

            <div class="p-10 md:p-14">
                <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed font-light">
                    {!! nl2br(e($program->description)) !!}
                </div>

                @if($program->file_path)
                <div class="mt-16 p-8 bg-indigo-50 border border-indigo-100 rounded-sm flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center mb-6 md:mb-0">
                        <div class="w-14 h-14 bg-white text-[#1d0647] shadow-sm flex items-center justify-center rounded-sm mr-5">
                            <i class="fa-solid fa-file-pdf text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-[#1d0647] uppercase tracking-tight">Official Document</h4>
                            <p class="text-xs text-indigo-600 font-medium">Click the button to download or view the PDF</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $program->file_path) }}" 
                       target="_blank"
                       class="bg-[#1d0647] text-white px-8 py-4 rounded-sm text-[11px] font-black uppercase tracking-[0.15em] hover:bg-yellow-500 hover:text-[#1d0647] transition-all shadow-lg active:scale-95">
                        <i class="fa-solid fa-cloud-arrow-down mr-2"></i> Download Attachment
                    </a>
                </div>
                @endif
            </div>

            <div class="bg-slate-50 px-10 py-6 border-t border-slate-100 flex justify-between items-center">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">End of Announcement</span>
                <div class="flex space-x-4">
                    <button onclick="window.print()" class="text-slate-400 hover:text-indigo-600 text-sm">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection