@extends('layouts.app')

@section('title', 'Diploma in Agriculture (Animal Science) - Annapurna Polytechnic Institute')
@section('meta_description', 'Explore the complete yearly curriculum structure and subject breakdown for the Diploma in Agriculture (Animal Science) at Annapurna Polytechnic Institute.')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen py-12">
    <div class="max-w-[1400px] mx-auto px-6">
        <div class="mb-12 border-b-2 border-slate-800 pb-6">
            <h1 class="text-3xl font-bold text-slate-900 uppercase tracking-tight">Diploma in Agriculture (Animal Science)</h1>
            <p class="text-slate-600 font-medium mt-1">Full Curriculum Structure & Yearly Breakdown | पूर्ण पाठ्यक्रम संरचना र वार्षिक विवरण</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="bg-white p-6 border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 border-b pb-2 mb-4 uppercase text-xs tracking-widest">Introduction | परिचय</h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    This three-year Diploma program in Agriculture (Animal Science) is designed to produce middle-level technical human resources (Junior Technicians) equipped with knowledge in animal health, livestock production, and management.
                    <br><span class="text-slate-500 italic mt-2 block">यस कार्यक्रमले पशु स्वास्थ्य, उत्पादन र व्यवस्थापनमा दक्ष प्राविधिक जनशक्ति उत्पादन गर्ने लक्ष्य राखेको छ।</span>
                </p>
            </div>
            <div class="bg-white p-6 border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 border-b pb-2 mb-4 uppercase text-xs tracking-widest">Core Competencies | मुख्य विषयवस्तु</h2>
                <ul class="grid grid-cols-2 gap-2 text-xs font-bold text-slate-700">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-cow text-[#302171]"></i> Animal Nutrition</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-stethoscope text-[#302171]"></i> Veterinary Health</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-feather text-[#302171]"></i> Poultry Science</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-dna text-[#302171]"></i> Applied Breeding</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-fish text-[#302171]"></i> Aquaculture</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-briefcase text-[#302171]"></i> Entrepreneurship</li>
                </ul>
            </div>
        </div>

        @php
        $animalScienceSyllabus = [
            'First Year' => [
                'Foundational & Disciplinary Subjects' => [
                    ['AG-101-AS', 'Animal Nutrition - I'],
                    ['AG-102-AS', 'Animal Health - I'],
                    ['AG-103-SH', 'Mathematics'],
                    ['AG-104-SH', 'Physics'],
                    ['AG-105-SH', 'Chemistry'],
                    ['AG-106-SH', 'Zoology'],
                    ['AG-107-SH', 'Botany'],
                    ['AG-108-AS', 'Introductory Animal Science']
                ]
            ],
            'Second Year' => [
                'Core Disciplinary Subjects' => [
                    ['AG-201-SH', 'English'],
                    ['AG-202-AS', 'Applied Animal Breeding'],
                    ['AG-203-AS', 'Animal Health - II'],
                    ['AG-204-AS', 'Animal Husbandry - I (Ruminants)'],
                    ['AG-205-AS', 'Animal Husbandry - II (Pig, Poultry & Rabbit)'],
                    ['AG-206-PS', 'Extension and Communication'],
                    ['AG-207-AS', 'Animal Product Technology'],
                    ['AG-208-AS', 'Animal Nutrition - II'],
                    ['AG-209-AS', 'Clinical Practice - I'],
                    ['AG-210-AS', 'Animal Husbandry Project']
                ]
            ],
            'Third Year' => [
                'Specialized & Professional Subjects' => [
                    ['AG-301-SH', 'Nepali'],
                    ['AG-302-AS', 'Animal Health - III'],
                    ['AG-303-PS', 'Agricultural Economics, Marketing & Cooperatives'],
                    ['AG-304-AS', 'Aquaculture and Fisheries'],
                    ['AG-305-AS', 'Clinical Practice - II'],
                    ['AG-306-MG', 'Entrepreneurship Development'],
                    ['AG-307-PS', 'Internship (Work Place Based Learning)']
                ]
            ]
        ];
        @endphp

        @foreach($animalScienceSyllabus as $year => $sections)
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
            <p>* Subjects and codes are based on the latest 2025 (2082 BS) revision by CTEVT.</p>
            <p>* Internship (AG-307-PS) in the third year is a 6-month work-place-based learning program.</p>
        </div>
    </div>
</div>
@endsection