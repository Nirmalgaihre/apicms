@extends('layouts.app')

{{-- SEO & Meta Tags --}}
@section('title', 'Pre-Diploma in Agriculture (Plant Science) - CTEVT Program')

@push('meta')
    <meta name="description" content="Official curriculum for the 18-month Pre-Diploma in Agriculture (Plant Science) under CTEVT. Become a Junior Technical Assistant (JTA) in Nepal.">
    <meta name="keywords" content="CTEVT, Agriculture JTA, Plant Science Nepal, Pre-Diploma Agriculture, TSLC Agriculture">
    <meta property="og:title" content="Pre-Diploma in Agriculture (Plant Science) | CTEVT">
    <meta property="og:description" content="Start your career in agriculture with the 18-month JTA program.">
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen py-8 antialiased">
    <div class="max-w-5xl mx-auto px-4">
        
        <div class="mb-8 border-l-4 border-[#302171] pl-6 py-2">
            <h1 class="text-3xl font-bold text-gray-900">Pre-Diploma in Agriculture</h1>
            <p class="text-lg text-gray-500">Plant Science (Junior Technical Assistant)</p>
            <div class="flex gap-4 mt-2">
                <span class="text-xs font-bold text-[#302171] uppercase tracking-wider">18-Month Program</span>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">|</span>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">CTEVT Curriculum</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <section class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-sm font-black uppercase text-gray-400 mb-4 tracking-widest">Program Introduction</h2>
                    <p class="text-gray-600 leading-relaxed">
                        This specialized technical course is designed under the **Council for Technical Education and Vocational Training (CTEVT)**. It prepares students as skilled mid-level technicians (JTA) by blending theoretical principles with intensive field-based training.
                    </p>
                    
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-md">
                            <h4 class="font-bold text-gray-800 text-sm">Institutional</h4>
                            <p class="text-xs text-gray-500">12 Months (Theory + Lab)</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-md">
                            <h4 class="font-bold text-gray-800 text-sm">OJT Training</h4>
                            <p class="text-xs text-gray-500">6 Months (Field Experience)</p>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-bold text-gray-700 text-sm uppercase">Course Syllabus</h3>
                        <span class="text-[10px] bg-gray-200 text-gray-600 px-2 py-0.5 rounded font-bold uppercase">1500 Total Marks</span>
                    </div>
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-400 text-[11px] uppercase font-bold">
                            <tr>
                                <th class="px-6 py-3">Subject</th>
                                <th class="px-4 py-3 text-center">Theory</th>
                                <th class="px-4 py-3 text-center">Practical</th>
                                <th class="px-6 py-3 text-right">Marks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @php
                                $subjects = [
                                    ['Agri-Extension & Comm. Dev.', 48, 186, 150],
                                    ['Entrepreneurship Development', 32, 124, 100],
                                    ['Crop and Seed Production', 48, 186, 150],
                                    ['Vegetable and Seed Production', 32, 124, 100],
                                    ['Fruit Cultivation & Post-Harvest', 48, 186, 150],
                                    ['Plant Protection (IPM)', 32, 124, 100],
                                    ['Other (Soil, Fish, Mushroom)', 64, 248, 250],
                                ];
                            @endphp
                            @foreach($subjects as $item)
                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-700">{{ $item[0] }}</td>
                                <td class="px-4 py-3 text-center text-gray-500">{{ $item[1] }}</td>
                                <td class="px-4 py-3 text-center text-gray-500">{{ $item[2] }}</td>
                                <td class="px-6 py-3 text-right font-bold text-gray-900">{{ $item[3] }}</td>
                            </tr>
                            @endforeach
                            <tr class="bg-indigo-50/50">
                                <td colspan="3" class="px-6 py-3 font-bold text-[#302171]">On-the-Job Training (6 Months)</td>
                                <td class="px-6 py-3 text-right font-bold text-[#302171]">500</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>

            <div class="space-y-6">
                <div class="bg-[#302171] rounded-lg p-6 text-white shadow-lg">
                    <h3 class="text-xs font-bold uppercase opacity-60 mb-4 tracking-widest">At a Glance</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm">Total Training</span>
                            <span class="font-bold text-lg">2520 Hrs</span>
                        </div>
                        <div class="flex justify-between items-center border-t border-white/10 pt-4">
                            <span class="text-sm">Certification</span>
                            <span class="font-bold">JTA Level 4</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Requirements</h3>
                    <ul class="text-sm text-gray-600 space-y-3">
                        <li class="flex items-start gap-2">
                            <span class="text-[#302171] mt-0.5">✔</span>
                            SEE / SLC Appeared
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[#302171] mt-0.5">✔</span>
                            Pass Entrance Exam
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[#302171] mt-0.5">✔</span>
                            Medical Fitness
                        </li>
                    </ul>
                </div>

                <a href="{{ asset('storage/downloads/pre-diploma.pdf') }}" class="flex items-center justify-center gap-2 w-full bg-gray-900 text-white py-4 rounded-lg font-bold text-sm hover:bg-black transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"/></svg>
                    DOWNLOAD SYLLABUS
                </a>
            </div>
            
        </div>
    </div>
</div>
@endsection