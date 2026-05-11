@php
$nepaliDate = \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from(now())
->toNepaliDate(format: 'Y F j l', locale: 'np');

// Fallback for contactCount if not passed from a View Composer
$contactCount = $contactCount ?? 0;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | API CMS</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        background-color: #f8fafc;
        font-family: 'Inter', sans-serif;
        color: #1e293b;
    }

    .sidebar {
        background-color: #1d0647;
    }

    .nav-item {
        transition: 0.3s;
        border-left: 4px solid transparent;
        color: rgba(255, 255, 255, 0.7);
    }

    .nav-item:hover,
    .nav-item.active {
        background: rgba(255, 255, 255, 0.1);
        border-left: 4px solid #fbbf24;
        color: #ffffff;
    }

    .submenu-container {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease;
        background: rgba(0, 0, 0, 0.2);
    }

    .submenu-open {
        max-height: 400px;
    }

    .nav-group-label {
        padding: 10px 24px 4px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.25);
        border-top: 1px solid rgba(255, 255, 255, 0.07);
        margin-top: 6px;
    }

    [x-cloak] {
        display: none !important;
    }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <aside class="sidebar w-72 flex-shrink-0 flex flex-col shadow-2xl text-white">
        <div class="p-6 border-b border-indigo-900/50">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/img/logo.png') }}" class="w-10 h-10 bg-white rounded p-1 shadow-sm"
                    alt="Logo">
                <div>
                    <h1 class="font-bold text-xs tracking-wider uppercase leading-tight">Annapurna</h1>
                    <p class="text-[10px] text-indigo-300 font-medium uppercase tracking-tighter">Polytechnic Institute
                    </p>
                </div>
            </div>
        </div>

        <nav class="flex-1 mt-4 overflow-y-auto">

            {{-- ── GENERAL ── --}}
            <div class="nav-group-label">General</div>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-item flex items-center px-6 py-3.5 mb-1 text-sm font-semibold {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high mr-3 w-5"></i> Dashboard
            </a>

            <div class="nav-group-label">Hosting</div>

            <a href="{{ route('admin.hosting') }}"
                class="nav-item flex items-center px-6 py-3.5 mb-1 text-sm font-semibold {{ request()->is('admin/hosting') ? 'active' : '' }}">
                <i class="fa-solid fa-server mr-3 w-5 text-emerald-400"></i> Hosting Details
            </a>
            <div class="nav-group-label">Principal</div>

            <a href="{{ route('principal.edit') }}"
                class="nav-item flex items-center px-6 py-3.5 mb-1 text-sm font-semibold {{ request()->is('admin/principal-message') ? 'active' : '' }}">
                <i class="fa-solid fa-comment-dots mr-3 w-5"></i> Principal Message
            </a>
            {{-- ── CONTENT ── --}}
            <div class="nav-group-label">Content</div>

            {{-- Notices --}}
            <div x-data="{ open: {{ request()->is('admin/notices*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/notices*') ? 'active' : '' }}">
                    <span class="flex items-center"><i class="fa-solid fa-circle-exclamation mr-3 w-5"></i>
                        Notices</span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    {{-- New Manage Link --}}

                    <a href="{{ route('categories.index') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/notices/categories') ? 'text-yellow-400' : '' }}">
                        <i class="fa-solid fa-tags mr-2"></i> Notice Categories
                    </a>
                    <a href="{{ route('notices.create') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/notices/create') ? 'text-yellow-400' : '' }}">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Add New Notice
                    </a>
                    <a href="{{ route('notices.index') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/notices') ? 'text-yellow-400' : '' }}">
                        <i class="fa-solid fa-list-check mr-2"></i> Manage Notices
                    </a>
                </div>
            </div>

            {{-- Publications --}}
            <div x-data="{ open: {{ request()->is('admin/publications*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/publications*') ? 'active' : '' }}">
                    <span class="flex items-center"><i class="fa-solid fa-book-open mr-3 w-5"></i> Publications</span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    <a href="{{ route('pub-categories.index') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400"><i
                            class="fa-solid fa-folder-tree mr-2"></i> Categories</a>
                    <a href="{{ route('publications.index') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400"><i class="fa-solid fa-eye mr-2"></i>
                        Manage All</a>
                    <a href="{{ route('publications.create') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400"><i class="fa-solid fa-plus mr-2"></i> Add
                        New</a>
                </div>
            </div>

            {{-- Short Term Program --}}
            <div x-data="{ open: {{ request()->is('admin/announcements*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/announcements*') ? 'active' : '' }}">
                    <span class="flex items-center"><i class="fa-solid fa-bullhorn mr-3 w-5 text-yellow-400"></i> Short
                        Term Program</span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    <a href="{{ route('announcements.categories') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/announcements/categories') ? 'text-yellow-400' : '' }}"><i
                            class="fa-solid fa-layer-group mr-2"></i> Manage Categories</a>
                    <a href="{{ route('announcements.create') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/announcements/create') ? 'text-yellow-400' : '' }}"><i
                            class="fa-solid fa-plus-circle mr-2"></i> Add New</a>
                    <a href="{{ route('announcements.index') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/announcements') ? 'text-yellow-400' : '' }}"><i
                            class="fa-solid fa-list-check mr-2"></i> Manage All</a>
                </div>
            </div>

            {{-- ── PEOPLE ── --}}
            <div class="nav-group-label">People</div>

            {{-- Staff Management --}}
            <div x-data="{ open: {{ request()->is('admin/staff*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/staff*') ? 'active' : '' }}">
                    <span class="flex items-center">
                        <i class="fa-solid fa-users-gear mr-3 w-5"></i> Staff Management
                    </span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    {{-- Added Category Link Below --}}
                    <a href="{{ route('staff-categories.index') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/staff/categories') ? 'text-yellow-400' : '' }}">
                        <i class="fa-solid fa-layer-group mr-2"></i> Staff Categories
                    </a>
                    <a href="{{ route('staff.create') }}" class="block px-14 py-2 text-xs hover:text-yellow-400">
                        <i class="fa-solid fa-user-plus mr-2"></i> Add Staff
                    </a>
                    <a href="{{ route('staff.index') }}" class="block px-14 py-2 text-xs hover:text-yellow-400">
                        <i class="fa-solid fa-list-check mr-2"></i> Manage Staff
                    </a>
                    <a href="{{ route('staff.hierarchy') }}" class="block px-14 py-2 text-xs hover:text-yellow-400">
                        <i class="fa-solid fa-sitemap mr-2"></i> Hierarchy Order
                    </a>
                </div>
            </div>

            {{-- ID Cards --}}
            <div x-data="{ open: {{ request()->is('admin/id-cards*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/id-cards*') ? 'active' : '' }}">
                    <span class="flex items-center"><i class="fa-solid fa-address-card mr-3 w-5"></i> ID Cards</span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    <a href="{{ route('id_cards.create') }}" class="block px-14 py-2 text-xs hover:text-yellow-400"><i
                            class="fa-solid fa-plus-square mr-2"></i> Create Card</a>
                    <a href="{{ route('id_cards.index') }}" class="block px-14 py-2 text-xs hover:text-yellow-400"><i
                            class="fa-solid fa-table-list mr-2"></i> Manage All</a>
                </div>
            </div>

            {{-- Certificates --}}
            <div x-data="{ open: {{ request()->is('admin/certificates*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/certificates*') ? 'active' : '' }}">
                    <span class="flex items-center"><i class="fa-solid fa-file-medal mr-3 w-5"></i> Certificates</span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    <a href="{{ route('certificates.create') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/certificates/create') ? 'text-yellow-400' : '' }}"><i
                            class="fa-solid fa-circle-plus mr-2"></i> Add Certificate</a>
                    <a href="{{ route('certificates.index') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/certificates') ? 'text-yellow-400' : '' }}"><i
                            class="fa-solid fa-database mr-2"></i> Manage Records</a>
                </div>
            </div>



            {{-- ── MEDIA ── --}}
            <div class="nav-group-label">Media</div>

            {{-- Media parent group --}}
            <div
                x-data="{ open: {{ request()->is('admin/gallery*') || request()->is('admin/videos*') || request()->is('admin/blog*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/gallery*') || request()->is('admin/videos*') || request()->is('admin/blog*') ? 'active' : '' }}">
                    <span class="flex items-center"><i class="fa-solid fa-photo-film mr-3 w-5 text-sky-400"></i>
                        Media</span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>

                <div class="submenu-container" :class="open ? 'submenu-open' : ''">

                    {{-- Gallery sub-section --}}
                    <div x-data="{ subOpen: {{ request()->is('admin/gallery*') ? 'true' : 'false' }} }">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex items-center justify-between px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/gallery*') ? 'text-yellow-400' : 'text-white/60' }}">
                            <span><i class="fa-solid fa-images mr-2"></i> Gallery</span>
                            <i class="fa-solid fa-chevron-right text-[9px] transition-transform"
                                :class="subOpen ? 'rotate-90' : ''"></i>
                        </button>
                        <div class="submenu-container" :class="subOpen ? 'submenu-open' : ''">
                            <a href="{{ route('gallery.index') }}"
                                class="block px-20 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/gallery') ? 'text-yellow-400' : '' }}">
                                <i class="fa-solid fa-grip mr-2"></i> Manage Gallery
                            </a>
                        </div>
                    </div>

                    {{-- Video sub-section --}}
                    <div x-data="{ subOpen: {{ request()->is('admin/videos*') ? 'true' : 'false' }} }">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex items-center justify-between px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/videos*') ? 'text-yellow-400' : 'text-white/60' }}">
                            <span><i class="fa-solid fa-circle-play mr-2 text-red-400"></i> Video</span>
                            <i class="fa-solid fa-chevron-right text-[9px] transition-transform"
                                :class="subOpen ? 'rotate-90' : ''"></i>
                        </button>
                        <div class="submenu-container" :class="subOpen ? 'submenu-open' : ''">
                            <a href="{{ route('videos.create') }}"
                                class="block px-20 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/videos/create') ? 'text-yellow-400' : '' }}">
                                <i class="fa-solid fa-plus-circle mr-2"></i> Add Video
                            </a>
                            <a href="{{ route('videos.index') }}"
                                class="block px-20 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/videos') ? 'text-yellow-400' : '' }}">
                                <i class="fa-solid fa-clapperboard mr-2"></i> Manage Videos
                            </a>
                        </div>
                    </div>

                    {{-- Blog sub-section --}}
                    <div x-data="{ subOpen: {{ request()->is('admin/blog*') ? 'true' : 'false' }} }">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex items-center justify-between px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/blog*') ? 'text-yellow-400' : 'text-white/60' }}">
                            <span><i class="fa-solid fa-newspaper mr-2"></i> Blog</span>
                            <i class="fa-solid fa-chevron-right text-[9px] transition-transform"
                                :class="subOpen ? 'rotate-90' : ''"></i>
                        </button>
                        <div class="submenu-container" :class="subOpen ? 'submenu-open' : ''">
                            <a href="{{ route('blog.create') }}"
                                class="block px-20 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/blog/create') ? 'text-yellow-400' : '' }}">
                                <i class="fa-solid fa-feather-pointed mr-2"></i> Add New Post
                            </a>
                            <a href="{{ route('blog.index') }}"
                                class="block px-20 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/blog') ? 'text-yellow-400' : '' }}">
                                <i class="fa-solid fa-sliders mr-2"></i> Manage Posts
                            </a>
                        </div>
                    </div>

                    {{-- Resources sub-section (Fixed version of your "Model" section) --}}
                    <div x-data="{ subOpen: {{ request()->is('admin/resources*') ? 'true' : 'false' }} }">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex items-center justify-between px-14 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/resources*') ? 'text-yellow-400' : 'text-white/60' }}">
                            <span><i class="fa-solid fa-folder-open mr-2 text-blue-400"></i> Resources</span>
                            <i class="fa-solid fa-chevron-right text-[9px] transition-transform"
                                :class="subOpen ? 'rotate-90' : ''"></i>
                        </button>
                        <div class="submenu-container" :class="subOpen ? 'submenu-open' : ''">
                            <a href="{{ route('resources.index') }}"
                                class="block px-20 py-2 text-xs hover:text-yellow-400 {{ request()->is('admin/resources*') ? 'text-yellow-400' : '' }}">
                                <i class="fa-solid fa-list-check mr-2"></i> Manage Resources
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="nav-group-label">Inquiries</div>

            {{-- Contact Messages with Notification Badge --}}
            <div x-data="{ open: {{ request()->is('admin/contacts*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/contacts*') ? 'active' : '' }}">
                    <span class="flex items-center">
                        <i class="fa-solid fa-envelope mr-3 w-5"></i>
                        Messages
                        @if($contactCount > 0)
                        <span class="ml-2 bg-red-500 text-white text-[9px] px-1.5 py-0.5 rounded-full animate-pulse">
                            {{ $contactCount }}
                        </span>
                        @endif
                    </span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    <a href="{{ route('admin.contacts.index') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400">
                        <i class="fa-solid fa-list-check mr-2"></i> View All Inquiries
                    </a>
                </div>
            </div>

            {{-- ── SYSTEM ── --}}
            <div class="nav-group-label">System</div>

            {{-- Admin Users --}}
            <div x-data="{ open: {{ request()->is('admin/users*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <span class="flex items-center"><i class="fa-solid fa-user-shield mr-3 w-5"></i> Admin Users</span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    <a href="{{ route('users.create') }}" class="block px-14 py-2 text-xs hover:text-yellow-400"><i
                            class="fa-solid fa-user-plus mr-2"></i> Add Admin</a>
                    <a href="{{ route('users.index') }}" class="block px-14 py-2 text-xs hover:text-yellow-400"><i
                            class="fa-solid fa-users-gear mr-2"></i> Manage Admins</a>
                </div>
            </div>
            <div class="nav-group-label">What's New</div>

            <a href="{{ route('admin.updates') }}"
                class="nav-item flex items-center px-6 py-3.5 mb-1 text-sm font-semibold {{ request()->is('admin/updates*') ? 'active' : '' }}">

                {{-- Icon and Text Container --}}
                <div class="flex items-center flex-1">
                    <i class="fa-solid fa-rocket mr-3 w-5"></i>
                    <span>Released Notes</span>
                </div>

                {{-- Notification Badge --}}
                <span
                    class="flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-[10px] font-bold text-white shadow-sm ring-2 ring-white">
                    1
                </span>
            </a>
            {{-- ── GENERAL ── --}}
            <div class="nav-group-label">User Guide</div>

            <a href="{{ route('admin.guide') }}"
                class="nav-item flex items-center px-6 py-3.5 mb-1 text-sm font-semibold {{ request()->is('admin.guide') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high mr-3 w-5"></i> User Guide
            </a>

            <!-- Login records -->
            <div x-data="{ open: {{ request()->is('admin/login-logs*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="nav-item w-full flex items-center px-6 py-3.5 justify-between {{ request()->is('admin/login-logs*') ? 'active' : '' }}">
                    <span class="flex items-center">
                        <i class="fa-solid fa-clock-rotate-left mr-3 w-5"></i> Login Records
                    </span>
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform"
                        :class="open ? 'rotate-90' : ''"></i>
                </button>
                <div class="submenu-container" :class="open ? 'submenu-open' : ''">
                    <a href="{{ route('admin.login_logs') }}" class="block px-14 py-2 text-xs hover:text-yellow-400">
                        <i class="fa-solid fa-list-check mr-2"></i> Activity Logs
                    </a>
                    <a href="{{ route('admin.security_stats') }}"
                        class="block px-14 py-2 text-xs hover:text-yellow-400">
                        <i class="fa-solid fa-shield-halved mr-2"></i> Security Stats
                    </a>
                </div>
            </div>



        </nav>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-10">
            <div class="flex items-center space-x-4">
                <span class="text-xs font-bold text-teal-600 uppercase tracking-widest">CMS Dashboard</span>

                <div class="hidden md:flex flex-col border-r border-slate-200 pr-4">
                    {{-- Static Nepali Date from Server --}}
                    <span id="real-time-date" class="text font-bold text-indigo-500  tracking whitespace-nowrap">
                        वि सं {{ $nepaliDate }}
                    </span>
                </div>
                {{-- Dynamic Ticking Clock --}}
                <span id="real-time-clock" class="text-sm font-bold text-indigo-600">००:००:०० बिहान</span>


            </div>

            <div class="flex items-center space-x-6">
                @auth
                <div class="flex items-center space-x-3 border-r border-slate-100 pr-6">
                    <div class="text-right">
                        <p class="text-xs font-bold text-slate-700">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">
                            {{ Auth::user()->role ?? 'Administrator' }}
                        </p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1d0647&color=fff"
                        class="w-8 h-8 rounded-full shadow-sm" alt="Avatar">
                </div>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="group flex items-center text-slate-400 hover:text-red-600 transition-colors">
                        <i class="fa-solid fa-power-off text-sm mr-2 group-hover:rotate-12 transition-transform"></i>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Logout</span>
                    </button>
                </form>
                @else
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}"
                        class="text-xs font-bold text-indigo-600 uppercase tracking-widest hover:text-indigo-800">
                        <i class="fa-solid fa-right-to-bracket mr-1"></i> Admin Login
                    </a>
                </div>
                @endauth
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-10">
            @yield('content')
        </main>
    </div>

    <script>
    function updateClock() {
        const now = new Date();

        // Standard English format to extract numbers and period
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        };

        let timeString = now.toLocaleTimeString('en-US', timeOptions);

        // Conversion Maps
        const enDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        const npDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

        // Replace digits and AM/PM
        let formattedTime = timeString.replace(/[0-9]/g, s => npDigits[enDigits.indexOf(s)])
            .replace('AM', 'बिहान')
            .replace('PM', 'बेलुका');

        const clockEl = document.getElementById('real-time-clock');
        if (clockEl) {
            clockEl.textContent = formattedTime;
        }
    }

    // Run immediately and then every second
    updateClock();
    setInterval(updateClock, 1000);
    </script>
</body>

</html>