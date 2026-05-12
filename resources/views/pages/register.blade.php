@extends('layouts.app')

@section('content')
{{-- We create a new Alpine scope just for this page --}}
<div x-data="{ showPdf: true }" class="relative w-full h-[calc(100vh-60px)] overflow-hidden">
    
    {{-- 1. The Iframe --}}
    <iframe 
        src="https://itms.ctevt.org.np:5580/entrance/" 
        class="w-full h-full border-none"
        allow="fullscreen">
    </iframe>

    {{-- 2. The PDF Popup (Only exists on this page) --}}
    <div x-show="showPdf" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="fixed inset-0 z-[200] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
        
        <div @click.away="showPdf = false" 
             class="bg-white rounded-xl shadow-2xl w-full max-w-5xl h-[85vh] flex flex-col relative overflow-hidden">
            
            {{-- Popup Header --}}
            <div class="bg-[#004a99] text-white p-4 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-file-pdf text-yellow-400 text-xl"></i>
                    <h2 class="font-bold text-sm md:text-base uppercase tracking-wide">
                        भर्ना सम्बन्धि निर्देशन (Admission Instructions)
                    </h2>
                </div>
                <button @click="showPdf = false" class="hover:bg-white/10 w-8 h-8 rounded-full transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            {{-- PDF Content --}}
            <div class="flex-grow bg-slate-100">
                <object 
                    data="{{ asset('assets/pdf/full fee form.pdf') }}#toolbar=0&navpanes=0" 
                    type="application/pdf" 
                    class="w-full h-full">
                    <div class="flex flex-col items-center justify-center h-full p-10 text-center">
                        <i class="fa-solid fa-circle-exclamation text-4xl text-slate-400 mb-4"></i>
                        <p class="text-slate-600 mb-4">तपाईंको ब्राउजरले PDF देखाउन सकेन ।</p>
                        <a href="{{ asset('assets/pdf/full fee form.pdf') }}" class="bg-[#004a99] text-white px-6 py-2 rounded-lg">निर्देशिका डाउनलोड गर्नुहोस्</a>
                    </div>
                </object>
            </div>

            {{-- Action Button --}}
            <div class="p-4 border-t bg-white flex justify-center">
                <button @click="showPdf = false" 
                        class="bg-yellow-500 hover:bg-[#302171] hover:text-white text-[#302171] font-extrabold py-3 px-12 rounded-lg transition-all duration-300 shadow-lg transform active:scale-95">
                    मैले सबै निर्देशनहरू पढेँ / CLOSE
                </button>
            </div>
        </div>
    </div>
</div>
@endsection