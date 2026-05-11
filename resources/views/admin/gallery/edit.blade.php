@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-4">
        <a href="{{ route('gallery.index') }}" class="text-xs font-bold text-slate-500 hover:text-indigo-600 uppercase tracking-widest">&larr; Back to List</a>
    </div>

    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-2xl rounded-2xl border border-slate-100 overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-6 bg-[#003366] text-white">
            <h2 class="text-xl font-bold uppercase tracking-widest text-center">Edit Gallery</h2>
        </div>

        <div class="p-8 space-y-6">
            {{-- Basic Fields --}}
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2">Event Title</label>
                <input type="text" name="title" value="{{ $gallery->title }}" required class="w-full border-slate-200 border p-3 rounded-lg outline-none focus:ring-2 focus:ring-[#003366]">
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full border-slate-200 border p-3 rounded-lg outline-none focus:ring-2 focus:ring-[#003366]">{{ $gallery->description }}</textarea>
            </div>

            {{-- Existing Gallery Images Section --}}
            @if($gallery->images && $gallery->images->count() > 0)
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                <label class="block text-xs font-black uppercase text-slate-600 mb-3">Current Gallery Photos</label>
                <p class="text-[10px] text-red-500 mb-4 italic">Check the box on an image to remove it.</p>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($gallery->images as $image)
                    <div class="relative group border-2 border-transparent hover:border-red-500 rounded-lg overflow-hidden transition-all">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-24 object-cover">
                        
                        {{-- Delete Checkbox --}}
                        <div class="absolute top-0 right-0 bg-white/80 p-1 rounded-bl-lg">
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="w-4 h-4 accent-red-600">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Cover Thumbnail --}}
                <div class="p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                    <label class="block text-xs font-black uppercase text-indigo-700 mb-2">Change Cover Thumbnail</label>
                    @if($gallery->thumbnail_path)
                        <img src="{{ asset('storage/' . $gallery->thumbnail_path) }}" class="w-24 h-24 object-cover rounded mb-3 border-2 border-white shadow-sm">
                    @endif
                    <input type="file" name="thumbnail" class="text-xs text-slate-500">
                </div>

                {{-- Add New Photos --}}
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="block text-xs font-black uppercase text-slate-600 mb-2">Add New Photos</label>
                    <input type="file" name="images[]" multiple class="text-xs text-slate-500">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#003366] text-white py-4 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-black transition-all">
                Update Gallery
            </button>
        </div>
    </form>
</div>
@endsection