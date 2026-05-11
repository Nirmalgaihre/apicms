@extends('layouts.admin')
@section('content')
<div class="max-w-4xl mx-auto p-6">

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-r-lg shadow-sm">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-bold text-amber-800 uppercase tracking-wide">महत्वपूर्ण जानकारी (Upload Notice)</h3>
            <div class="mt-1 text-sm text-amber-700">
               <h3 class="text-lg font-bold text-amber-900 mb-2">अपलोड सम्बन्धी जानकारी:</h3>
            <div class="text-amber-800 space-y-3 leading-relaxed">
                <p>
                    यदि फोटोहरू थोरै <b>KB</b> का छन् भने एकै पटकमा <b>४-५ वटासम्म</b> फोटोहरू अपलोड गर्न सक्नुहुन्छ। 
                    तर ध्यान दिनुहोस्, सबै फोटोहरू मिलाएर जम्मा साइज <b>२ MB (2MB)</b> भन्दा बढी हुनु हुँदैन।
                </p>
                <p class="font-medium">
                    <span class="text-red-600">नोट:</span> २ MB भन्दा ठूलो फाइल भएमा फोटो अपलोड नहुन सक्छ वा वेबसाइट ढिलो चल्न सक्छ। त्यसैले धेरै फोटोहरू राख्नु छ भने:
                </p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>सुरुमा केही मुख्य फोटोहरू मात्र राखेर सेभ गर्नुहोस्।</li>
                    <li>अरू थप फोटोहरू हाल्नको लागि पछि <b>"Edit"</b> बटनमा गएर पालैपालो थप्दै जानुहोस्।</li>
                </ul>
            </div>
        </div>
    </div>
</div>

    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-2xl rounded-2xl overflow-hidden border">
        @csrf
        <div class="p-6 bg-[#003366] text-white text-center">
            <h2 class="text-xl font-bold uppercase tracking-widest">Upload New Gallery</h2>
        </div>

        <div class="p-8 space-y-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2">Event Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full border p-3 rounded-lg outline-none focus:ring-2 focus:ring-blue-900">
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full border p-3 rounded-lg outline-none focus:ring-2 focus:ring-blue-900">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                    <label class="block text-xs font-black uppercase text-indigo-700 mb-2">Thumbnail (Optional)</label>
                    <input type="file" name="thumbnail" class="text-sm text-slate-500">
                </div>

                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="block text-xs font-black uppercase text-slate-600 mb-2">Album Images (Multiple)</label>
                    <input type="file" name="images[]" multiple required class="text-sm text-slate-500">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#003366] text-white py-4 rounded-xl font-bold uppercase tracking-widest hover:bg-black transition-all">
                Publish Album
            </button>
        </div>
    </form>
</div>
@endsection