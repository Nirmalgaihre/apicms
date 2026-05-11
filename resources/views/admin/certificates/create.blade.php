@extends('layouts.admin')

@section('content')

@php
// 'Y-m-d' gives you 2083-01-21
// locale 'en' ensures English numbers (1, 2, 3)
$nepaliDate = \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from(now())
->toNepaliDate(format: 'Y-m-d', locale: 'en');

$contactCount = $contactCount ?? 0;
@endphp
<div class="max-w-5xl mx-auto my-10">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
        {{-- Header --}}
        <div class="p-6 bg-[#1d0647] text-white flex justify-between items-center">
            <div>
                <h3 class="font-bold uppercase text-xs tracking-widest">Certificate Management</h3>
                <p class="text-indigo-200 text-[10px] mt-1">New Character Certificate Entry</p>
            </div>
            <span class="bg-indigo-500/30 px-3 py-1 rounded-full text-[10px] font-bold">Step 1: Data Entry</span>
        </div>

        <form action="{{ route('certificates.store') }}" method="POST" class="p-8 space-y-8">
            @csrf

            {{-- 1. Basic Information --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2 h-4 bg-indigo-500 rounded-full"></span>
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-tight">Basic Information</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Issue No</label>
                        <input type="text" name="issue_no"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Issue Number" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Full Name</label>
                        <input type="text" name="full_name"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Student's Full Name" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Father's Name</label>
                        <input type="text" name="father_name"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Father's Name" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Mother's Name</label>
                        <input type="text" name="mother_name"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Mother's Name" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">
                            Date of Birth (BS)
                        </label>
                        <input type="text" id="dob-bs" name="dob_nepali"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="YYYY-MM-DD" maxlength="10" required>
                    </div>

                    <script>
                    const dobInput = document.getElementById('dob-bs');

                    dobInput.addEventListener('input', function(e) {
                        // 1. Get only digits
                        let v = this.value.replace(/\D/g, '');
                        let year = v.substring(0, 4);
                        let month = v.substring(4, 6);
                        let day = v.substring(6, 8);

                        // 2. Validate Month (Max 12)
                        if (month.length === 2) {
                            if (parseInt(month) > 12) month = '12';
                            if (parseInt(month) === 0) month = '01'; // Prevents 00
                        }

                        // 3. Validate Day (Max 32)
                        if (day.length === 2) {
                            if (parseInt(day) > 32) day = '32';
                            if (parseInt(day) === 0) day = '01'; // Prevents 00
                        }

                        // 4. Reconstruct the string with dashes
                        let formatted = year;
                        if (v.length > 4) formatted += '-' + month;
                        if (v.length > 6) formatted += '-' + day;

                        this.value = formatted;
                    });

                    // Block non-numeric keys
                    dobInput.addEventListener('keypress', function(e) {
                        if (!/[0-9]/.test(e.key)) e.preventDefault();
                    });
                    </script>
                </div>
            </div>

            <hr class="border-slate-100">

            {{-- 2. Address Details (Based on your SQL columns) --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2 h-4 bg-indigo-500 rounded-full"></span>
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-tight">Permanent Address</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Province</label>
                        <select name="province"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all appearance-none cursor-pointer"
                            required>
                            <option value="" disabled selected>Select Province</option>
                            <option value="Koshi">Koshi</option>
                            <option value="Madhesh">Madhesh</option>
                            <option value="Bagmati">Bagmati</option>
                            <option value="Gandaki">Gandaki</option>
                            <option value="Lumbini">Lumbini</option>
                            <option value="Karnali">Karnali</option>
                            <option value="Sudurpashchim">Sudurpashchim</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">District</label>
                        <input type="text" name="district"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Select District">
                    </div>
                    <div class="md:col-span-1">
                        <label
                            class="block text-[10px] font-black uppercase text-slate-400 mb-1">Municipality/VDC</label>
                        <input type="text" name="municipality"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Select Municipality/VDC">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Ward No</label>
                        <input type="text" id="ward-input" name="ward_number" inputmode="numeric"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Ward No" required>
                    </div>

                    <script>
                    const wardInput = document.getElementById('ward-input');

                    wardInput.addEventListener('input', function(e) {
                        // Remove any character that is not a number
                        this.value = this.value.replace(/[^0-9]/g, '');

                        // Optional: Ward numbers in Nepal usually don't exceed 33 
                        // (depending on the Municipality). You can add a limit if you want:
                        if (parseInt(this.value) > 35) {
                            this.value = '35';
                        }
                    });

                    // Prevent non-numeric key presses (extra layer of protection)
                    wardInput.addEventListener('keypress', function(e) {
                        if (!/[0-9]/.test(e.key)) {
                            e.preventDefault();
                        }
                    });
                    </script>
                </div>
            </div>

            <hr class="border-slate-100">

            {{-- 3. Academic Details --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2 h-4 bg-indigo-500 rounded-full"></span>
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-tight">Academic Details</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Course Name</label>
                        <select name="course"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all appearance-none cursor-pointer"
                            required>
                            <option value="" disabled selected>Select Course Program</option>
                            <optgroup label="Diploma Programs (3 Years)">
                                <option value="Diploma in Agriculture (Plant Science)">Diploma in Agriculture (Plant
                                    Science)</option>
                                <option value="Diploma in Agriculture (Animal Science)">Diploma in Agriculture (Animal
                                    Science)</option>
                            </optgroup>

                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">CTEVT Reg No</label>
                        <input type="text" name="ctevt_reg_no"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Registration Number" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Enrolled Year
                            (BS)</label>
                        <input type="text" name="year_from"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Enrolled Year" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Completed Year
                            (BS)</label>
                        <input type="text" name="year_to"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Completed Year" required>
                    </div>
                    <div class="bg-indigo-50 p-3 rounded-xl ring-2 ring-indigo-100">
                        <label class="block text-[10px] font-black uppercase text-indigo-600 mb-1">Passed Year
                            (BS)</label>
                        <input type="text" name="pass_year"
                            class="w-full bg-white border-2 border-transparent focus:border-indigo-500 rounded-lg p-2 text-sm outline-none"
                            placeholder="Enter Passed Year" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Division</label>
                        <input type="text" name="division"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Division">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Percentage %</label>
                        <input type="text" id="percentage-input" name="percentage"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Percentage (0-100)">
                        <!-- Small error message holder -->
                        <span id="percentage-error" class="text-[10px] text-red-500 mt-1 hidden">Please enter a value
                            between 0 and 100</span>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Issue Date
                            (BS)</label>
                        <input type="text" name="issue_date_nepali"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 rounded-xl p-3 text-sm outline-none transition-all"
                            placeholder="Enter Today Date" value="{{ $nepaliDate }}" required>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-[#1d0647] text-white font-black py-4 rounded-2xl text-xs uppercase tracking-widest shadow-xl hover:bg-black transition-all transform active:scale-[0.98]">
                    Save & Generate Certificate
                </button>
            </div>
        </form>
    </div>
</div>
<script>
const pctInput = document.getElementById('percentage-input');
const pctError = document.getElementById('percentage-error');

pctInput.addEventListener('input', function(e) {
    // 1. Remove any non-numeric characters (except decimal point)
    let value = this.value.replace(/[^0-9.]/g, '');

    // 2. Prevent multiple decimals
    const parts = value.split('.');
    if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');

    // Update the input value
    this.value = value;

    // 3. Range Validation (0-100)
    const numValue = parseFloat(value);

    if (value !== '' && (numValue < 0 || numValue > 100)) {
        // Invalid State
        this.classList.add('border-red-500');
        this.classList.remove('focus:border-indigo-500');
        pctError.classList.remove('hidden');
    } else {
        // Valid State
        this.classList.remove('border-red-500');
        this.classList.add('focus:border-indigo-500');
        pctError.classList.add('hidden');
    }
});

// Prevent typing non-numeric keys entirely
pctInput.addEventListener('keypress', function(e) {
    if (!/[0-9.]/.test(e.key)) {
        e.preventDefault();
    }
});
</script>
@endsection