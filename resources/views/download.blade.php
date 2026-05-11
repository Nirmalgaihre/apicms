@extends('layouts.app')

@section('content')
<div class="py-16 bg-[#302171] text-white">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl font-bold uppercase tracking-tight">Syllabus Downloads</h1>
        <div class="h-1 w-20 bg-[#FF8A65] mt-4"></div>
        <p class="mt-4 text-white/70">Download the official curriculum for our diploma programs.</p>
    </div>
</div>

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- Plant Science Syllabus -->
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-leaf text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-[#302171] uppercase">Plant Science</h2>
                    <p class="text-sm text-gray-500 mb-6">Diploma in Agriculture</p>
                    
                    <a href="{{ asset('storage/downloads/plant-science.pdf') }}" 
                       target="_blank"
                       class="inline-flex items-center justify-center px-6 py-3 bg-[#302171] text-white font-semibold rounded-lg hover:bg-[#3f2b93] transition-colors w-full">
                        <i class="fa-solid fa-file-pdf mr-2"></i> Download Syllabus
                    </a>
                </div>
            </div>

            <!-- Animal Science Syllabus -->
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-cow text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-[#302171] uppercase">Animal Science</h2>
                    <p class="text-sm text-gray-500 mb-6">Diploma in Agriculture</p>
                    
                    <a href="{{ asset('storage/downloads/animal-science.pdf') }}" 
                       target="_blank"
                       class="inline-flex items-center justify-center px-6 py-3 bg-[#302171] text-white font-semibold rounded-lg hover:bg-[#3f2b93] transition-colors w-full">
                        <i class="fa-solid fa-file-pdf mr-2"></i> Download Syllabus
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-12 text-center py-8 border-t border-gray-200">
            <p class="text-gray-600">Need further assistance regarding the curriculum?</p>
            <a href="{{ route('public.contact') }}" class="text-[#302171] font-bold hover:underline">Contact the Academic Section</a>
        </div>
    </div>
</section>
@endsection
