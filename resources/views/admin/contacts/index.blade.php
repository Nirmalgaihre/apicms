@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        
        <div class="p-6 border-b flex justify-between items-center bg-slate-50">
            <div>
                <h2 class="font-bold text-slate-800 text-lg">Inbound Inquiries</h2>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1">Managed Contact Messages</p>
            </div>
            <div>
                <span class="bg-indigo-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase">
                    Total: {{ $contacts->total() }}
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-800 text-white">
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider">Sender</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider">Subject & Message</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider">Tracking Meta</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider text-right">Received</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
    @forelse($contacts as $contact)
    <tr class="hover:bg-slate-50/80 transition-colors">
        {{-- 1. Sender Details --}}
        <td class="px-6 py-4">
            <div class="flex flex-col">
                <span class="text-sm font-bold text-slate-700">{{ $contact->name }}</span>
                <span class="text-xs text-indigo-600">{{ $contact->email }}</span>
                <span class="text-[9px] text-slate-400 mt-1 font-mono">IP: {{ $contact->ip_address ?? '0.0.0.0' }}</span>
            </div>
        </td>

        {{-- 2. Subject & Message --}}
        <td class="px-6 py-4">
            <div class="max-w-xs">
                <p class="text-xs font-bold text-slate-800 mb-1">{{ $contact->subject ?? 'No Subject' }}</p>
                <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed italic">
                    "{{ $contact->message }}"
                </p>
            </div>
        </td>

        {{-- 3. Tracking Meta (This is where it was crashing) --}}
        <td class="px-6 py-4">
            <div class="flex flex-col gap-1.5">
                <span class="bg-emerald-50 text-emerald-700 text-[9px] font-black px-2 py-0.5 rounded border border-emerald-100 w-fit">
                    <i class="fa-solid fa-location-dot mr-1"></i> {{ $contact->location_data ?? 'No GPS' }}
                </span>
                <span class="text-[10px] text-slate-400 truncate w-40" title="{{ $contact->device ?? 'Unknown' }}">
                    <i class="fa-solid fa-desktop mr-1 opacity-50"></i> 
                    {{ isset($contact->device) ? Str::limit($contact->device, 30) : 'Unknown Device' }}
                </span>
            </div>
        </td>

        {{-- 4. Received Time --}}
        <td class="px-6 py-4 text-right">
            <p class="text-[10px] font-bold text-slate-500 uppercase">
                {{ \Carbon\Carbon::parse($contact->created_at)->format('M d, Y') }}
            </p>
            <p class="text-[9px] text-slate-400 uppercase">
                {{ \Carbon\Carbon::parse($contact->created_at)->format('h:i A') }}
            </p>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="px-6 py-20 text-center text-slate-400 italic">
            No inquiries found in the database.
        </td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>

        <div class="p-4 bg-slate-50 border-t border-slate-100">
            {{ $contacts->links() }}
        </div>
    </div>
</div>
@endsection