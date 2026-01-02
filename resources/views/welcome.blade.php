@extends('layouts.app')

@section('title', 'Welcome to Automate')

@section('content')
<div class="relative min-h-[90vh] flex flex-col justify-center overflow-hidden bg-white">
    
    <!-- Background Decorative Elements -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-50 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-50 rounded-full blur-3xl opacity-60"></div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <!-- Left Side: Content -->
            <div class="w-full lg:w-1/2 text-center lg:text-left space-y-8 order-2 lg:order-1">
                <div class="inline-flex items-center space-x-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-full text-xs font-black uppercase tracking-widest shadow-sm">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>AI-Powered Car Diagnostics</span>
                </div>
                
                <h1 class="text-6xl md:text-7xl font-black text-gray-900 leading-[0.9] tracking-tighter uppercase italic">
                    Smart Care <br>
                    <span class="text-indigo-600">For Your Car</span>
                </h1>
                
                <p class="text-xl text-gray-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Experience the future of automotive maintenance. Our intelligent system uses decision tree logic to provide real-time health checks and professional service recommendations.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    @guest
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-500/40 hover:-translate-y-1">
                            Get Started Now
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-gray-900 border-2 border-gray-100 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-gray-50 transition-all hover:-translate-y-1">
                            Sign In
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="w-full sm:w-auto px-10 py-5 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-500/40 hover:-translate-y-1">
                            Go to Dashboard
                        </a>
                    @endguest
                </div>
                
                <div class="flex items-center justify-center lg:justify-start space-x-8 pt-8 opacity-50 grayscale">
                    <span class="text-xs font-bold uppercase tracking-widest">Trusted Data From</span>
                    <div class="flex space-x-6 text-2xl font-black italic tracking-tighter">
                        <span>TOYOTA</span>
                        <span>HONDA</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Visual Hero -->
            <div class="w-full lg:w-1/2 order-1 lg:order-2">
                <div class="relative group">
                    <!-- Decorative Ring -->
                    <div class="absolute inset-0 bg-indigo-600/5 rounded-full scale-110 blur-2xl group-hover:bg-indigo-600/10 transition-colors duration-500"></div>
                    
                    <div class="relative bg-slate-800 p-16 rounded-[3rem] shadow-3xl shadow-indigo-900/20 transform -rotate-2 hover:rotate-0 transition-all duration-700 border-8 border-white">
                        <img src="{{ asset('images/logo4.png') }}" alt="Automate Logo" class="w-full h-auto drop-shadow-2xl transform transition-transform group-hover:scale-105 duration-700">
                        
                        <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-3xl shadow-xl border border-gray-100 hidden md:block animate-bounce-slow">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">System Status</p>
                                    <p class="text-sm font-bold text-gray-900">Health Check Active</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 4s infinite ease-in-out;
    }
</style>
@endsection