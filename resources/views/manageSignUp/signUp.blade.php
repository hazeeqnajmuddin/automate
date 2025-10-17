@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-gray-300 p-10 rounded-md shadow-md w-[500px] flex flex-col items-center">

        <!-- Logo -->
        <div class="w-20 h-20 bg-black rounded-full flex items-center justify-center text-white font-bold mb-6">
            LOGO
        </div>

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="w-full max-w-sm space-y-4">
            @csrf

            <!-- Email -->
            <div class="flex items-center justify-between">
                <label for="email" class="text-lg font-medium">Email:</label>
                <input type="email" id="email" name="email"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" required>
            </div>

            <!-- Username -->
            <div class="flex items-center justify-between">
                <label for="username" class="text-lg font-medium">Username:</label>
                <input type="text" id="username" name="username"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" required>
            </div>

            <!-- Password -->
            <div class="flex items-center justify-between">
                <label for="password" class="text-lg font-medium">Password:</label>
                <input type="password" id="password" name="password"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" required>
            </div>

            <!-- Sign Up Button -->
            <div class="flex justify-center pt-2">
                <button type="submit"
                        class="bg-black text-white px-10 py-2 rounded-md font-medium hover:bg-gray-800 transition">
                    Sign Up
                </button>
            </div>
        </form>

        <!-- Signup link -->
        <p class="mt-6 text-sm text-center">
            Already have an account?
            <a 
            href="{{ route('login') }}" class="font-semibold underline hover:text-gray-700"
            >Login now!</a>
        </p>
    </div>
</div>
@endsection
