@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-lg p-10 shadow-sm">
    <div class="text-center mb-8 border-b pb-6">
        <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Edit Blog Post</h2>
        <p class="text-xs text-gray-400 uppercase tracking-widest mt-2">Modify content, update photos, or video link</p>
    </div>

    <form action="{{ route('blog.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Blog Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" placeholder="Enter post title" class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm focus:border-indigo-500 outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Main Thumbnail</label>
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-32 h-20 object-cover rounded border border-gray-200 mb-2">
                    <p class="text-[10px] text-gray-400">Current Thumbnail</p>
                </div>
                <input type="file" name="thumbnail" class="w-full border border-gray-300 rounded px-2 py-1.5 text-xs bg-gray-50">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Gallery Photos (Add More)</label>
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach($post->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" class="w-12 h-12 object-cover rounded border border-gray-200">
                    @endforeach
                </div>
                <input type="file" name="photos[]" multiple class="w-full border border-gray-300 rounded px-2 py-1.5 text-xs bg-gray-50">
                <p class="text-[10px] text-gray-400 mt-1 italic">Uploading new photos will add to the existing gallery.</p>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">YouTube Video URL (Optional)</label>
            <input type="url" name="video_url" value="{{ old('video_url', $post->video_url) }}" placeholder="https://youtube.com/watch?v=..." class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:border-indigo-500 outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description / Content</label>
            <textarea name="description" rows="10" placeholder="Write blog details here..." class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm focus:border-indigo-500 outline-none resize-none">{{ old('description', $post->description) }}</textarea>
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded text-xs uppercase tracking-[0.2em] transition shadow-md">
                Update Blog Post
            </button>
            <a href="{{ route('blog.index') }}" class="px-8 py-4 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded text-xs uppercase tracking-[0.2em] transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection