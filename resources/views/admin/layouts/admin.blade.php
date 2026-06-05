<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    @php
        $favicon = \App\Models\Setting::where('key', 'site_favicon')->value('value');
    @endphp
    @if($favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('assets/images/devent-favicon.png') }}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .sidebar-item { color: #64748b; transition: all 0.3s ease; }
        .sidebar-item:hover { background-color: #f1f5f9; color: #1e293b; }
        .sidebar-item.active { background-color: #fffbeb; color: #b45309; border-right: 4px solid #f59e0b; font-weight: 600; }
        .glass { background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
        .topbar { background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); border-bottom: 1px solid #e2e8f0; }
        
        /* Form Controls */
        input[type="text"], input[type="email"], input[type="password"], input[type="url"], input[type="number"], select, textarea {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.2s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        label {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>
</head>
<body class="min-h-screen flex" x-data="{ sidebarOpen: false }">
    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black/20 z-40 lg:hidden transition-opacity"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full z-50 transition-transform duration-300 lg:translate-x-0 shadow-sm">
        <div class="p-6 flex items-center justify-between border-b border-slate-100">
            <a href="{{ route('admin.dashboard') }}">
                @php
                    $sidebarLogo = \App\Models\Setting::where('key', 'site_logo')->value('value');
                @endphp
                @if($sidebarLogo)
                    <img src="{{ asset('storage/' . $sidebarLogo) }}" alt="Logo" class="h-16 w-auto max-w-[180px] object-contain">
                @else
                    <img src="{{ asset('assets/images/devent_logo_new.jpeg') }}" alt="Logo" class="h-16 w-auto max-w-[180px] object-contain">
                @endif
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        
        <nav class="flex-1 px-4 space-y-1 py-6 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge w-8 text-lg"></i> Dashboard
            </a>
            <a href="{{ route('admin.chats.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/chats*') ? 'active' : '' }}">
                <i class="fa-solid fa-comments w-8 text-lg"></i> Live Chat
                <span id="adminChatBadge" class="ml-auto w-5 h-5 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center hidden">0</span>
            </a>
            <a href="{{ route('admin.services.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/services*') ? 'active' : '' }}">
                <i class="fa-solid fa-gears w-8 text-lg"></i> Services
            </a>
            <a href="{{ route('admin.industries.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/industries*') ? 'active' : '' }}">
                <i class="fa-solid fa-industry w-8 text-lg"></i> Industries
            </a>
            <a href="{{ route('admin.technologies.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/technologies*') ? 'active' : '' }}">
                <i class="fa-solid fa-microchip w-8 text-lg"></i> Technologies
            </a>
            <a href="{{ route('admin.case-studies.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/case-studies*') ? 'active' : '' }}">
                <i class="fa-solid fa-laptop-code w-8 text-lg"></i> Case Studies
            </a>
            <a href="{{ route('admin.posts.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/posts*') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper w-8 text-lg"></i> Blog Posts
            </a>
            <a href="{{ route('admin.careers.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/careers*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-graduate w-8 text-lg"></i> Careers
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/testimonials*') ? 'active' : '' }}">
                <i class="fa-solid fa-quote-left w-8 text-lg"></i> Testimonials
            </a>
            <a href="{{ route('admin.clients.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/clients*') ? 'active' : '' }}">
                <i class="fa-solid fa-building w-8 text-lg"></i> Clients
            </a>
            <a href="{{ route('admin.certificates.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/certificates*') ? 'active' : '' }}">
                <i class="fa-solid fa-award w-8 text-lg"></i> Certificates
            </a>
            <a href="{{ route('admin.applications.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/applications*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-lines w-8 text-lg"></i> Job Applications
            </a>
            <a href="{{ route('admin.inquiries.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/inquiries*') ? 'active' : '' }}">
                <i class="fa-solid fa-envelope w-8 text-lg"></i> Inquiries
            </a>
            <!-- <a href="{{ route('admin.chats.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-xl transition-all {{ request()->is('admin/chats*') ? 'active' : '' }}">
                <i class="fa-solid fa-comments w-8 text-lg"></i> Live Chat
                <span id="adminChatBadge" class="ml-auto w-5 h-5 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center hidden">0</span>
            </a> -->
            <div x-data="{ openSettings: {{ request()->is('admin/settings*') ? 'true' : 'false' }} }">
                <button @click="openSettings = !openSettings" 
                    class="sidebar-item w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ request()->is('admin/settings*') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <i class="fa-solid fa-sliders w-8 text-lg"></i> Settings
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="openSettings ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openSettings" x-transition class="pl-8 mt-1 space-y-1">
                    <a href="{{ route('admin.settings.index', ['tab' => 'hero']) }}" class="block px-4 py-2 text-sm {{ request()->get('tab') === 'hero' ? 'text-amber-600 font-bold' : 'text-slate-500' }} hover:text-slate-900 rounded-lg hover:bg-slate-50 transition-all border-l-2 border-transparent hover:border-amber-500">
                        Hero Section
                    </a>
                    <a href="{{ route('admin.settings.index', ['tab' => 'about']) }}" class="block px-4 py-2 text-sm {{ request()->get('tab') === 'about' ? 'text-amber-600 font-bold' : 'text-slate-500' }} hover:text-slate-900 rounded-lg hover:bg-slate-50 transition-all border-l-2 border-transparent hover:border-amber-500">
                        About Us
                    </a>
                    <a href="{{ route('admin.settings.index', ['tab' => 'branding']) }}" class="block px-4 py-2 text-sm {{ request()->get('tab') === 'branding' ? 'text-amber-600 font-bold' : 'text-slate-500' }} hover:text-slate-900 rounded-lg hover:bg-slate-50 transition-all border-l-2 border-transparent hover:border-amber-500">
                        Branding
                    </a>
                    <a href="{{ route('admin.settings.index', ['tab' => 'contact']) }}" class="block px-4 py-2 text-sm {{ request()->get('tab') === 'contact' ? 'text-amber-600 font-bold' : 'text-slate-500' }} hover:text-slate-900 rounded-lg hover:bg-slate-50 transition-all border-l-2 border-transparent hover:border-amber-500">
                        Contact Info
                    </a>
                    <a href="{{ route('admin.settings.index', ['tab' => 'privacy']) }}" class="block px-4 py-2 text-sm {{ request()->get('tab') === 'privacy' ? 'text-amber-600 font-bold' : 'text-slate-500' }} hover:text-slate-900 rounded-lg hover:bg-slate-50 transition-all border-l-2 border-transparent hover:border-amber-500">
                        Privacy Policy
                    </a>
                </div>
            </div>
        </nav>

        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left sidebar-item flex items-center px-4 py-3 rounded-xl transition-all text-red-500 hover:bg-red-50 hover:text-red-600 font-medium">
                    <i class="fa-solid fa-sign-out-alt w-8 text-lg"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-h-screen lg:ml-64 transition-all duration-300">
        <!-- Top Bar -->
        <header class="h-20 topbar px-4 lg:px-8 flex items-center justify-between sticky top-0 z-40">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="lg:hidden mr-4 text-slate-500 hover:text-slate-800">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h2 class="text-base lg:text-xl font-bold text-slate-800">@yield('page_title', 'Dashboard')</h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 bg-slate-100 px-3 py-1.5 rounded-full border border-slate-200">
                    <span class="text-xs lg:text-sm font-medium text-slate-600 hidden sm:inline">Welcome, {{ auth()->user()->name ?? 'Admin' }}</span>
                    <div class="w-7 h-7 lg:w-8 lg:h-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold text-xs lg:text-sm shadow-sm">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-4 lg:p-8">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm flex items-center shadow-sm">
                    <i class="fa-solid fa-circle-check mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-sm shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-x-auto lg:overflow-visible">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Admin Chat Badge Polling -->
    <script>
        function updateChatBadge() {
            fetch('{{ route("admin.chats.unread") }}', { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(data => {
                    const badge = document.getElementById('adminChatBadge');
                    if (badge) {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    }
                })
                .catch(() => {});
        }
        updateChatBadge();
        setInterval(updateChatBadge, 10000);
    </script>

    @yield('scripts')
</body>
</html>
