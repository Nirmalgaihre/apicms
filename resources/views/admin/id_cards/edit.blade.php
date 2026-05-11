@extends('layouts.admin')

@section('content')
<div class="flex justify-center items-center py-10">
    <div class="w-full max-w-2xl border border-gray-200 rounded-lg p-10 bg-white shadow-sm">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Edit ID Card</h2>

        <form action="{{ route('id_cards.update', $card->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Student Name</label>
                    <input type="text" name="name" value="{{ $card->name }}" required class="w-full border border-gray-300 rounded px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Program</label>
                    <input type="text" name="program" value="{{ $card->program }}" class="w-full border border-gray-300 rounded px-4 py-2 text-sm">
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $card->profile_image) }}" class="w-16 h-20 object-cover border">
                <div class="flex-1">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Change Photo (Optional)</label>
                    <input type="file" name="profile_image" class="w-full text-xs">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Mobile</label>
                    <input type="text" name="mobile_number" value="{{ $card->mobile_number }}" class="w-full border border-gray-300 rounded px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Batch</label>
                    <input type="text" name="batch" value="{{ $card->batch }}" class="w-full border border-gray-300 rounded px-4 py-2 text-sm">
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded uppercase tracking-widest text-xs">
                Update ID Card
            </button>
        </form>
    </div>
</div>
@endsection