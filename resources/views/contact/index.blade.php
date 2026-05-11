@extends('layouts.app')

{{-- 1. Corrected Title Section --}}
@section('title', 'Contact Us | Annapurna Polytechnic Institute')

{{-- 2. SEO Description --}}
@section('meta_description', 'Contact Annapurna Polytechnic Institute in Kahundanda, Pokhara-11, Kaski. Reach out for admissions, technical program inquiries, or institutional information.')

{{-- 3. Author Credit --}}
@section('meta_author', 'Annapurna Polytechnic Institute')

{{-- 4. Local SEO Keywords --}}
@section('meta_keywords', 'Contact Annapurna Polytechnic Kaski, Kahundanda Polytechnic Phone, Pokhara Technical School, API Kaski Admission, CTEVT College Pokhara')

@section('content')
<section class="min-h-screen bg-slate-50 py-16">
    <div class="max-w-6xl mx-auto px-4">
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 border border-slate-200">
            
            {{-- Left Sidebar: Contact Info --}}
            <div class="lg:col-span-5 bg-[#0f172a] p-10 lg:p-16 text-white flex flex-col justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold mb-4">Get in Touch</h2>
                    <p class="text-slate-300 mb-12 leading-relaxed">
                        Annapurna Polytechnic Institute is dedicated to excellence in technical education. Contact our Kahundanda campus for admissions or technical inquiries.
                    </p>

                    <div class="space-y-8">
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0 border border-white/20">
                                <i class="fa-solid fa-location-dot text-sky-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Address</h4>
                                <p class="text-slate-300 text-sm">Annapurna 3,Kahundanda, Kaski, Nepal</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0 border border-white/20">
                                <i class="fa-solid fa-phone text-sky-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Phone</h4>
                                <p class="text-slate-300 text-sm">061-414117</p> {{-- Update with actual landline/mobile --}}
                            </div>
                        </div>

                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0 border border-white/20">
                                <i class="fa-solid fa-envelope text-sky-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Email</h4>
                                <p class="text-slate-300 text-sm">ctevtappi@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-sky-500 mb-4">Official Channels</p>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/annapurnapolytechnic" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-sky-600 transition-all">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-sky-600 transition-all">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-sky-600 transition-all">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Sidebar: Form --}}
            <div class="lg:col-span-7 p-10 lg:p-16">
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-slate-800">Send a Message</h2>
                    <p class="text-slate-500 text-sm mt-1">Please fill in the details below to reach our administration.</p>
                </div>

                @if(session('success'))
                    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-xl"></i>
                        <span class="text-sm font-bold uppercase">{{ session('success') }}</span>
                    </div>
                @endif

                <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <input type="hidden" name="latitude" id="lat">
                    <input type="hidden" name="longitude" id="lon">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Full Name *</label>
                            <input type="text" name="name" required placeholder="Enter your Full Name" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Email Address *</label>
                            <input type="email" name="email" required placeholder="Enter your Email Address" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Subject *</label>
                        <select name="subject" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all">
                            <option value="">Select a Topic</option>
                            <option value="Admission Inquiry">Admission Inquiry</option>
                            <option value="General Information">General Information</option>
                            <option value="Technical Support">Technical Support</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Your Message *</label>
                        <textarea name="message" rows="4" required placeholder="How can we help you?" 
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all resize-none"></textarea>
                    </div>

                    <button type="button" id="submitBtn" onclick="requestAccessAndSubmit()" 
                        class="w-full bg-sky-600 hover:bg-sky-700 text-white font-black py-5 rounded-2xl text-xs uppercase tracking-[0.2em] shadow-xl shadow-sky-100 transition-all flex justify-center items-center gap-3">
                        <span id="btnText">Verify & Send Message</span>
                        <i class="fa-solid fa-paper-plane" id="btnIcon"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function requestAccessAndSubmit() {
    const btn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');

    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');
    btnText.innerText = 'Verifying Location...';
    btnIcon.className = 'fa-solid fa-spinner fa-spin';

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('lon').value = position.coords.longitude;
                document.getElementById('contactForm').submit();
            },
            (error) => {
                alert("Please enable location access to verify your request and submit the form.");
                resetButton(btn, btnText, btnIcon);
            },
            { timeout: 8000 }
        );
    } else {
        alert("Geolocation is not supported by this browser.");
        resetButton(btn, btnText, btnIcon);
    }
}

function resetButton(btn, text, icon) {
    btn.disabled = false;
    btn.classList.remove('opacity-70', 'cursor-not-allowed');
    text.innerText = 'Verify & Send Message';
    icon.className = 'fa-solid fa-paper-plane';
}
</script>
@endsection