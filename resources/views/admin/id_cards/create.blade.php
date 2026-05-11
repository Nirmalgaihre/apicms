@extends('layouts.admin')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-sm border border-gray-200">
    <h2 class="text-xl font-bold mb-6 border-b pb-4">Create Student ID Card</h2>
    <form action="{{ route('id_cards.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Full Name</label>
                <input type="text" name="name" required class="w-full border p-2 rounded text-sm outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Program</label>
                <select name="program" class="w-full border p-2 rounded text-sm outline-none">
                    <option value="Diploma in Agriculture (Plant Science)">Diploma in Agriculture (Plant Science)</option>
                    <option value="Diploma in Agriculture (Animal Science)">Diploma in Agriculture (Animal Science)</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Batch</label>
                <input type="text" name="batch" placeholder="2080-2083" class="w-full border p-2 rounded text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Expire Date</label>
                <input type="text" name="expire_date" placeholder="2027/12/30" class="w-full border p-2 rounded text-sm">
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Mobile Number</label>
            <input type="text" name="mobile_number" class="w-full border p-2 rounded text-sm">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Address</label>
            <input type="text" name="address" class="w-full border p-2 rounded text-sm">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Profile Photo (PP Size)</label>
            <input type="file" name="profile_image" required class="w-full border p-1 rounded text-sm">
        </div>
        <button type="submit" class="w-full bg-[#1d0647] text-white font-bold py-3 rounded hover:bg-black transition text-xs uppercase tracking-widest">Generate Record</button>
    </form>
</div>
@endsection