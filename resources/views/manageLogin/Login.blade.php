@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex justify-center items-center min-h-[90vh] bg-gray-50 p-6">
    <div class="bg-white p-12 rounded-3xl shadow-2xl w-full max-w-xl flex flex-col items-center border border-gray-100">

        <!-- Logo & Brand -->
        <div class="flex flex-col items-center mb-10 group">
            <img src="{{ asset('images/logo.png') }}" alt="Automate Logo" class="w-24 h-auto transform transition-transform group-hover:scale-110 duration-500">
            <h1 class="mt-4 text-4xl font-black text-gray-900 tracking-tighter uppercase italic">CIMS</h1>
            <div class="h-1 w-12 bg-indigo-600 mt-1 rounded-full"></div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-8 uppercase tracking-widest">Welcome Back</h2>

        <!-- THIS IS THE SECTION THAT DISPLAYS THE TOAST -->
        @if (session('success'))
            <div id="success-popup" class="mb-6 w-full font-bold text-[10px] uppercase tracking-widest text-green-700 bg-green-50 border-2 border-green-100 p-4 rounded-xl text-center shadow-sm" role="alert">
                {{ session('success') }}
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
        <!-- End Toast Section -->

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="w-full space-y-6">
            @csrf

            <!-- Username -->
            <div class="space-y-2">
                <label for="username" class="block text-xs font-black uppercase tracking-widest text-gray-500">Username</label>
                <input type="text" id="username" name="username"
                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                       placeholder="Enter your credentials"
                       value="{{ old('username') }}" required>
                @error('username') 
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <label for="password" class="block text-xs font-black uppercase tracking-widest text-gray-500">Password</label>
                    <a href="{{ route('password.request') }}" class="text-[10px] font-bold uppercase tracking-widest text-indigo-600 hover:text-indigo-800 transition-colors">
                        Forgot?
                    </a>
                </div>
                <input type="password" id="password" name="password"
                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                       placeholder="••••••••"
                       required>
            </div>

            <!-- Login Button -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/30 active:scale-95">
                    Login to Account
                </button>
            </div>
        </form>

        <!-- Signup link -->
        <p class="mt-8 text-sm text-center text-gray-500 font-medium">
            Don’t have an account? 
            <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Sign Up now!</a>
        </p>
    </div>
</div>
@endsection