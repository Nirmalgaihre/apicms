@extends('layouts.admin')
@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-xl font-bold text-slate-800">Edit Admin</h2>
            <p class="text-xs text-slate-400 uppercase mt-1">Update details for {{ $user->name }}</p>
        </div>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-8 space-y-6">
            @csrf @method('PUT')
            
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Full Name</label>
                <input type="text" name="name" value="{{ $user->name }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ $user->email }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">New Password</label>
                    <input type="text" name="password" placeholder="Leave blank to keep same" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Role</label>
                    <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white outline-none">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="editor" {{ $user->role == 'editor' ? 'selected' : '' }}>Editor</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#1d0647] text-white font-bold py-4 rounded-xl text-xs uppercase tracking-widest">Update Admin & Send Mail</button>
        </form>
    </div>
</div>
@endsection