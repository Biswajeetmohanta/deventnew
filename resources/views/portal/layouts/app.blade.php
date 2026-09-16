<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Client Workspace | Devent Technology')</title>
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
<body class="bg-slate-50 text-slate-800 antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col border-r border-slate-800">
            <div class="p-6 border-b border-slate-800">
                <a href="{{ url('/portal') }}" class="text-xl font-black tracking-tighter inline-flex items-center gap-2">
                    <span class="text-[#0052FF]">DEVENT</span> PORTAL
                </a>
            </div>
            
            <div class="flex-grow p-6 flex flex-col justify-between">
                <nav class="flex flex-col gap-2">
                    <a href="{{ url('/portal') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 font-semibold text-slate-300 hover:text-white transition-all {{ request()->is('portal') ? 'bg-[#0052FF] text-white hover:bg-[#0052FF]' : '' }}">
                        <i class="fa-solid fa-chart-pie w-5"></i> Dashboard
                    </a>
                </nav>
                
                <div>
                    <!-- Client profile info summary -->
                    <div class="flex items-center gap-3 p-4 bg-slate-800 rounded-xl mb-4">
                        <div class="w-10 h-10 rounded-full bg-[#0052FF] flex items-center justify-center font-bold text-white uppercase">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                        <div class="overflow-hidden">
                            <span class="block text-sm font-bold truncate">{{ auth()->user()->name }}</span>
                            <span class="block text-[10px] text-slate-400 truncate">Client Account</span>
                        </div>
                    </div>

                    <form action="{{ url('/portal/logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-red-950/20 text-red-400 hover:bg-red-950/40 hover:text-red-300 font-bold transition-all border border-red-900/30">
                            <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Body -->
        <div class="flex-grow flex flex-col overflow-y-auto">
            <!-- Header -->
            <header class="bg-white border-b border-slate-100 px-6 py-4 flex items-center justify-between">
                <div class="md:hidden">
                    <a href="{{ url('/portal') }}" class="text-lg font-black tracking-tighter text-slate-900">
                        <span class="text-[#0052FF]">DEVENT</span> PORTAL
                    </a>
                </div>
                
                <div class="ml-auto flex items-center gap-4">
                    <div class="md:hidden">
                        <form action="{{ url('/portal/logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Pane -->
            <main class="p-6 md:p-8 max-w-7xl w-full mx-auto">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-100 rounded-2xl flex items-center gap-3 font-semibold text-sm">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-700 border border-red-100 rounded-2xl flex items-center gap-3 font-semibold text-sm">
                        <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
