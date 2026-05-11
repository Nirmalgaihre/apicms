@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-lg p-10 shadow-sm">
    <div class="text-center mb-8 border-b pb-6">
        <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Create New Blog Post</h2>
        <p class="text-xs text-gray-400 uppercase tracking-widest mt-2">Manage content, photos, and video</p>
    </div>

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Blog Title</label>
            <input type="text" name="title" placeholder="Enter post title" class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm focus:border-indigo-500 outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Main Thumbnail</label>
                <input type="file" name="thumbnail" class="w-full border border-gray-300 rounded px-2 py-1.5 text-xs bg-gray-50">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Gallery Photos (Multiple)</label>
                <input type="file" name="photos[]" multiple class="w-full border border-gray-300 rounded px-2 py-1.5 text-xs bg-gray-50">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">YouTube Video URL (Optional)</label>
            <input type="url" name="video_url" placeholder="https://youtube.com/watch?v=..." class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:border-indigo-500 outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description / Content</label>
            <textarea name="description" rows="10" placeholder="Write blog details here..." class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm focus:border-indigo-500 outline-none resize-none"></textarea>
        </div>

        <button type="submit" class="w-full bg-[#333] hover:bg-black text-white font-bold py-4 rounded text-xs uppercase tracking-[0.2em] transition shadow-md">
            Publish Blog Post
        </button>
    </form>
</div>
@endsection