@extends('layouts.admin')

@section('title', 'Edit Staff')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 bg-slate-900 text-white flex justify-between items-center">
            <h3 class="text-xs font-black uppercase tracking-widest">Update Staff Record</h3>
            <span class="text-[10px] font-mono text-slate-400">ID: {{ $staff->id }}</span>
        </div>

        <form action="{{ route('staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-5">
            @csrf
            @method('PUT')

            <div class="flex flex-col items-center mb-6">
                <div class="h-24 w-24 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 overflow-hidden relative group">
                    @if($staff->staff_img)
                        <img src="{{ asset('storage/' . $staff->staff_img) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <i class="fa-solid fa-camera text-2xl"></i>
                        </div>
                    @endif
                </div>
                <p class="text-[10px] font-bold text-slate-400 uppercase mt-2">Current Photo</p>
            </div>

            <div>
                <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Full Name</label>
                <input type="text" name="staff_name" value="{{ $staff->staff_name }}" required
                    class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white rounded-xl p-3 text-sm outline-none transition-all mt-1">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Category</label>
                    <select name="staff_category" required
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white rounded-xl p-3 text-sm outline-none transition-all mt-1">
                        @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ $staff->staff_category == $c->id ? 'selected' : '' }}>
                            {{ $c->title }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Phone Number</label>
                    <input type="text" name="staff_phone" value="{{ $staff->staff_phone }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white rounded-xl p-3 text-sm outline-none transition-all mt-1">
                </div>
            </div>

            <div>
                <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Email Address</label>
                <input type="email" name="staff_email" value="{{ $staff->staff_email }}"
                    class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white rounded-xl p-3 text-sm outline-none transition-all mt-1">
            </div>

            <div>
                <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Update Profile Photo</label>
                <input type="file" name="staff_img" accept="image/*"
                    class="w-full text-xs text-slate-500 mt-2 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer">
            </div>

            <div class="pt-4 flex gap-3">
                <a href="{{ route('staff.index') }}"
                   class="flex-1 text-center bg-slate-100 text-slate-600 font-black py-4 rounded-2xl text-xs uppercase tracking-[0.2em] hover:bg-slate-200 transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="flex-1 bg-indigo-600 text-white font-black py-4 rounded-2xl text-xs uppercase tracking-[0.2em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">
                    Update Staff
                </button>
            </div>
        </form>
    </div>
</div>
@endsection