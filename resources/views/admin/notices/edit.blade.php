@extends('layouts.admin')

@section('content')
<div class="flex justify-center items-center min-h-full bg-white py-10">
    <div class="w-full max-w-2xl border border-gray-200 rounded-lg p-10 shadow-sm">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center uppercase tracking-tight">Edit Notice</h2>

        <form action="{{ route('notices.update', $notice->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Category</label>
                    <select name="category" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name }}" {{ $notice->category == $cat->name ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Change File (Optional)</label>
                    <input type="file" name="file" class="w-full border border-gray-300 rounded px-2 py-1 text-xs bg-white text-gray-400">
                    @if($notice->file_path)
                        <p class="text-[10px] text-blue-500 mt-1 uppercase">Current: Attached File</p>
                    @endif
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Title</label>
                <input type="text" name="title" value="{{ $notice->title }}" required class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description</label>
                <textarea name="description" required rows="5" class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm">{{ $notice->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nepali Date</label>
                    <input type="text" name="nepali_date" value="{{ $notice->nepali_date }}" class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Publisher</label>
                    <select name="publisher" class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm bg-gray-50">
                        <option value="Admin" {{ $notice->publisher == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Principal" {{ $notice->publisher == 'Principal' ? 'selected' : '' }}>Principal</option>
                        <option value="Department" {{ $notice->publisher == 'Department' ? 'selected' : '' }}>Department</option>
                    </select>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded transition text-xs uppercase tracking-widest">
                    Update Notice
                </button>
            </div>
        </form>
    </div>
</div>
@endsection