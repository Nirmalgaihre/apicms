@extends('layouts.admin')

@section('title', 'System Updates')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-slate-200 pb-8 mb-10">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">System Evolution & Updates</h2>
            <p class="text-slate-500 text-sm mt-1">Official changelog for Annapurna Polytechnic Institute CMS</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
            <div class="bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-right">
                <span class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Current Build</span>
                <span class="text-sm font-bold text-indigo-600">v1.4.0 Stable</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
        <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                    <i class="fa-solid fa-code-merge text-xs"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Version</span>
            </div>
            <p class="text-sm font-bold text-slate-800 ml-9">1.4.0</p>
        </div>
        <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                    <i class="fa-solid fa-calendar-check text-xs"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Released</span>
            </div>
            <p class="text-sm font-bold text-slate-800 ml-9">May 07, 2026</p>
        </div>
        <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                    <i class="fa-solid fa-database text-xs"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Database</span>
            </div>
            <p class="text-sm font-bold text-slate-800 ml-9">MySQL 8.0</p>
        </div>
        <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-slate-50 rounded-lg text-slate-600">
                    <i class="fa-solid fa-server text-xs"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Runtime</span>
            </div>
            <p class="text-sm font-bold text-slate-800 ml-9">PHP 8.4 / L13</p>
        </div>
    </div>

    <div class="relative space-y-12 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-slate-200">

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-slate-50 bg-indigo-600 text-white shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <i class="fa-solid fa-check text-xs"></i>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[45%] bg-white p-6 rounded-2xl border border-slate-200 shadow-sm transition-hover hover:border-indigo-300">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-indigo-600 px-2.5 py-1 bg-indigo-50 rounded-md">v1.4.0 (Latest)</span>
                    <span class="text-[10px] font-medium text-slate-400">MAY 2026</span>
                </div>
                <h4 class="text-md font-bold text-slate-800 mb-4">Directory Optimization & Interface Polishing</h4>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-arrow-down-1-9 text-slate-400 mt-1"></i>
                        <p class="text-xs text-slate-600 leading-relaxed"><strong class="text-slate-800">Numerical Sorting:</strong> Refined SQL logic to handle double-digit positions (10+) accurately across all staff lists.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-display text-slate-400 mt-1"></i>
                        <p class="text-xs text-slate-600 leading-relaxed"><strong class="text-slate-800">Responsive Grid:</strong> Optimized staff directory for dual-column viewing on mobile devices.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-address-card text-slate-400 mt-1"></i>
                        <p class="text-xs text-slate-600 leading-relaxed"><strong class="text-slate-800">Interaction UX:</strong> Implemented single-tap communication icons for faculty phone and email services.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-slate-50 bg-slate-200 text-slate-500 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <i class="fa-solid fa-globe text-xs"></i>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[45%] bg-white p-6 rounded-2xl border border-slate-200 opacity-80 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-slate-500 px-2.5 py-1 bg-slate-100 rounded-md">v1.3.0</span>
                    <span class="text-[10px] font-medium text-slate-400">APR 2026</span>
                </div>
                <h4 class="text-md font-bold text-slate-800 mb-4">Public Infrastructure Launch</h4>
                <ul class="text-xs text-slate-600 space-y-3">
                    <li class="flex items-center gap-3"><i class="fa-solid fa-link text-slate-400"></i> Frontend-to-Admin data bridge integration</li>
                    <li class="flex items-center gap-3"><i class="fa-solid fa-bullhorn text-slate-400"></i> Digital Notice Board automation engine</li>
                </ul>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-slate-50 bg-slate-200 text-slate-500 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <i class="fa-solid fa-microchip text-xs"></i>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[45%] bg-white p-6 rounded-2xl border border-slate-200 opacity-70 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-slate-500 px-2.5 py-1 bg-slate-100 rounded-md">v1.0.0</span>
                    <span class="text-[10px] font-medium text-slate-400">FEB 2026</span>
                </div>
                <h4 class="text-md font-bold text-slate-800 mb-4">Core Architecture Deployment</h4>
                <p class="text-xs text-slate-600 leading-relaxed">Initialization of the central database, administrative security protocols, and core content management modules for courses and faculty data.</p>
            </div>
        </div>

    </div>

    <div class="mt-16 bg-slate-900 rounded-3xl p-8 text-white relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
            <div class="shrink-0">
                <div class="w-16 h-16 bg-gradient-to-tr from-indigo-600 to-blue-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                    <i class="fa-solid fa-user-gear text-2xl"></i>
                </div>
            </div>
            <div>
                <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-[0.2em] mb-2">Development Lead</p>
                <h3 class="text-xl font-bold mb-2">Nirmal Gaihre</h3>
                <p class="text-slate-400 text-sm leading-relaxed max-w-xl">
                    Engineering reliable, scalable digital solutions for academic management. 
                    For technical inquiries or system support, please utilize the developer portal.
                </p>
                <div class="mt-6 flex flex-wrap gap-6 border-t border-slate-800 pt-6">
                    <a href="#" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-2">
                        <i class="fa-brands fa-github text-indigo-500"></i> Repository
                    </a>
                    <a href="#" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-indigo-500"></i> System Support
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 p-8 opacity-10">
            <i class="fa-solid fa-terminal text-9xl"></i>
        </div>
    </div>
</div>
@endsection