@extends('layouts.admin')

@section('title', 'Edit Certificate')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg shadow-sm">
            <p class="font-bold text-sm">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-xs mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
        <!-- Header -->
        <div class="p-6 bg-blue-600 text-white flex justify-between items-center">
            <div>
                <h3 class="font-bold uppercase text-xs tracking-widest">Edit Certificate</h3>
                <p class="text-[10px] opacity-80 mt-1">ID: {{ $certificate->issue_no }}</p>
            </div>
            <a href="{{ route('certificates.index') }}"
                class="text-xs bg-white/20 px-4 py-2 rounded-xl hover:bg-white/30 transition backdrop-blur-sm border border-white/10">
                Back to List
            </a>
        </div>

        <form action="{{ route('certificates.update', $certificate->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Row 1 -->
                <div class="md:col-span-1">
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Issue No</label>
                    <input type="text" name="issue_no" value="{{ old('issue_no', $certificate->issue_no) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $certificate->full_name) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all">
                </div>

                <!-- Row 2 -->
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Father's Name</label>
                    <input type="text" name="father_name" value="{{ old('father_name', $certificate->father_name) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Mother's Name</label>
                    <input type="text" name="mother_name" value="{{ old('mother_name', $certificate->mother_name) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Date of Birth (BS)</label>
                    <input type="text" name="dob_nepali" value="{{ old('dob_nepali', $certificate->dob_nepali) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all" placeholder="YYYY-MM-DD">
                </div>

                <!-- Row 3: Location -->
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">District</label>
                    <input type="text" name="district" value="{{ old('district', $certificate->district) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Municipality & Ward</label>
                    <div class="flex space-x-2">
                        <input type="text" name="municipality" value="{{ old('municipality', $certificate->municipality) }}"
                            class="w-3/4 bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none">
                        <input type="text" name="ward_number" value="{{ old('ward_number', $certificate->ward_number) }}"
                            class="w-1/4 bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Province</label>
                    <input type="text" name="province" value="{{ old('province', $certificate->province) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all">
                </div>

                <div class="md:col-span-3 h-px bg-slate-100 my-2"></div>

                <!-- Row 4: Academic -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Course Name</label>
                    <select name="course"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all appearance-none cursor-pointer"
                        required>
                        <option value="" disabled>Select Course Program</option>
                        <optgroup label="Diploma Programs (3 Years)">
                            <option value="Diploma in Agriculture (Plant Science)" @selected(old('course', $certificate->course) == "Diploma in Agriculture (Plant Science)")>
                                Diploma in Agriculture (Plant Science)
                            </option>
                            <option value="Diploma in Agriculture (Animal Science)" @selected(old('course', $certificate->course) == "Diploma in Agriculture (Animal Science)")>
                                Diploma in Agriculture (Animal Science)
                            </option>
                        </optgroup>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">CTEVT Reg No</label>
                    <input type="text" name="ctevt_reg_no" value="{{ old('ctevt_reg_no', $certificate->ctevt_reg_no) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all">
                </div>

                <!-- Row 5: Results -->
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Year (From - To) BS</label>
                    <div class="flex space-x-2">
                        <input type="text" name="year_from" value="{{ old('year_from', $certificate->year_from) }}"
                            class="w-1/2 bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none" placeholder="2077">
                        <input type="text" name="year_to" value="{{ old('year_to', $certificate->year_to) }}"
                            class="w-1/2 bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none" placeholder="2080">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Division & %</label>
                    <div class="flex space-x-2">
                        <input type="text" name="division" value="{{ old('division', $certificate->division) }}"
                            class="w-1/2 bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none" placeholder="First">
                        <input type="text" name="percentage" value="{{ old('percentage', $certificate->percentage) }}"
                            class="w-1/2 bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none" placeholder="82.5%">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Issue Date (BS)</label>
                    <input type="text" name="issue_date_nepali" value="{{ old('issue_date_nepali', $certificate->issue_date_nepali) }}"
                        class="w-full bg-slate-50 border-2 border-transparent focus:border-blue-500 rounded-xl p-3 text-sm outline-none transition-all">
                </div>
            </div>

            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-black py-4 rounded-2xl text-xs uppercase tracking-widest shadow-xl hover:bg-blue-700 hover:-translate-y-0.5 transition-all active:scale-95">
                    Update Certificate Record
                </button>
            </div>
        </form>
    </div>
</div>
@endsection