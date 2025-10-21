@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-gray-300 p-10 rounded-md shadow-md w-[500px] flex flex-col items-center">

        <!-- Logo -->
        <img src="{{ asset('images/logo3.png') }}" alt="Automate Logo" class="w-32 h-auto">

        <!-- Form -->
        <!-- CHANGED: The form action now points to the 'register' route -->
        <form action="{{ route('register') }}" method="POST" class="w-full max-w-sm space-y-4">
            @csrf

            <!-- ADDED: Name Field -->
            <div class="flex items-center justify-between">
                <label for="name" class="text-lg font-medium">Name:</label>
                <input type="text" id="name" name="name"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" value="{{ old('name') }}" required>
            </div>
            <!-- ADDED: Error message for name -->
            @error('name') <p class="text-red-500 text-xs text-right w-full -mt-3">{{ $message }}</p> @enderror

            <!-- Email -->
            <div class="flex items-center justify-between">
                <label for="email" class="text-lg font-medium">Email:</label>
                <input type="email" id="email" name="email"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" value="{{ old('email') }}" required>
            </div>
            <!-- ADDED: Error message for email -->
            @error('email') <p class="text-red-500 text-xs text-right w-full -mt-3">{{ $message }}</p> @enderror

            <!-- Username -->
            <div class="flex items-center justify-between">
                <label for="username" class="text-lg font-medium">Username:</label>
                <input type="text" id="username" name="username"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" value="{{ old('username') }}" required>
            </div>
            <!-- ADDED: Error message for username -->
            @error('username') <p class="text-red-500 text-xs text-right w-full -mt-3">{{ $message }}</p> @enderror

            <!-- Password -->
            <div class="flex items-center justify-between">
                <label for="password" class="text-lg font-medium">Password:</label>
                <input type="password" id="password" name="password"
                       class="border border-gray-400 rounded px-3 py-1 w-[60%]" required>
            </div>
            <!-- ADDED: Error message for password -->
            @error('password') <p class="text-red-500 text-xs text-right w-full -mt-3">{{ $message }}</p> @enderror

            <!-- ADDED: Confirm Password Field -->
            <div class="flex items-center justify-between">
                <label for="password_confirmation" class="text-lg font-medium">Confirm:</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
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

        <!-- Login link -->
        <p class="mt-6 text-sm text-center">
            Already have an account?
            <a 
            href="{{ route('login') }}" class="font-semibold underline hover:text-gray-700"
            >Login now!</a>
        </p>
    </div>
</div>
@endsection
