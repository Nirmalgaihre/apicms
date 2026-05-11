@extends('layouts.app')
@section('title', 'Publications & Reports')
@section('meta_description', 'Browse academic journals, annual reports, and technical publications from the faculty and students of Annapurna Polytechnic Institute.')
@section('meta_author', 'Nirmal Gaihre')
@section('meta_keywords', 'Technical Publications Nepal, API Annual Report, Kaski, Research papers API')
@section('content')
<section class="py-12 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4">
        
        <h1 class="text-4xl font-extrabold text-slate-800 text-center mb-10">Publications</h1>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-white">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    
                    <div class="flex flex-col w-full md:w-1/3">
                        <label class="text-sm font-bold text-slate-700 mb-2">Choose Category:</label>
                        <select id="categoryFilter" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                            <option value="">सबै प्रकाशनहरू (All Publications)</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->title }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col w-full md:w-1/4">
                        <label class="text-sm font-bold text-slate-700 mb-2">Search:</label>
                        <input type="text" id="searchInput" placeholder="Search publications..." 
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-800 text-white">
                            <th class="px-6 py-4 text-sm font-bold uppercase tracking-wider w-16">क्र.सं.</th>
                            <th class="px-6 py-4 text-sm font-bold uppercase tracking-wider">शीर्षक (Title)</th>
                            <th class="px-6 py-4 text-sm font-bold uppercase tracking-wider">प्रकाशन मिति</th>
                            <th class="px-6 py-4 text-sm font-bold uppercase tracking-wider text-center">फाइल</th>
                            <th class="px-6 py-4 text-sm font-bold uppercase tracking-wider">प्रकाशक</th>
                        </tr>
                    </thead>
                    <tbody id="publicationTable" class="divide-y divide-slate-200">
                        @forelse($publications as $index => $pub)
                        <tr class="hover:bg-slate-50 transition-colors publication-row" data-category="{{ $pub->category }}">
                            <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                {{ ($publications->currentPage() - 1) * $publications->perPage() + $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ $pub->file_path ? asset('storage/'.$pub->file_path) : '#' }}" target="_blank" class="text-blue-700 font-bold hover:underline text-sm">
                                    {{ $pub->title }}
                                </a>
                                <p class="text-[11px] text-slate-400 mt-1 uppercase">{{ $pub->category }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $pub->nepali_date ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($pub->file_path)
                                    <a href="{{ asset('storage/'.$pub->file_path) }}" target="_blank" class="text-slate-700 hover:text-indigo-600">
                                        <i class="fa-solid fa-file-pdf mr-1"></i> <span class="text-xs font-black uppercase">VIEW</span>
                                    </a>
                                @else
                                    <span class="text-slate-300 text-xs">No File</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 italic">
                                {{ $pub->publisher ?? 'Admin' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-400 italic">
                                No publications found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
                <div>
                    Showing {{ $publications->firstItem() }} to {{ $publications->lastItem() }} of {{ $publications->total() }} entries
                </div>
                <div>
                    {{ $publications->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#publicationTable tr.publication-row');
        
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    document.getElementById('categoryFilter').addEventListener('change', function() {
        let filter = this.value;
        let rows = document.querySelectorAll('#publicationTable tr.publication-row');
        
        rows.forEach(row => {
            if (!filter || row.getAttribute('data-category') === filter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection