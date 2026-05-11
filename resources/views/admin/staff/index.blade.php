@extends('layouts.admin')

@section('title', 'Manage Staff')

@section('content')
<div class="max-w-5xl mx-auto space-y-4">
    
    <div class="flex justify-between items-center px-2">
        <div>
            <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Manage Staff</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Edit, Update, or Remove Staff Members</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('staff.hierarchy') }}" class="bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl font-bold text-xs shadow-sm hover:bg-slate-50 transition">
                <i class="fa-solid fa-arrow-up-down-left-right mr-2 text-indigo-500"></i> HIERARCHY
            </a>
            <a href="{{ route('staff.create') }}" class="bg-[#1d0647] text-white px-6 py-2 rounded-xl font-bold text-xs shadow-lg hover:bg-black transition">
                <i class="fa-solid fa-plus mr-2"></i> ADD NEW
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm border-collapse">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr class="text-[10px] uppercase font-black text-slate-400 tracking-wider">
                    <th class="px-6 py-4">Staff Member</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Contact Info</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($staff as $s)
                <tr class="hover:bg-slate-50/50 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $s->staff_img ? asset('storage/' . $s->staff_img) : 'https://ui-avatars.com/api/?name='.urlencode($s->staff_name) }}" 
                                 class="w-11 h-11 rounded-full object-cover border-2 border-white shadow-sm ring-1 ring-slate-100">
                            <div>
                                <p class="font-bold text-slate-700 leading-tight">{{ $s->staff_name }}</p>
                                <p class="text-[10px] text-slate-400 font-semibold uppercase">Position: {{ $s->position }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded-full uppercase tracking-tighter">
                            {{ $s->category_title ?? 'General' }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <div class="text-[11px] font-bold text-slate-600 flex flex-col space-y-0.5">
                            <span><i class="fa-solid fa-phone mr-1 text-slate-300"></i> {{ $s->staff_phone ?? 'N/A' }}</span>
                            <span class="text-slate-400 lowercase font-medium italic">{{ $s->staff_email ?? '' }}</span>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="{{ route('staff.edit', $s->id) }}" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>

                            <form action="{{ route('staff.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove this staff member?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-user-slash text-slate-200 text-4xl mb-3"></i>
                            <p class="text-slate-400 font-bold uppercase text-xs tracking-widest">No staff members found</p>
                            <a href="{{ route('staff.create') }}" class="mt-4 text-indigo-600 text-xs font-black underline uppercase">Add your first staff member</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-end px-4">
        <p class="text-[10px] text-slate-400 font-bold uppercase">Total Staff: {{ $staff->count() }}</p>
    </div>
</div>
@endsection