<!-- Header / Navigation Bar -->
<header class="sticky top-0 z-30">
    <nav class="bg-slate-800 flex justify-between items-center px-6 py-3 text-white shadow-xl">

        <!-- Logo Section -->
        <div class="flex items-center space-x-3">
            <a href="{{ Auth::check() && Auth::user()->user_role == 'admin' ? route('admin.dashboard') : url('/') }}" class="flex items-center space-x-3 group">
                {{-- MODIFIED: Replaced the div with an img tag for the logo and added brand text --}}
                <img src="{{ asset('images/logo.png') }}" alt="Automate Logo" class="h-12 w-auto transform transition-transform group-hover:scale-110 duration-300">
                <span class="text-2xl font-black tracking-tighter uppercase italic group-hover:text-indigo-400 transition-colors duration-300">Automate</span>
            </a>
        </div>

        <!-- Links Section -->
        <div class="flex items-center space-x-6">
            
            @auth
                {{-- LOGGED-IN USER HEADER --}}
                <div class="flex items-center space-x-6">
                    @if(Auth::user()->user_role == 'admin')
                        {{-- Admin Header Title --}}
                        <div class="hidden md:flex items-center space-x-4">
                            <a href="{{ route('admin.users.index') }}" class="font-bold text-sm uppercase tracking-widest text-gray-300 hover:text-white transition-colors">Manage System Users</a>
                        </div>
                    @else
                        {{-- Regular User Header Links --}}
                        <div class="hidden md:flex items-center space-x-6">
                            <a href="{{ route('home') }}" class="font-bold text-sm uppercase tracking-widest text-gray-300 hover:text-white transition-colors">Home</a>
                            <a href="{{ route('profile.show') }}" class="font-bold text-sm uppercase tracking-widest text-gray-300 hover:text-white transition-colors">My Profile</a>
                            <a href="{{ route('cars.index') }}" class="font-bold text-sm uppercase tracking-widest text-gray-300 hover:text-white transition-colors">My Garage</a>
                            <a href="{{ route('ai.index') }}" class="font-bold text-sm uppercase tracking-widest text-gray-300 hover:text-white transition-colors">AI Health</a>
                        </div>
                    @endif
                    
                    <!-- Settings Icon to open sidebar (visible to all logged-in users) -->
                    <button id="open-sidebar-btn" class="p-2 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>

            @else
                <!-- Guest User Links -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="font-bold text-sm uppercase tracking-widest text-gray-300 hover:text-white transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/20">
                        Sign Up
                    </a>
                </div>
            @endauth
            
        </div>
    </nav>
</header>