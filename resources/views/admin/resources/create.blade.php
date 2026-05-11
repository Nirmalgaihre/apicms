@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Notice Box --}}
    <div class="mb-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-r-lg shadow-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-bold text-amber-800 uppercase tracking-wide">महत्वपूर्ण जानकारी (File Upload Notice)</h3>
                <div class="mt-1 text-sm text-amber-700 leading-relaxed">
                    <p>
                        कृपया फाइल अपलोड गर्दा ध्यान दिनुहोस्। फाइलको साइज <b>५ MB भन्दा कम</b> हुनुपर्छ। 
                        तपाईंले यहाँ <b>PDF, JPG, वा PNG</b> मात्र अपलोड गर्न सक्नुहुन्छ। 
                        यदि फाइल ठूलो छ भने, यसलाई रिसाइज वा कम्प्रेस गरेर मात्र अपलोड गर्नुहोला।
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Resource Form --}}
    <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-2xl rounded-2xl overflow-hidden border">
        @csrf
        
        {{-- Header --}}
        <div class="p-6 bg-[#003366] text-white text-center">
            <h2 class="text-xl font-bold uppercase tracking-widest">Register New Resource</h2>
            <p class="text-blue-200 text-xs mt-1 uppercase">Official Archive Entry</p>
        </div>

        <div class="p-8 space-y-6">
            {{-- Title --}}
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-tighter">Document / Resource Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required 
                    placeholder="Enter official title"
                    class="w-full border p-3 rounded-lg outline-none focus:ring-2 focus:ring-blue-900 transition-all border-slate-200">
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-tighter">Brief Description</label>
                <textarea name="description" rows="4" 
                    placeholder="Provide a summary of the resource..."
                    class="w-full border p-3 rounded-lg outline-none focus:ring-2 focus:ring-blue-900 transition-all border-slate-200">{{ old('description') }}</textarea>
            </div>

            {{-- File Attachment Zone --}}
            <div class="p-6 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                <label class="block text-xs font-black uppercase text-slate-600 mb-3 text-center">Select Resource File (PDF, Image)</label>
                <div class="flex flex-col items-center justify-center">
                    <input type="file" name="file" required 
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100 transition-all cursor-pointer">
                    <p class="mt-3 text-[10px] text-slate-400 uppercase font-bold tracking-widest">Max File Size: 5MB</p>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="pt-4">
                <button type="submit" class="w-full bg-[#003366] text-white py-4 rounded-xl font-bold uppercase tracking-widest hover:bg-black hover:shadow-lg transition-all transform active:scale-[0.98]">
                    Save & Publish Resource
                </button>
                
                <a href="{{ route('resources.index') }}" class="block text-center mt-4 text-xs font-bold text-slate-400 hover:text-red-500 uppercase tracking-widest transition-colors">
                    Cancel & Return
                </a>
            </div>
        </div>
    </form>
</div>
@endsection