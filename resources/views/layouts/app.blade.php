<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Automate Car Service')</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    {{-- Using Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen">

    {{-- Header --}}
    @include('partials.header')

    {{-- Page content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <!-- Sidebar and Overlay Redesign -->
    @auth
        <!-- Overlay with blur effect -->
        <div id="sidebar-overlay" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 transition-opacity duration-300"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="fixed top-0 right-0 h-full w-80 bg-slate-900 text-white transform translate-x-full transition-transform duration-500 ease-in-out z-50 shadow-2xl border-l border-white/10">
            
            <div class="flex flex-col h-full">
                <!-- Sidebar Header -->
                <div class="p-8 border-b border-white/5">
                    <div class="flex justify-between items-center mb-10">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                            <span class="text-xl font-black tracking-tighter uppercase italic text-white">Menu</span>
                        </div>
                        <button id="close-sidebar-btn" class="text-gray-400 hover:text-white transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 transform group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- User Identity in Sidebar -->
                    <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-2xl border border-white/10">
                        <div class="h-12 w-12 rounded-full bg-indigo-600 flex items-center justify-center font-black text-white italic">
                            {{ substr(Auth::user()->username, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-sm font-black uppercase tracking-tighter truncate italic">{{ Auth::user()->username }}</p>
                            <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest truncate">{{ Auth::user()->user_role == 'admin' ? 'System Administrator' : 'Car Owner' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-6 py-8 space-y-2 overflow-y-auto">
                    <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-4">Navigation</p>
                    
                    @if(Auth::user()->user_role == 'admin')
                        {{-- ADMIN LINKS --}}
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-4 px-4 py-4 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-white/10 transition-all border border-transparent hover:border-white/10 group">
                            <span class="text-gray-500 group-hover:text-indigo-400 transition-colors">01.</span>
                            <span>Admin Dashboard</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-4 px-4 py-4 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-white/10 transition-all border border-transparent hover:border-white/10 group">
                            <span class="text-gray-500 group-hover:text-indigo-400 transition-colors">02.</span>
                            <span>Manage Users</span>
                        </a>
                    @else
                        {{-- REGULAR USER LINKS --}}
                        <a href="{{ route('home') }}" class="flex items-center space-x-4 px-4 py-4 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-white/10 transition-all border border-transparent hover:border-white/10 group">
                            <span class="text-gray-500 group-hover:text-indigo-400 transition-colors">01.</span>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('profile.show') }}" class="flex items-center space-x-4 px-4 py-4 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-white/10 transition-all border border-transparent hover:border-white/10 group">
                            <span class="text-gray-500 group-hover:text-indigo-400 transition-colors">02.</span>
                            <span>My Profile</span>
                        </a>
                        <a href="{{ route('cars.index') }}" class="flex items-center space-x-4 px-4 py-4 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-white/10 transition-all border border-transparent hover:border-white/10 group">
                            <span class="text-gray-500 group-hover:text-indigo-400 transition-colors">03.</span>
                            <span>My Garage</span>
                        </a>
                        <a href="{{ route('ai.index') }}" class="flex items-center space-x-4 px-4 py-4 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-white/10 transition-all border border-transparent hover:border-white/10 group">
                            <span class="text-gray-500 group-hover:text-indigo-400 transition-colors">04.</span>
                            <span>AI Health</span>
                        </a>
                    @endif
                </nav>

                <!-- Footer / Logout -->
                <div class="p-8 border-t border-white/5 bg-black/20">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-3 px-6 py-4 bg-red-600/10 text-red-500 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-red-600 hover:text-white transition-all shadow-lg hover:shadow-red-600/20 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                    <p class="text-center text-[8px] font-bold text-gray-600 uppercase tracking-widest mt-6">Automate v1.0 &copy; {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    @endauth

    <script>
        @auth
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.getElementById('sidebar');
                const openBtn = document.getElementById('open-sidebar-btn');
                const closeBtn = document.getElementById('close-sidebar-btn');
                const overlay = document.getElementById('sidebar-overlay');

                function openSidebar() {
                    sidebar.classList.remove('translate-x-full');
                    overlay.classList.remove('hidden');
                    document.body.style.overflow = 'hidden'; // Prevent scroll
                }

                function closeSidebar() {
                    sidebar.classList.add('translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.style.overflow = ''; // Restore scroll
                }

                if(openBtn) openBtn.addEventListener('click', openSidebar);
                if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
                if(overlay) overlay.addEventListener('click', closeSidebar);
            });
        @endauth
    </script>
</body>
</html>