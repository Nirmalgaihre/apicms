@extends('layouts.admin')

@section('title', 'Add Admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex items-center text-xs font-bold uppercase tracking-widest text-slate-400">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
        <i class="fa-solid fa-chevron-right mx-3 text-[8px]"></i>
        <span class="text-slate-700">Add New Admin</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-xl font-bold text-slate-800">Admin Registration</h2>
            <p class="text-sm text-slate-500 mt-1">Fill in the details to create a new administrative account. An email with credentials will be sent automatically.</p>
        </div>

        @if(session('success'))
            <div class="mx-8 mt-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-bold rounded-lg flex items-center">
                <i class="fa-solid fa-circle-check mr-2 text-lg"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mx-8 mt-6 p-4 bg-red-50 border border-red-100 text-red-700 text-xs font-bold rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 tracking-wider">Full Name</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        <input type="text" name="name" required placeholder="e.g. Nirmal Gaihre"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 tracking-wider">Email Address</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        <input type="email" name="email" required placeholder="admin@abps.edu.np"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 tracking-wider">Default Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-key absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        <input type="text" name="password" required value="{{ Str::random(10) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-sm font-mono focus:bg-white focus:border-indigo-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 tracking-wider">Assign Role</label>
                    <div class="relative">
                        <i class="fa-solid fa-shield-halved absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:bg-white focus:border-indigo-500 outline-none transition-all appearance-none">
                            <option value="admin">Administrator</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 text-[10px] pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-triangle-exclamation text-amber-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-amber-700 font-medium">
                            Ensure the email is correct. PHPMailer will attempt to send these credentials to the user immediately upon clicking the button below.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#1d0647] hover:bg-black text-white font-bold py-4 rounded-xl text-xs uppercase tracking-[0.3em] transition-all shadow-lg shadow-indigo-900/20 active:scale-[0.98] flex items-center justify-center">
                    <i class="fa-solid fa-paper-plane mr-3"></i>
                    Create Account & Notify User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection