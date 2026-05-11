@extends('layouts.app')
@section('title', 'Notices')
@section('meta_description', 'Stay updated with the latest notices, exam schedules, and academic announcements from Aandhikhola Polytechnic Institute.')
@section('meta_author', 'Nirmal Gaihre')
@section('meta_keywords', 'API Notices, Exam Schedule Waling, API Announcements, CTEVT Notice Syangja')
@section('content')
<div class="bg-[#f8fafc] min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4">
        
        <h1 class="text-4xl font-bold text-slate-700 text-center mb-10">Notice Board</h1>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Choose Category:</label>
                    <form action="{{ route('notices.all') }}" method="GET" id="categoryForm">
                        <select name="category" onchange="document.getElementById('categoryForm').submit()" 
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="all">सबै सूचनाहरू (All Notices)</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="flex items-center gap-2 self-end">
                    <label class="text-sm font-medium text-gray-600">Search:</label>
                    <input type="text" id="tableSearch" class="border border-gray-300 rounded px-3 py-1.5 text-sm focus:ring-1 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#334155] text-white text-sm">
                            <th class="p-3 border border-slate-600 font-semibold w-16">क्र.सं.</th>
                            <th class="p-3 border border-slate-600 font-semibold">शीर्षक</th>
                            <th class="p-3 border border-slate-600 font-semibold w-40">प्रकाशन मिति</th>
                            <th class="p-3 border border-slate-600 font-semibold w-24 text-center">फाइल</th>
                            <th class="p-3 border border-slate-600 font-semibold w-32">प्रकाशक</th>
                        </tr>
                    </thead>
                    <tbody id="noticeTableBody">
                        @forelse($notices as $index => $notice)
                        <tr class="text-sm text-gray-700 hover:bg-gray-50 transition-colors border-b border-gray-200">
                            <td class="p-3 border border-gray-200 text-center">{{ $index + 1 }}</td>
                            <td class="p-3 border border-gray-200 font-medium">
                                <a href="{{ route('notices.show', $notice->id) }}" class="text-blue-600 hover:underline">
                                    {{ $notice->title }}
                                </a>
                            </td>
                            <td class="p-3 border border-gray-200 text-slate-500">
                                {{ $notice->nepali_date ?? $notice->created_at->format('Y-m-d') }}
                            </td>
                            <td class="p-3 border border-gray-200 text-center">
                                @if($notice->file_path)
                                    <a href="{{ asset('storage/' . $notice->file_path) }}" target="_blank" class="flex items-center justify-center gap-1 text-slate-600 hover:text-red-600">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                        <span class="text-xs font-bold uppercase">View</span>
                                    </a>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                            <td class="p-3 border border-gray-200 capitalize text-slate-500">
                                {{ $notice->publisher ?? 'admin' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-400 italic">No notices found in this category.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-xs text-gray-500 font-medium flex justify-between items-center">
                <p>Showing 1 to {{ $notices->count() }} of {{ $notices->count() }} entries</p>
                <div class="flex gap-1">
                    <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">Previous</button>
                    <button class="px-3 py-1 bg-blue-50 border border-blue-200 text-blue-600 rounded">1</button>
                    <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('tableSearch').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#noticeTableBody tr');
        
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection