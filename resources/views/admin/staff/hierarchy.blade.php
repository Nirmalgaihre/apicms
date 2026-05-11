@extends('layouts.admin')

@section('title', 'Staff Hierarchy Reorder')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Staff Hierarchy</h2>
            <p class="text-sm text-slate-500">Drag and drop rows to reorder how staff appear on the website.</p>
        </div>
        <a href="{{ route('staff.index') }}" class="text-sm font-bold text-indigo-600 hover:underline">
            <i class="fa-solid fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 bg-amber-50 border-b border-amber-100 flex items-center gap-3">
            <i class="fa-solid fa-circle-info text-amber-500"></i>
            <p class="text-xs text-amber-700 font-medium">Changes are saved automatically after dragging.</p>
        </div>

        <table class="w-full text-left border-collapse">
            <thead class="bg-[#1d0647] text-white">
                <tr>
                    <th class="p-4 w-12"></th>
                    <th class="p-4 text-[10px] font-black uppercase tracking-widest">Staff Member</th>
                    <th class="p-4 text-[10px] font-black uppercase tracking-widest">Current Position</th>
                </tr>
            </thead>
            <tbody id="sortable-list">
                @foreach($staff as $member)
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move" data-id="{{ $member->id }}">
                    <td class="p-4 text-center text-slate-300 handle">
                        <i class="fa-solid fa-grip-vertical text-lg"></i>
                    </td>
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            @if($member->staff_img)
                                <img src="{{ asset('storage/'.$member->staff_img) }}" class="w-8 h-8 rounded-lg object-cover">
                            @else
                                <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-[10px] text-slate-400">NA</div>
                            @endif
                            <div>
                                <div class="text-sm font-bold text-slate-800">{{ $member->staff_name }}</div>
                                <div class="text-[10px] text-slate-400 uppercase font-bold tracking-tight">ID: #{{ $member->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] font-bold pos-label">
                            #{{ $member->position }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- SortableJS CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const el = document.getElementById('sortable-list');
        
        Sortable.create(el, {
            animation: 150,
            handle: '.handle', // Dragging restricted to the grip icon
            ghostClass: 'bg-indigo-50',
            onEnd: function() {
                let order = [];
                // Collect all IDs in the new sequence
                document.querySelectorAll('#sortable-list tr').forEach((row) => {
                    order.push(row.getAttribute('data-id'));
                });

                // Update visual labels (optional but helpful)
                document.querySelectorAll('.pos-label').forEach((label, index) => {
                    label.innerText = '#' + (index + 1);
                });

                // Send the new order to the Controller
                fetch("{{ route('staff.reorder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'success') {
                        // Optional: Show a small toast notification
                        console.log('Order saved successfully');
                    }
                })
                .catch(error => {
                    alert('Error saving order. Please refresh and try again.');
                    console.error('Error:', error);
                });
            }
        });
    });
</script>
@endsection