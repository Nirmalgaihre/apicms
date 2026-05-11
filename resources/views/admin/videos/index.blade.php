@extends('layouts.admin')

@section('title', 'Manage Videos')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h2 class="text-lg font-bold text-slate-800">Video Gallery</h2>
        <a href="{{ route('videos.create') }}" class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-emerald-600 transition">
            <i class="fa-solid fa-plus mr-2"></i> Add Video Link
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">Preview</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">Title</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($videos as $video)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4">
                        @php
                            // Extract YouTube ID
                            preg_match("/(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be\/)[^&\n]+/", $video->video_url, $matches);
                            $videoId = $matches[0] ?? null;
                        @endphp
                        
                        @if($videoId)
                            <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" class="w-32 h-20 rounded object-cover bg-black shadow-sm">
                        @else
                            <div class="w-32 h-20 bg-slate-200 rounded flex items-center justify-center">
                                <i class="fa-solid fa-video-slash text-slate-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-semibold text-slate-700">{{ $video->title }}</p>
                        <a href="{{ $video->video_url }}" target="_blank" class="text-[10px] text-indigo-500 hover:underline flex items-center">
                            <i class="fa-brands fa-youtube mr-1"></i> View on YouTube
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('videos.edit', $video->id) }}" class="text-indigo-500 hover:text-indigo-700 p-2 transition-colors">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Remove this video link?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 p-2 transition-colors">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                
                @if($videos->isEmpty())
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-slate-400 italic text-sm">No videos found.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection