@extends('layouts.admin')

@section('title', 'Manage Certificates')

@section('content')
<div class="max-w-6xl mx-auto space-y-4">
    <div class="flex justify-between items-center px-2">
        <div>
            <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Student Certificates</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Character & Transfer Certificate Records</p>
        </div>
        <a href="{{ route('certificates.create') }}" class="bg-[#1d0647] text-white px-6 py-2.5 rounded-xl font-bold text-xs shadow-lg hover:bg-black transition">
            <i class="fa-solid fa-plus mr-2"></i> ADD NEW ENTRY
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr class="text-[10px] uppercase font-black text-slate-400 tracking-wider">
                    <th class="px-6 py-4">Issue No</th>
                    <th class="px-6 py-4">Student Details</th>
                    <th class="px-6 py-4">Course & Year</th>
                    <th class="px-6 py-4">Result</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($certificates as $c)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-mono text-indigo-600 font-bold">{{ $c->issue_no }}</td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-slate-700">{{ $c->full_name }}</p>
                        <p class="text-[10px] text-slate-400 uppercase font-semibold">Reg: {{ $c->ctevt_reg_no }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs font-bold text-slate-600">{{ $c->course }}</p>
                        <p class="text-[10px] text-indigo-400 font-black uppercase italic">Batch: {{ $c->year_from }} - {{ $c->year_to }} BS</p>
                    </td>
                    <td class="px-6 py-4 text-xs">
                        <span class="font-bold text-slate-700">{{ $c->division }}</span>
                        <span class="text-slate-400 ml-1">({{ $c->percentage }}%)</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('certificates.print', $c->id) }}" target="_blank" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition shadow-sm" title="Print Certificate">
                                <i class="fa-solid fa-print text-xs"></i>
                            </a>

                            <a href="{{ route('certificates.edit', $c->id) }}" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm" title="Edit Data">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>

                            <form action="{{ route('certificates.destroy', $c->id) }}" method="POST" class="inline" onsubmit="return confirm('Confirm deletion?')">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection