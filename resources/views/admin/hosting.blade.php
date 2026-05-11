@extends('layouts.admin')

@section('title', 'Hosting Details')

@section('content')
@php
    /**
     * Dynamic Date Logic
     * $expiryDate: Parsed from the database field or a fallback default.
     * $daysRemaining: Difference between now and expiry (false allows negative values for expired).
     */
    $expiryDate = \Carbon\Carbon::parse($certificate->hosting_expiry ?? '2027-05-03');
    $daysRemaining = now()->diffInDays($expiryDate, false);
    $isExpired = $daysRemaining <= 0;
@endphp

<div class="max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="mb-6 flex justify-between items-end border-b border-gray-100 pb-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Hosting & Infrastructure</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Annapurna Polytechnic Institute</p>
        </div>
        <div class="text-right">
            <span class="text-[10px] font-bold text-gray-400 uppercase block">Infrastructure</span>
            <span class="text-sm font-bold text-orange-600">Babal Host Nepal</span>
        </div>
    </div>

    <!-- Quick Status Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm text-center">
            <i class="fa-solid fa-check-circle text-emerald-500 mb-2"></i>
            <p class="text-[10px] font-bold text-gray-400 uppercase">Status</p>
            <p class="text-sm font-bold text-emerald-600">ACTIVE</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm text-center">
            <i class="fa-solid fa-shield-check text-blue-500 mb-2"></i>
            <p class="text-[10px] font-bold text-gray-400 uppercase">SSL Security</p>
            <p class="text-sm font-bold text-blue-600">ENCRYPTED</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm text-center">
            <i class="fa-solid fa-database text-purple-500 mb-2"></i>
            <p class="text-[10px] font-bold text-gray-400 uppercase">Daily Backup</p>
            <p class="text-sm font-bold text-gray-700">ENABLED</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm text-center">
            <i class="fa-solid fa-globe text-orange-500 mb-2"></i>
            <p class="text-[10px] font-bold text-gray-400 uppercase">Nameservers</p>
            <p class="text-[11px] font-bold text-gray-700 uppercase">ns1.babal.host</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Subscription & Billing -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-xs font-bold text-gray-600 uppercase">Subscription & Billing</h3>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="flex p-4">
                    <span class="w-1/2 text-xs font-bold text-gray-400 uppercase">Registration</span>
                    <span class="text-sm font-semibold text-gray-700">May 4, 2026</span>
                </div>
                <div class="flex p-4">
                    <span class="w-1/2 text-xs font-bold text-gray-400 uppercase">Recurring Fee</span>
                    <div>
                        <span class="text-sm font-bold text-gray-800">Rs 3388.87</span>
                        <p class="text-[9px] text-green-600 font-bold uppercase">Incl. 13% VAT</p>
                    </div>
                </div>
                <!-- Dynamic Expiry Section -->
                <div class="flex p-4 {{ $isExpired ? 'bg-red-100' : 'bg-red-50/50' }}">
                    <span class="w-1/2 text-xs font-bold {{ $isExpired ? 'text-red-600' : 'text-red-400' }} uppercase">
                        Expiry Date
                    </span>
                    <div>
                        <span class="text-sm font-black text-red-600">
                            {{ $expiryDate->format('M d, Y') }}
                        </span>
                        <span class="block text-[9px] font-bold uppercase mt-0.5 {{ $isExpired ? 'text-red-700' : 'text-red-400' }}">
                            @if($isExpired)
                                Expired {{ abs((int)$daysRemaining) }} days ago
                            @else
                                Renew in {{ (int)$daysRemaining }} days
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technical Configuration -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-xs font-bold text-gray-600 uppercase">Server Configuration</h3>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="flex p-4">
                    <span class="w-1/3 text-xs font-bold text-gray-400 uppercase">IP Address</span>
                    <span class="text-sm font-bold text-gray-700">103.175.192.14</span>
                </div>
                <div class="flex p-4">
                    <span class="w-1/3 text-xs font-bold text-gray-400 uppercase">DNS 1</span>
                    <code class="text-[11px] font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded">ns1.babal.host</code>
                </div>
                <div class="flex p-4">
                    <span class="w-1/3 text-xs font-bold text-gray-400 uppercase">DNS 2</span>
                    <code class="text-[11px] font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded">ns2.babal.host</code>
                </div>
            </div>
        </div>

        <!-- Domain Registration (.edu.np) -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-indigo-50 border-b border-indigo-100">
                <h3 class="text-xs font-bold text-indigo-700 uppercase flex items-center gap-2">
                    <i class="fa-solid fa-address-card"></i> Domain Registration
                </h3>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="flex p-4 justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">Registrar</span>
                    <span class="text-sm font-semibold text-gray-700">Mercantile (NTC)</span>
                </div>
                <div class="flex p-4 justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">Domain Type</span>
                    <span class="text-sm font-bold text-indigo-600">FREE (.edu.np)</span>
                </div>
                <div class="flex p-4 justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">Verification</span>
                    <span class="text-[10px] bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded font-bold uppercase">Verified</span>
                </div>
            </div>
        </div>

        <!-- System Environment -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-xs font-bold text-gray-600 uppercase flex items-center gap-2">
                    <i class="fa-solid fa-gears"></i> Software Environment
                </h3>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="flex p-4 justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">PHP Version</span>
                    <code class="text-sm font-bold text-gray-700">8.2.x</code>
                </div>
                <div class="flex p-4 justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">Framework</span>
                    <span class="text-sm font-semibold text-gray-700">Laravel 10 (Stable)</span>
                </div>
                <div class="flex p-4 justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">App Mode</span>
                    <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-bold uppercase">Production</span>
                </div>
            </div>
        </div>

        <!-- Security & SSL Status -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-emerald-50 border-b border-emerald-100">
                <h3 class="text-xs font-bold text-emerald-700 uppercase flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved"></i> Security & Encryption
                </h3>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="flex p-4 items-center justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">SSL Type</span>
                    <span class="text-sm font-semibold text-gray-700">Let's Encrypt</span>
                </div>
                <div class="flex p-4 items-center justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">Encryption</span>
                    <span class="text-sm font-semibold text-gray-700">TLS 1.3 / 256-bit</span>
                </div>
                <div class="flex p-4 items-center justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase">Protection</span>
                    <span class="text-sm font-semibold text-gray-700">Imunify360 Enabled</span>
                </div>
            </div>
        </div>

        <!-- Quick Access Portals -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-xs font-bold text-gray-600 uppercase">Management Shortcuts</h3>
            </div>
            <div class="p-4 grid grid-cols-2 gap-3">
                <a href="#" class="flex flex-col items-center p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition group text-center">
                    <i class="fa-solid fa-user-tie text-blue-500 mb-1 group-hover:scale-110 transition"></i>
                    <span class="text-[10px] font-bold text-gray-600 uppercase">Billing</span>
                </a>
                <a href="#" class="flex flex-col items-center p-3 border border-gray-100 rounded-lg hover:bg-orange-50 transition group text-center">
                    <i class="fa-solid fa-server text-orange-500 mb-1 group-hover:scale-110 transition"></i>
                    <span class="text-[10px] font-bold text-gray-600 uppercase">cPanel</span>
                </a>
                <a href="#" class="flex flex-col items-center p-3 border border-gray-100 rounded-lg hover:bg-purple-50 transition group text-center">
                    <i class="fa-solid fa-envelope text-purple-500 mb-1 group-hover:scale-110 transition"></i>
                    <span class="text-[10px] font-bold text-gray-600 uppercase">Webmail</span>
                </a>
                <a href="mailto:gaihrenirmal2021@gmail.com" class="flex flex-col items-center p-3 border border-gray-100 rounded-lg hover:bg-red-50 transition group text-center">
                    <i class="fa-solid fa-life-ring text-red-500 mb-1 group-hover:scale-110 transition"></i>
                    <span class="text-[10px] font-bold text-gray-600 uppercase">Get Help</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Managed Support Footer -->
    <div class="mt-6 p-6 bg-gray-900 rounded-xl text-white shadow-lg border-l-4 border-orange-500">
        <div class="flex items-start gap-5">
            <div class="p-3 bg-gray-800 rounded-lg shrink-0">
                <i class="fa-solid fa-database text-orange-400 text-xl"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Managed Support & Administration</p>
                <p class="text-sm font-medium mt-1 leading-relaxed text-gray-300">
                    Infrastructure provided by <strong>Babal Host</strong>. Technical management and system administration are handled directly. For updates or system assistance, contact:
                </p>
                <div class="mt-5 flex flex-wrap gap-x-6 gap-y-3 text-[11px]">
                    <a href="https://nirmalgaihre.com.np" target="_blank" class="flex items-center gap-2 hover:text-orange-400 transition">
                        <i class="fa-solid fa-globe text-orange-500"></i> nirmalgaihre.com.np
                    </a>
                    <a href="https://facebook.com/nirmalgaihre.com.np" target="_blank" class="flex items-center gap-2 hover:text-orange-400 transition">
                        <i class="fa-brands fa-facebook text-orange-500"></i> nirmalgaihre
                    </a>
                    <a href="mailto:gaihrenirmal2021@gmail.com" class="flex items-center gap-2 hover:text-orange-400 transition">
                        <i class="fa-solid fa-paper-plane text-orange-500"></i> gaihrenirmal2021@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection