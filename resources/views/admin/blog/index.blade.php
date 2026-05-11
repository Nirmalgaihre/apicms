@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b pb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manage Blog Posts</h2>
            <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Update or remove your news and stories</p>
        </div>
        <a href="{{ route('blog.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-xs font-bold uppercase transition">
            <i class="fa-solid fa-plus mr-1"></i> New Post
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-3 bg-green-50 text-green-700 border border-green-200 rounded text-xs font-bold uppercase text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Preview</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Blog Details</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Media</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 w-32">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-20 h-12 object-cover rounded border border-gray-200 shadow-sm">
                    </td>
                    <td class="px-6 py-4">
                        <h3 class="text-sm font-bold text-gray-800">{{ $post->title }}</h3>
                        <p class="text-[10px] text-gray-400 mt-1"><i class="fa-regular fa-clock mr-1"></i> {{ $post->created_at->format('M d, Y') }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <span class="text-[10px] bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full font-bold">
                                {{ $post->images->count() }} Photos
                            </span>
                            @if($post->video_url)
                                <span class="text-[10px] bg-red-50 text-red-600 px-2 py-0.5 rounded-full font-bold">Video</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
    <div class="flex justify-end items-center space-x-3">
        
        <a href="{{ route('blog.edit', $post->id) }}" class="text-gray-400 hover:text-indigo-600 transition">
            <i class="fa-solid fa-pen-to-square text-sm"></i>
        </a>
        <form action="{{ route('blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-gray-300 hover:text-red-500 transition">
                <i class="fa-solid fa-trash-can text-sm"></i>
            </button>
        </form>
    </div>
</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic text-xs uppercase tracking-widest">No blog posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection