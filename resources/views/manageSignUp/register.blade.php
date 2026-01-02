@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<div class="flex justify-center items-center min-h-[90vh] bg-gray-50 p-6">
    <div class="bg-white p-12 rounded-3xl shadow-2xl w-full max-w-xl flex flex-col items-center border border-gray-100">

        <!-- Logo & Brand -->
        <div class="flex flex-col items-center mb-10 group">
            <img src="{{ asset('images/logo.png') }}" alt="Automate Logo" class="w-24 h-auto transform transition-transform group-hover:scale-110 duration-500">
            <h1 class="mt-4 text-4xl font-black text-gray-900 tracking-tighter uppercase italic">Automate</h1>
            <div class="h-1 w-12 bg-indigo-600 mt-1 rounded-full"></div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-8 uppercase tracking-widest">Create Account</h2>

        <!-- Form -->
        <form action="{{ route('register') }}" method="POST" class="w-full space-y-6">
            @csrf

            <!-- Name Field -->
            <div class="space-y-2">
                <label for="name" class="block text-xs font-black uppercase tracking-widest text-gray-500">Full Name</label>
                <input type="text" id="name" name="name"
                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                       placeholder="Enter your full name"
                       value="{{ old('name') }}" required>
                @error('name') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-xs font-black uppercase tracking-widest text-gray-500">Email Address</label>
                <input type="email" id="email" name="email"
                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                       placeholder="email@example.com"
                       value="{{ old('email') }}" required>
                @error('email') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Username -->
            <div class="space-y-2">
                <label for="username" class="block text-xs font-black uppercase tracking-widest text-gray-500">Username</label>
                <input type="text" id="username" name="username"
                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                       placeholder="Choose a username"
                       value="{{ old('username') }}" required>
                @error('username') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-xs font-black uppercase tracking-widest text-gray-500">Password</label>
                    <input type="password" id="password" name="password"
                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                           placeholder="Min. 8 chars"
                           required>
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest text-gray-500">Confirm</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                           placeholder="Repeat password"
                           required>
                </div>
            </div>
            @error('password') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror

            <!-- Sign Up Button -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/30 active:scale-95">
                    Create Account
                </button>
            </div>
        </form>

        <!-- Login link -->
        <p class="mt-8 text-sm text-center text-gray-500 font-medium">
            Already have an account?
            <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Login now!</a>
        </p>
    </div>
</div>
@endsection