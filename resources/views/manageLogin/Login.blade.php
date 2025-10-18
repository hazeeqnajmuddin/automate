@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-gray-300 p-10 rounded-md shadow-md w-[500px] flex flex-col items-center">

        <!-- Logo -->
        <div class="w-20 h-20 bg-black rounded-full flex items-center justify-center text-white font-bold mb-6">
            LOGO
        </div>

         <!-- THIS IS THE SECTION THAT DISPLAYS THE TOAST -->
        @if (session('success'))
            <div id="success-popup" class="mb-4 font-medium text-sm text-green-700 bg-green-100 border border-green-400 p-3 rounded-md w-full text-center" role="alert">
                {{ session('success') }}
            </div>

            <script>
                // Optional: Automatically hide the message after 5 seconds
                setTimeout(() => {
                    const popup = document.getElementById('success-popup');
                    if (popup) {
                        popup.style.transition = 'opacity 0.5s ease';
                        popup.style.opacity = '0';
                        setTimeout(() => popup.remove(), 500); // Remove from DOM after fade out
                    }
                }, 5000);
            </script>
        @endif
        <!-- End Toast Section -->

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="w-full max-w-sm space-y-4">
            @csrf

            <!-- Username -->
            <div class="flex items-center justify-between">
                <label for="username" class="text-lg font-medium">Username:</label>
                <input type="text" id="username" name="username"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" required>
            </div>
            
            {{-- ADD THIS ERROR BLOCK --}}
            @error('username')
                <div class="text-red-500 text-sm text-right w-full">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <div class="flex items-center justify-between">
                <label for="password" class="text-lg font-medium">Password:</label>
                <input type="password" id="password" name="password"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" required>
            </div>

            <!-- Forgot password -->
            <div class="text-right">
                <a 
                {{-- href="{{ route('password.request') }}" class="text-sm text-black underline hover:text-gray-700" --}}
                >
                    Forgot Password?
                </a>
            </div>

            <!-- Login Button -->
            <div class="flex justify-center pt-2">
                <button type="submit"
                        class="bg-black text-white px-10 py-2 rounded-md font-medium hover:bg-gray-800 transition">
                    Login
                </button>
            </div>
        </form>

        <!-- Signup link -->
        <p class="mt-6 text-sm text-center">
            Don’t have an account? 
            <a 
            href="{{ route('register') }}" class="font-semibold underline hover:text-gray-700"
            >Sign Up now!</a>
        </p>
    </div>
</div>
@endsection
