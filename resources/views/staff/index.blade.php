@extends('layouts.app')

@section('title', 'Our Faculty & Staff')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    
    <div class="text-center mb-16">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Our Professional Team</h1>
        <div class="h-1 w-20 bg-indigo-600 mx-auto mt-4 rounded-full"></div>
        <p class="text-slate-500 mt-4 max-w-2xl mx-auto text-sm">
            Meet the dedicated faculty and staff members of Annapurna Polytechnic Institute.
        </p>
    </div>

    @foreach($staffGroups as $category => $members)
    <div class="mb-16">
        <div class="flex items-center gap-4 mb-8">
            <h2 class="text-xs font-bold text-indigo-600 uppercase tracking-[0.2em] whitespace-nowrap">
                {{ $category }}
            </h2>
            <div class="w-full h-px bg-slate-100"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($members as $person)
            <div class="group bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-indigo-200 transition-all duration-300">
                
                <div class="aspect-[4/5] overflow-hidden bg-slate-100 relative">
                    @if($person->staff_img)
                        <img src="{{ asset('storage/'.$person->staff_img) }}" 
                             alt="{{ $person->staff_name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <i class="fa-solid fa-user text-5xl"></i>
                        </div>
                    @endif
                </div>

                <div class="p-4 text-center">
                    <h3 class="text-sm font-bold text-slate-800 line-clamp-1">{{ $person->staff_name }}</h3>
                    <p class="text-[11px] text-slate-500 mt-1 font-medium">{{ $category }}</p>
                    
                    <div class="flex justify-center gap-3 mt-4 pt-4 border-t border-slate-50">
                        @if($person->staff_phone)
                        <a href="tel:{{ $person->staff_phone }}" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </a>
                        @endif
                        @if($person->staff_email)
                        <a href="mailto:{{ $person->staff_email }}" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

</div>
@endsection