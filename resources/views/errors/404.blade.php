<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found | Annapurna Polytechnic Institute</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] flex items-center justify-center min-h-screen">

    <div class="w-full max-w-2xl px-6">
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden flex flex-col md:flex-row">
            
            <!-- Left Branding Side -->
            <div class="bg-slate-50 p-8 md:w-1/3 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-slate-200">
                <img src="{{ asset('assets/img/logo.png') }}" alt="API Logo" class="w-20 h-20 object-contain mb-4">
                <div class="text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] leading-tight">CTEVT Nepal</p>
                </div>
            </div>

            <!-- Right Content Side -->
            <div class="p-10 md:w-2/3">
                <div class="mb-6">
                    <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-1">Error 404</h2>
                    <h1 class="text-2xl font-bold text-slate-900 mb-2">Page not found</h1>
                    <p class="text-slate-500 leading-relaxed">
                        The resource you are looking for at <span class="font-semibold text-slate-700 uppercase">Annapurna Polytechnic Institute</span> is unavailable or has moved.
                    </p>
                </div>

                <div class="space-y-1 mb-8">
                    <h5 class="text-sm font-bold text-slate-800">Annapurna Polytechnic Institute</h5>
                    <p class="text-xs text-slate-400">Annapurna 3, Kahundanda, Kaski, Nepal</p>
                </div>

                <div class="flex items-center gap-4">
                    <a href="javascript:history.back()" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">
                        &larr; Go Back
                    </a>
                    <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition-all">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Subtle Footer -->
        <p class="text-center mt-6 text-slate-400 text-xs uppercase tracking-widest">
            &copy; 2026 Annapurna Polytechnic Institute
        </p>
    </div>

</body>
</html>