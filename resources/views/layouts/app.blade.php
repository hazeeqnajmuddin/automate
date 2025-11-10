<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Website')</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    
    {{-- @vite('resources/css/app.css') --}}
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

    <!-- UPDATED: Sidebar and Overlay -->
    @auth
        <!-- Overlay -->
        <div id="sidebar-overlay" class="hidden fixed inset-0 bg-black bg-opacity-25 z-30"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="fixed top-0 right-0 h-full w-64 bg-gray-800 text-white transform translate-x-full transition-transform duration-300 ease-in-out z-40">
            <div class="p-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Menu</h2>
                    <button id="close-sidebar-btn" class="text-white hover:text-gray-300 text-2xl font-bold">&times;</button>
                </div>
                
                <!-- DYNAMIC LINKS BASED ON USER ROLE -->
                <nav class="flex flex-col space-y-2">
                    @if(Auth::user()->user_role == 'admin')
                        {{-- ADMIN LINKS --}}
                        <a href="{{ route('admin.dashboard') }}" class="hover:bg-gray-700 p-2 rounded">Admin Dashboard</a>
                        <a href="{{ route('admin.users.index') }}" class="hover:bg-gray-700 p-2 rounded">Manage Users</a>
                        {{-- You can add other admin-specific links here --}}
                    @else
                        {{-- REGULAR USER (CAR OWNER) LINKS --}}
                        <a href="{{ route('home') }}" class="hover:bg-gray-700 p-2 rounded">Home</a>
                        <a href="{{ route('profile.show') }}" class="hover:bg-gray-700 p-2 rounded">My Profile</a>
                        <a href="{{ route('cars.index') }}" class="hover:bg-gray-700 p-2 rounded">My Cars</a>
                        <a href="{{ route('ai.index') }}" class="hover:bg-gray-700 p-2 rounded">AI Recommendation</a>
                    @endif
                    
                    <hr class="border-gray-600 my-2">

                    <!-- Logout Form (same for both roles) -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left hover:bg-gray-700 p-2 rounded">
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>
    @endauth
    <!-- END: Sidebar and Overlay -->


    <!-- JavaScript to control the sidebar -->
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
                }

                function closeSidebar() {
                    sidebar.classList.add('translate-x-full');
                    overlay.classList.add('hidden');
                }

                if(openBtn) {
                    openBtn.addEventListener('click', openSidebar);
                }
                if(closeBtn) {
                    closeBtn.addEventListener('click', closeSidebar);
                }
                if(overlay) {
                    overlay.addEventListener('click', closeSidebar);
                }
            });
        @endauth
    </script>

</body>
</html>
