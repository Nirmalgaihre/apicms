@extends('layouts.admin')

@section('content')
<div class="p-10 bg-[#f8fafc] min-h-screen">
    <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between border-b border-slate-200 pb-4">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">Edit Property</h1>
            <p class="text-sm text-slate-500">Resource UID: #{{ $resource->id }}</p>
        </div>
        <div class="flex space-x-2">
             <a href="{{ route('resources.index') }}" class="btn btn-outline-secondary btn-sm px-4">Cancel</a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Main Form --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <form action="{{ route('resources.update', $resource->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Title</label>
                            <input type="text" name="title" value="{{ $resource->title }}"
                                class="form-control border-slate-200 focus:ring-slate-900 focus:border-slate-900 rounded-md py-2.5">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Description</label>
                            <textarea name="description" rows="5" 
                                class="form-control border-slate-200 focus:ring-slate-900 focus:border-slate-900 rounded-md">{{ $resource->description }}</textarea>
                        </div>

                        <div class="pt-4 border-t border-slate-100">
                            <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Replace Attachment</label>
                            <input type="file" name="file" class="form-control text-sm border-slate-200">
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 flex justify-end">
                        <button type="submit" class="bg-slate-900 text-white px-8 py-2 rounded-md font-medium text-sm hover:bg-slate-800 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar Preview --}}
        <div class="space-y-6">
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <h3 class="text-xs font-bold uppercase text-slate-400 mb-4">Current Asset</h3>
                <div class="rounded-lg overflow-hidden border border-slate-100 mb-3 bg-slate-50">
                    @if(Str::endsWith($resource->file_path, '.pdf'))
                        <div class="h-32 flex flex-col items-center justify-center">
                            <i class="fa-solid fa-file-pdf text-4xl text-red-400 mb-2"></i>
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Portable Document</span>
                        </div>
                    @else
                        <img src="{{ asset('storage/' . $resource->file_path) }}" class="w-full h-auto object-cover">
                    @endif
                </div>
                <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" 
                    class="block text-center text-xs font-semibold text-slate-600 hover:text-blue-600 transition-colors py-2 border border-slate-200 rounded-md">
                    <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Full View
                </a>
            </div>

            <div class="bg-blue-900 p-5 rounded-xl text-white shadow-lg">
                <i class="fa-solid fa-circle-info mb-3 text-blue-300"></i>
                <p class="text-xs leading-relaxed opacity-80">
                    Updating the title or description will reflect immediately on the public website. Replacing the file will delete the previous version from the server.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection