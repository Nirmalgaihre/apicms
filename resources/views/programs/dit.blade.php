@extends('layouts.app')

@section('title', 'Diploma in Agriculture (Plant Science) - Annapurna Polytechnic Institute')
@section('meta_description', 'Detailed yearly curriculum and subject breakdown for the Diploma in Agriculture (Plant Science) program at Annapurna Polytechnic Institute.')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen py-12">
    <div class="max-w-[1400px] mx-auto px-6">
        <div class="mb-12 border-b-2 border-slate-800 pb-6">
            <h1 class="text-3xl font-bold text-slate-900 uppercase tracking-tight">Diploma in Agriculture (Plant Science)</h1>
            <p class="text-slate-600 font-medium mt-1">Full Curriculum Structure & Yearly Breakdown | पूर्ण पाठ्यक्रम संरचना र वार्षिक विवरण</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="bg-white p-6 border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 border-b pb-2 mb-4 uppercase text-xs tracking-widest">Introduction | परिचय</h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    The Plant Science program is designed to produce skilled technical human resources capable of managing crop production, soil fertility, and plant protection. It prepares students for roles as Junior Technicians (JT) in various agricultural sectors.
                    <br><span class="text-slate-500 italic mt-2 block">यस कार्यक्रमले बाली विज्ञान, माटो व्यवस्थापन र बिरुवा संरक्षणमा दक्ष प्राविधिक जनशक्ति उत्पादन गर्ने लक्ष्य राखेको छ।</span>
                </p>
            </div>
            <div class="bg-white p-6 border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 border-b pb-2 mb-4 uppercase text-xs tracking-widest">Core Competencies | मुख्य विषयवस्तु</h2>
                <ul class="grid grid-cols-2 gap-2 text-xs font-bold text-slate-700">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-seedling text-[#302171]"></i> Agronomy & Seed Tech</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-leaf text-[#302171]"></i> Plant Protection</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-faucet-drip text-[#302171]"></i> Soil & Irrigation</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-apple-whole text-[#302171]"></i> Horticulture</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-microscope text-[#302171]"></i> Plant Breeding</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-chart-line text-[#302171]"></i> Farm Management</li>
                </ul>
            </div>
        </div>

        @php
        $plantScienceSyllabus = [
            'First Year' => [
                'Foundational & Disciplinary Subjects' => [
                    ['AG-101-PS', 'Agronomy - I'],
                    ['AG-102-PS', 'Horticulture - I'],
                    ['AG-103-SH', 'Mathematics'],
                    ['AG-104-SH', 'Physics'],
                    ['AG-105-SH', 'Chemistry'],
                    ['AG-106-SH', 'Zoology'],
                    ['AG-107-SH', 'Botany'],
                    ['AG-108-PS', 'Introductory Plant Science']
                ]
            ],
            'Second Year' => [
                'Core Disciplinary Subjects' => [
                    ['AG-201-SH', 'English'],
                    ['AG-202-PS', 'Plant Breeding and Seed Technology'],
                    ['AG-203-PS', 'Plant Protection - I'],
                    ['AG-204-PS', 'Agronomy - II'],
                    ['AG-205-PS', 'Horticulture - II'],
                    ['AG-206-PS', 'Extension and Communication'],
                    ['AG-207-PS', 'Soil Science and Fertilizer Management'],
                    ['AG-208-PS', 'Industrial Crops and Post-harvest Technology'],
                    ['AG-209-PS', 'Field Practice - I'],
                    ['AG-210-PS', 'Plant Science Project']
                ]
            ],
            'Third Year' => [
                'Specialized & Professional Subjects' => [
                    ['AG-301-SH', 'Nepali'],
                    ['AG-302-PS', 'Plant Protection - II'],
                    ['AG-303-PS', 'Agricultural Economics, Marketing & Cooperatives'],
                    ['AG-304-PS', 'Irrigation and Farm Power'],
                    ['AG-305-PS', 'Field Practice - II'],
                    ['AG-306-MG', 'Entrepreneurship Development'],
                    ['AG-307-PS', 'Internship (Work Place Based Learning)']
                ]
            ]
        ];
        @endphp

        @foreach($plantScienceSyllabus as $year => $sections)
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-6">
                <span class="bg-slate-800 text-white px-4 py-1.5 rounded-full text-sm font-bold uppercase tracking-wider">{{ $year }}</span>
                <div class="h-px bg-slate-200 flex-1"></div>
            </div>
            
            <div class="grid grid-cols-1 gap-8">
                @foreach($sections as $sectionName => $courses)
                <div class="bg-white border border-slate-200 shadow-sm flex flex-col">
                    <div class="bg-slate-50 px-5 py-3 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="text-slate-800 text-xs font-bold uppercase tracking-widest">{{ $sectionName }}</h3>
                        <span class="text-[10px] text-slate-400 font-medium">Yearly System</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-5 py-3 text-[10px] uppercase tracking-wider text-slate-500 font-bold border-b border-slate-100">Code</th>
                                    <th class="px-5 py-3 text-[10px] uppercase tracking-wider text-slate-500 font-bold border-b border-slate-100">Subject Title</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($courses as $course)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-5 py-3 text-xs font-mono font-bold text-[#302171] w-48 border-r border-slate-50">{{ $course[0] }}</td>
                                    <td class="px-5 py-3 text-xs font-semibold text-slate-700 leading-tight">{{ $course[1] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="mt-8 p-4 bg-slate-100 border-l-4 border-slate-800 text-slate-600 text-[11px]">
            <p>* Subjects and codes are structured as per the 2025 (2082 BS) CTEVT Revision.</p>
            <p>* The 3rd year includes a compulsory 6-month Internship (Work Place Based Learning).</p>
        </div>
    </div>
</div>
@endsection