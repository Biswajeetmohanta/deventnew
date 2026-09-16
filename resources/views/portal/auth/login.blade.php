<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Portal Login | Devent Technology</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Decorative Blurs -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-60"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-60"></div>

    <div class="w-full max-w-md p-6 relative z-10">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 text-2xl font-black text-slate-900 tracking-tighter">
                <span class="text-[#0052FF]">DEVENT</span> PORTAL
            </a>
            <p class="text-sm text-slate-400 font-medium mt-2">Sign in to your client workspace</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-xl border border-slate-100">
            <!-- Session Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 rounded-xl border border-red-100 text-xs text-red-600 font-bold">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/portal/login') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-black uppercase text-slate-500 tracking-wider mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="name@company.com" class="w-full border border-slate-200 focus:outline-none focus:border-[#0052FF] rounded-xl pl-11 pr-4 py-3 text-sm text-slate-800 font-medium transition-colors" style="padding-left: 2.75rem !important;">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-slate-500 tracking-wider mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full border border-slate-200 focus:outline-none focus:border-[#0052FF] rounded-xl pl-11 pr-4 py-3 text-sm text-slate-800 font-medium transition-colors" style="padding-left: 2.75rem !important;">
                    </div>
                </div>

                <div class="flex items-center justify-between mt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#0052FF] focus:ring-[#0052FF] w-4 h-4">
                        <span class="text-xs font-bold text-slate-500 select-none">Remember Me</span>
                    </label>
                </div>

                <button type="submit" class="w-full text-white py-3.5 rounded-xl font-bold hover:brightness-110 transition-all shadow-lg shadow-blue-500/20 hover:scale-[1.01] mt-4 flex items-center justify-center gap-2" style="background: linear-gradient(90deg, #0052FF 0%, #3b82f6 100%) !important; color: white !important;">
                    Sign In <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-arrow-left mr-1"></i> Back to Main Site
            </a>
        </div>
    </div>
</body>
</html>
