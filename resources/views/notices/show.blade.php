@extends('layouts.app') {{-- Or your main public layout --}}

@section('content')
<div class="max-w-4xl mx-auto px-6 py-20">
    <div class="bg-white border border-gray-100 shadow-2xl rounded-2xl overflow-hidden">
        <div class="bg-[#302171] p-8 text-white">
            <span class="text-[#FF8A65] font-bold text-xs uppercase tracking-widest">{{ $notice->category }}</span>
            <h1 class="text-3xl font-black mt-2">{{ $notice->title }}</h1>
            <div class="flex items-center gap-6 mt-4 text-sm opacity-80">
                <span>📅 {{ $notice->nepali_date ?? $notice->created_at->format('Y-m-d') }}</span>
                <span>👤 Published by: {{ $notice->publisher ?? 'Admin' }}</span>
            </div>
        </div>
        
        <div class="p-8 prose prose-slate max-w-none">
            <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                {{ $notice->description }}
            </p>

            @if($notice->file_path)
                <div class="mt-10 p-6 bg-slate-50 rounded-xl border border-dashed border-slate-200 flex justify-between items-center">
                    <div>
                        <p class="font-bold text-slate-800">Attached Document</p>
                        <p class="text-xs text-slate-500">View or download the official notice file.</p>
                    </div>
                    <a href="{{ asset('storage/' . $notice->file_path) }}" target="_blank" 
                       class="bg-[#302171] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#FF8A65] transition">
                        VIEW FILE
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection