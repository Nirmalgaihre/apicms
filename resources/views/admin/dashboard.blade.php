@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    {{-- ── HEADER ── --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}</h2>
            <p class="text-sm text-gray-400 mt-0.5">
                {{ now()->timezone('Asia/Kathmandu')->format('l, F j, Y') }} &mdash; Kathmandu Time
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div
                class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse inline-block"></span>
                System Online
            </div>
            <span class="text-xs text-gray-400 font-medium">
                Last login: {{ auth()->user()->updated_at->timezone('Asia/Kathmandu')->format('M d · h:i A') }}
            </span>
        </div>
    </div>

    <!-- Main Modal Backdrop -->
    <div id="guideModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4">

        <!-- Modal Content Box -->
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden transform transition-all">

            <!-- Header (Close Button Only) -->
            <div class="flex justify-end p-4">
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="px-8 pb-8 text-center">
                <!-- Icon -->
                <div class="mb-4 flex justify-center">
                    <div class="bg-blue-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <h4 class="text-2xl font-bold text-gray-800 mb-2">System User Manual</h4>
                <p class="text-gray-500 mb-6 leading-relaxed">
                    To learn how to control data, upload resources, and manage the CMS, please view our full
                    documentation.
                </p>

                <!-- Primary Action Box -->
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Detailed Instructions</p>
                    <a href="/admin/user-guide"
                        class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Go to Admin User Guide
                    </a>
                </div>

                <!-- Secondary Close -->
                <button onclick="closeModal()"
                    class="mt-6 text-sm text-gray-400 hover:text-gray-600 underline transition-colors">
                    Close and continue
                </button>
            </div>
        </div>
    </div>
    {{-- ── STAT CARDS ── --}}
    <div>
        <!-- New User Guidance Section -->
        <div class="mb-6">
            <div
                class="bg-white p-5 rounded-xl border border-blue-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <i class="fa-solid fa-circle-info text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">Are you new in the dashboard?</h4>
                        <p class="text-[12px] text-gray-500">Read the user manual for instructions and latest system
                            updates.</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.guide') }}"
                        class="text-[11px] font-bold bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors uppercase">
                        See User Manual
                    </a>
                    <a href="{{ route('admin.updates') }}"
                        class="text-[11px] font-bold bg-gray-100 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors uppercase">
                        View Updates
                    </a>
                </div>
            </div>
        </div>
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Overview</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-circle-exclamation text-blue-500"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Notices</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $noticesCount }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-violet-50 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-users-gear text-violet-500"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Staff</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $staffCount }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-address-card text-amber-500"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">ID Cards</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $idCardsCount }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-rose-50 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-user-shield text-rose-500"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Admins</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $userCount }}</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ── MEDIA STATS ── --}}
    <div>
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Media & Content</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-teal-50 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-newspaper text-teal-500"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Blogs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $blogCount }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-pink-50 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-images text-pink-500"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Gallery</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $galleryCount }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-book-open text-orange-500"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Publications</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $publicationCount }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-circle-play text-red-500"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Videos</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $videoCount ?? 0 }}</p>
                </div>
            </div>

        </div>


    </div>

    {{-- ── MAIN CONTENT ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Recent Activity --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Recent Notices --}}
            <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                        <h4 class="text-sm font-bold text-gray-700">Recent Notices</h4>
                    </div>
                    <a href="{{ route('notices.all') }}"
                        class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                        View all <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
                <table class="w-full text-left">
                    <tbody class="text-sm divide-y divide-gray-50">
                        @forelse($recentNotices as $notice)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-7 h-7 rounded bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-bullhorn text-blue-400 text-[10px]"></i>
                                    </div>
                                    <span class="font-semibold text-gray-800 text-sm">{{ $notice->title }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-xs text-gray-400 text-right whitespace-nowrap">
                                {{ $notice->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-10 text-center text-gray-300 text-sm">No notices yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>



            {{-- Recent Blogs --}}
            <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-teal-500"></div>
                        <h4 class="text-sm font-bold text-gray-700">Recent Blog Posts</h4>
                    </div>
                    <a href="{{ route('blog.index') }}"
                        class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                        View all <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
                <table class="w-full text-left">
                    <tbody class="text-sm divide-y divide-gray-50">
                        @forelse($recentBlogs as $blog)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-7 h-7 rounded bg-teal-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-feather-pointed text-teal-400 text-[10px]"></i>
                                    </div>
                                    <span class="font-semibold text-gray-800 text-sm">{{ $blog->title }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-right">
                                <span
                                    class="bg-green-50 text-green-700 border border-green-100 text-[10px] px-2.5 py-1 rounded-full font-bold uppercase">Published</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-10 text-center text-gray-300 text-sm">No blog posts yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{-- RIGHT: Quick Actions --}}
        <div class="space-y-6">

            {{-- Quick Links --}}
            <div class="bg-white border border-gray-100 rounded-xl p-5">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Quick Actions</p>

                <div class="space-y-2">

                    {{-- Notices group --}}
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest pt-1">Notices</p>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('notices.create') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-blue-50 hover:bg-blue-100 transition group">
                            <i class="fa-solid fa-pen-to-square text-blue-500 text-xs"></i>
                            <span class="text-xs font-semibold text-blue-800">Add Notice</span>
                        </a>
                        <a href="{{ route('categories.index') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-tags text-gray-400 text-xs"></i>
                            <span class="text-xs font-semibold text-gray-600">Categories</span>
                        </a>
                    </div>

                    {{-- Staff group --}}
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest pt-2">Staff & Users</p>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('staff.create') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-violet-50 hover:bg-violet-100 transition">
                            <i class="fa-solid fa-user-plus text-violet-500 text-xs"></i>
                            <span class="text-xs font-semibold text-violet-800">Add Staff</span>
                        </a>
                        <a href="{{ route('users.create') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-user-shield text-gray-400 text-xs"></i>
                            <span class="text-xs font-semibold text-gray-600">Add Admin</span>
                        </a>
                    </div>

                    {{-- Media group --}}
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest pt-2">Media</p>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('gallery.index') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-pink-50 hover:bg-pink-100 transition">
                            <i class="fa-solid fa-images text-pink-500 text-xs"></i>
                            <span class="text-xs font-semibold text-pink-800">Gallery</span>
                        </a>
                        <a href="{{ route('videos.create') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-circle-play text-red-400 text-xs"></i>
                            <span class="text-xs font-semibold text-gray-600">Add Video</span>
                        </a>
                        <a href="{{ route('blog.create') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-teal-50 hover:bg-teal-100 transition">
                            <i class="fa-solid fa-feather-pointed text-teal-500 text-xs"></i>
                            <span class="text-xs font-semibold text-teal-800">New Blog</span>
                        </a>
                        <a href="{{ route('publications.create') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-book-open text-orange-400 text-xs"></i>
                            <span class="text-xs font-semibold text-gray-600">Add Publication</span>
                        </a>
                    </div>

                    {{-- Programs group --}}
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest pt-2">Programs</p>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('announcements.create') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-amber-50 hover:bg-amber-100 transition">
                            <i class="fa-solid fa-bullhorn text-amber-500 text-xs"></i>
                            <span class="text-xs font-semibold text-amber-800">Add Program</span>
                        </a>
                        <a href="{{ route('certificates.create') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <i class="fa-solid fa-file-medal text-gray-400 text-xs"></i>
                            <span class="text-xs font-semibold text-gray-600">Add Certificate</span>
                        </a>
                    </div>
                </div>

                {{-- ID Card CTA --}}
                <a href="{{ route('id_cards.create') }}"
                    class="mt-5 w-full flex items-center justify-center gap-2 bg-[#1d0647] hover:bg-[#2e0a6b] text-white text-xs font-bold py-3 rounded-lg transition tracking-wide">
                    <i class="fa-solid fa-address-card"></i>
                    Generate ID Card
                </a>
            </div>

            {{-- Server Status --}}
            <div class="bg-white border border-gray-100 rounded-xl p-5">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">System Info</p>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Status</span>
                        <span class="flex items-center gap-1.5 text-xs font-bold text-green-600">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse inline-block"></span>
                            Online
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Host</span>
                        <span class="text-xs font-mono text-gray-700">s1310.sgp1.cpanel</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Timezone</span>
                        <span class="text-xs font-semibold text-gray-700">GMT +5:45</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Your Role</span>
                        <span
                            class="text-xs font-bold text-indigo-600">{{ auth()->user()->role ?? 'Administrator' }}</span>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.hosting') }}"
                        class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                        View hosting details <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById('guideModal');

    // Check if user has visited before
    if (!localStorage.getItem('hasVisitedGuide')) {
        // Show the modal by removing 'hidden'
        modal.classList.remove('hidden');
    }
});

function closeModal() {
    const modal = document.getElementById('guideModal');
    modal.classList.add('hidden');

    // Save to localStorage so it doesn't open again
    localStorage.setItem('hasVisitedGuide', 'true');
}
</script>
@endsection