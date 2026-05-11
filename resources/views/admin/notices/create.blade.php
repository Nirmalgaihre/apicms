@extends('layouts.admin')

@section('content')
<div class="flex justify-center items-center min-h-full bg-white">
    <div class="w-full max-w-2xl border border-gray-200 rounded-lg p-10 shadow-sm">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Notice Board</h2>
            <div class="flex justify-center my-6">
                <img src="https://abps.edu.np/asset/images/logo.png" class="w-20" alt="Logo">
            </div>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-6 p-3 bg-green-50 text-green-700 border border-green-200 rounded text-xs font-bold text-center uppercase">
                {{ session('success') }}
            </div>
        @endif

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
            <div class="mb-6 p-3 bg-red-50 text-red-700 border border-red-200 rounded text-xs">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notices.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- CATEGORY --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Category</label>
                    <select name="category" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50 focus:border-blue-500 outline-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- FILE --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Upload File</label>
                    <input type="file" name="file" class="w-full border border-gray-300 rounded px-2 py-1 text-xs bg-white text-gray-400">
                    <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tighter">
                        Supported: PDF, JPG, PNG, JFIF
                    </p>
                </div>

            </div>

            {{-- TITLE --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Title</label>
                <input type="text" name="title" required placeholder="Enter title"
                    class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm focus:border-blue-500 outline-none">
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description</label>
                <textarea name="description" required rows="5" placeholder="Enter description"
                    class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm focus:border-blue-500 outline-none resize-none"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- NEPALI DATE --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nepali Date</label>
                    <input type="text" name="nepali_date" placeholder="2082-02-01"
                        class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm focus:border-blue-500 outline-none">
                </div>

                {{-- PUBLISHER --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Publisher</label>
                    <select name="publisher"
                        class="w-full border border-gray-300 rounded px-4 py-2.5 text-sm bg-gray-50 focus:border-blue-500 outline-none">
                        <option value="">Select Publisher</option>
                        <option value="Admin">Admin</option>
                        <option value="Principal">Principal</option>
                        <option value="Department">Department</option>
                    </select>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-[#333] hover:bg-black text-white font-bold py-3.5 rounded transition duration-200 text-xs uppercase tracking-[0.2em]">
                    Add Notice
                </button>
            </div>

        </form>
    </div>
</div>
@endsection