<!-- Header / Navigation Bar -->
<header>
    <nav class="bg-gray-600 flex justify-between items-center px-6 py-3 text-white">

        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <a 
                href="{{ url('/') }}" 
                class="w-20 h-20 bg-black rounded-full flex items-center justify-center text-white font-bold text-sm hover:bg-gray-800 transition text-center"
            >
                Automate
            </a>
        </div>

        <!-- Links Section -->
        <div class="flex items-center space-x-6">
            
            @auth
                <!-- Authenticated (Logged-In) User Links -->
                <a href="#" class="hover:text-gray-300 transition">My Profile</a>
                <a href="#" class="hover:text-gray-300 transition">My Cars</a>
                <a href="#" class="hover:text-gray-300 transition">AI</a>
                
                <!-- Logout Form with Settings Icon -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-gray-300 transition" title="Logout">
                        <!-- SVG for Settings Gear Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </form>

            @else
                <!-- Guest User Links -->
                <a href="{{ route('login') }}" class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition">
                    Sign Up
                </a>
            @endguest
            
        </div>
    </nav>
</header>
