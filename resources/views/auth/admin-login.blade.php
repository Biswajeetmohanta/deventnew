<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Devent Technology</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .glass { background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.05); }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="glass p-8 md:p-12 rounded-[2.5rem] w-full max-w-md">
        <div class="text-center mb-10">
            @php
                $loginImage = \App\Models\Setting::where('key', 'admin_login_image')->value('value') ?? \App\Models\Setting::where('key', 'site_logo')->value('value');
            @endphp
            @if($loginImage)
                <img src="{{ asset('storage/' . $loginImage) }}" alt="Devent Logo" class="h-20 w-auto mx-auto mb-6">
            @else
                <img src="{{ asset('assets/images/logo.png') }}" alt="Devent Logo" class="h-20 w-auto mx-auto mb-6">
            @endif
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Admin Portal</h1>
            <p class="text-slate-500 text-sm mt-1">Please sign in to manage your website.</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            @if($errors->any())
                <div class="bg-rose-50 border border-rose-100 text-rose-600 px-4 py-3 rounded-xl text-sm flex items-center">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-300">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="admin@admin.com"
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 pl-12 text-slate-800 focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/5 transition-all placeholder:text-slate-300">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-300">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 pl-12 text-slate-800 focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/5 transition-all placeholder:text-slate-300">
                </div>
            </div>

            <div class="flex items-center justify-between px-1">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                    <label for="remember" class="ml-2 text-sm text-slate-500 font-medium cursor-pointer">Stay signed in</label>
                </div>
            </div>

            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 rounded-2xl transition-all shadow-xl shadow-amber-500/20 active:scale-[0.98] flex items-center justify-center">
                Sign In to Dashboard
                <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
            </button>
        </form>

        <div class="mt-12 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">&copy; 2026 Devent Technologies</p>
        </div>
    </div>
</body>
</html>
