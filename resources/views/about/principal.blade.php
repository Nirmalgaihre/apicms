@extends('layouts.app')
{{-- Browser Tab Title --}}
@section('title', 'Principal\'s Message')

{{-- SEO Description --}}
@section('meta_description', 'Read the official message from the Principal of Annapurna Polytechnic Institute. Learn about our commitment to technical excellence in Plant Science and Animal Science programs.')

{{-- Author Credit --}}
@section('meta_author', 'Nirmal Gaihre')

{{-- Keywords --}}
@section('meta_keywords', 'Principal Message, Technical Education Vision Nepal, Annapurna Polytechnic')
@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">
    
    <div class="border-b-2 border-slate-100 pb-6 mb-10">
        <h1 class="text-3xl font-bold text-slate-800 uppercase tracking-tight">Message from the Principal</h1>
    </div>

    <div class="flex flex-col md:flex-row gap-12">
        
        <div class="w-full md:w-1/3">
            <div class="border border-slate-200 p-2 bg-white shadow-sm">
                @if($principal && $principal->staff_img)
                    <img src="{{ asset('storage/' . $principal->staff_img) }}" 
                         alt="Principal" 
                         class="w-full h-auto block">
                @else
                    <div class="aspect-[3/4] bg-slate-100 flex items-center justify-center text-slate-400">
                        No Photo
                    </div>
                @endif
            </div>
            
            <div class="mt-6">
                <h2 class="text-xl font-bold text-slate-900">{{ $principal->staff_name ?? 'Principal Name' }}</h2>
                <p class="text-[#FF8A65] font-semibold text-sm">Principal</p>
                
                <div class="mt-4 pt-4 border-t border-slate-100 space-y-2 text-sm text-slate-600">
                    <p><strong>Phone:</strong> {{ $principal->staff_phone ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $principal->staff_email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-2/3">
            <div class="text-slate-700 leading-relaxed text-lg text-justify">
                {{-- 
                   The line below fixes the "HTML special character" issue. 
                   It decodes symbols like &lt; into < so the browser renders them as tags.
                --}}
                {!! htmlspecialchars_decode($message->description ?? 'Information coming soon.') !!}
            </div>

            <div class="mt-12 pt-6 border-t border-slate-100">
                <p class="font-bold text-slate-800">Best Regards,</p>
                <p class="text-slate-600">Annapurna Polytechnic Institute</p>
            </div>
        </div>

    </div>
</div>
@endsection