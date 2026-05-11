@extends('layouts.app')
{{-- १. डाइनामिक टाइटल --}}
@section('title', $gallery->title)

{{-- २. डाइनामिक मेटा डिस्क्रिप्सन (ग्यालरीको बारेमा जानकारी) --}}
@section('meta_description', Str::limit(strip_tags($gallery->description ?? 'Explore our ' . $gallery->title . ' album for more photos and stories.'), 155))

{{-- ३. मेटा अथर (लेखक) --}}
@section('meta_author', 'Nirmal Gaihre')

{{-- ४. मेटा कीवर्ड्स (ग्यालरीसँग सम्बन्धित) --}}
@section('content')
<div class="bg-white min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('public.gallery.index') }}" class="inline-flex items-center text-blue-600 font-bold text-xs uppercase tracking-widest hover:underline">
            &larr; Back to Gallery
        </a>

        <h1 class="text-4xl font-black text-slate-900 uppercase mt-6 mb-12">{{ $gallery->title }}</h1>

        <div class="columns-1 md:columns-3 gap-4 space-y-4">
            @foreach($gallery->images as $image)
                <div class="break-inside-avoid">
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         class="w-full rounded-2xl shadow-md border border-slate-100 hover:opacity-95 transition-opacity"
                         alt="{{ $gallery->title }}">
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection