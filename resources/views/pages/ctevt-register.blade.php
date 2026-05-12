@extends('layouts.app')

@section('content')
<div x-data="{ showPdf: true }" class="relative w-full h-[calc(100vh-50px)]">

    {{-- CTEVT Portal Iframe --}}
    <iframe 
        src="https://itms.ctevt.org.np:5580/entrance/" 
        class="w-full h-full border-none shadow-inner"
        title="CTEVT Online Registration">
    </iframe>

    {{-- PDF INSTRUCTIONS POPUP --}}
    <div x-show="showPdf" 
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/75 backdrop-blur-sm p-4">
        
        <div @click.away="showPdf = false" 
             class="bg-white rounded-lg shadow-2xl w-full max-w-5xl h-[85vh] flex flex-col overflow-hidden animate-in fade-in zoom-in duration-300">
            
            {{-- Header --}}
            <div class="bg-[#004a99] text-white px-6 py-4 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-file-pdf text-yellow-400 text-xl"></i>
                    <h2 class="font-bold tracking-wide uppercase">Registration Instructions (Full Fee Form)</h2>
                </div>
                <button @click="showPdf = false" class="text-white hover:text-red-400 text-2xl">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            {{-- PDF Content --}}
            <div class="flex-grow bg-gray-200">
                <object 
                    data="{{ asset('assets/pdf/full fee form.pdf') }}#toolbar=0" 
                    type="application/pdf" 
                    class="w-full h-full">
                    <div class="flex flex-col items-center justify-center h-full space-y-4">
                        <p class="text-gray-600">Your browser cannot preview this PDF.</p>
                        <a href="{{ asset('assets/pdf/full fee form.pdf') }}" class="bg-blue-600 text-white px-6 py-2 rounded">Download Form</a>
                    </div>
                </object>
            </div>

            {{-- Footer --}}
            <div class="p-4 bg-gray-50 border-t flex justify-center">
                <button @click="showPdf = false" 
                    class="bg-[#004a99] hover:bg-blue-700 text-white font-bold px-12 py-3 rounded shadow-lg transition-transform active:scale-95">
                    पढेँ, अब फारम भर्छु (Proceed to Register)
                </button>
            </div>
        </div>
    </div>
</div>
@endsection