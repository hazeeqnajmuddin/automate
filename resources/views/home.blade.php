@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto p-4 md:p-12">

    <!-- Success Message 'Pop-up' -->
    @if (session('success'))
        <div id="success-popup" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-8 shadow-sm" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>

        <script>
            setTimeout(() => {
                const popup = document.getElementById('success-popup');
                if (popup) {
                    popup.style.transition = 'opacity 0.5s ease';
                    popup.style.opacity = '0';
                    setTimeout(() => popup.remove(), 500);
                }
            }, 5000);
        </script>
    @endif

    <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[60vh]">
        
        <!-- Left Side: Hero Logo Section -->
        <div class="w-full lg:w-1/3 flex sticky top-24">
            <div class="bg-slate-800 p-12 rounded-3xl shadow-2xl flex flex-col items-center justify-center w-full border-4 border-white/10 group transition-all duration-500 hover:shadow-indigo-500/20">
                <div class="relative">
                    <img src="{{ asset('images/logo.png') }}" alt="Automate Logo" class="w-full max-w-xs h-auto transform transition-transform group-hover:scale-110 duration-500 drop-shadow-2xl">
                    <!-- Subtle Glow Effect -->
                    <div class="absolute inset-0 bg-indigo-500/20 blur-3xl rounded-full -z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <div class="mt-12 text-center">
                    <h2 class="text-4xl font-black text-white tracking-tighter uppercase italic">Automate</h2>
                    <div class="h-1 w-24 bg-indigo-500 mx-auto mt-2 rounded-full"></div>
                    <p class="text-indigo-200 font-medium mt-4 tracking-wide">Smart Care for Your Car</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Quick Actions -->
        <div class="w-full lg:w-2/3 flex flex-col justify-center">
            <header class="mb-10">
                <h1 class="text-5xl font-black text-gray-900 leading-tight">Welcome Back, <span class="text-indigo-600">{{ Auth::user()->full_name }}</span>!</h1>
                <p class="text-xl text-gray-500 mt-4 max-w-xl">Efficiency at your fingertips. Manage your vehicles and get real-time AI service recommendations.</p>
            </header>

            <h3 class="text-2xl font-bold text-gray-800 mb-8 flex items-center">
                <span class="p-2 bg-indigo-100 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
                Quick Actions
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- View My Cars Card -->
                <a href="{{ route('cars.index') }}" class="group bg-white p-8 rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1 transition-all duration-300 border-b-4 border-b-indigo-500">
                    <div class="flex items-center space-x-6">
                        <div class="p-4 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-xl text-gray-900">My Garage</h4>
                            <p class="text-gray-500 mt-1">View and manage vehicles.</p>
                        </div>
                    </div>
                </a>

                <!-- Add New Car Card -->
                <a href="{{ route('cars.create') }}" class="group bg-white p-8 rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-green-500/10 hover:-translate-y-1 transition-all duration-300 border-b-4 border-b-green-500">
                    <div class="flex items-center space-x-6">
                        <div class="p-4 bg-green-50 text-green-600 rounded-2xl group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-xl text-gray-900">Add New Car</h4>
                            <p class="text-gray-500 mt-1">Register vehicle today.</p>
                        </div>
                    </div>
                </a>

                <!-- AI Recommender Card -->
                <a href="{{ route('ai.index') }}" class="group bg-white p-8 rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-purple-500/10 hover:-translate-y-1 transition-all duration-300 border-b-4 border-b-purple-500">
                    <div class="flex items-center space-x-6">
                        <div class="p-4 bg-purple-50 text-purple-600 rounded-2xl group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-xl text-gray-900">AI Health Check</h4>
                            <p class="text-gray-500 mt-1">Smart recommendations.</p>
                        </div>
                    </div>
                </a>

                <!-- My Profile Card -->
                <a href="{{ route('profile.show') }}" class="group bg-white p-8 rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 border-b-4 border-b-orange-500">
                    <div class="flex items-center space-x-6">
                        <div class="p-4 bg-orange-50 text-orange-600 rounded-2xl group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-xl text-gray-900">Account Settings</h4>
                            <p class="text-gray-500 mt-1">Manage personal data.</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <!-- Full-width Help Section just above the footer -->
    <div class="mt-20 w-full">
        <div class="bg-gradient-to-r from-slate-800 to-indigo-900 p-10 rounded-3xl text-center shadow-xl">
            <h4 class="text-2xl font-bold text-white mb-2">Stuck or Need Assistance?</h4>
            <p class="text-indigo-200 text-lg mb-6">Our dedicated support team is here to help you get the most out of Automate.</p>
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="#" class="px-8 py-3 bg-white text-indigo-900 rounded-full font-bold hover:bg-indigo-50 transition-colors shadow-lg">Visit Support Center</a>
                <a href="#" class="px-8 py-3 border-2 border-indigo-400 text-white rounded-full font-bold hover:bg-white/10 transition-all">Read Safety Tips</a>
            </div>
            <p class="text-indigo-300/60 text-sm mt-8">Copyright &copy; {{ date('Y') }} Automate Car Service. All systems operational.</p>
        </div>
    </div>
</div>
@endsection