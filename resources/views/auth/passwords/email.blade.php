@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-gray-300 p-10 rounded-md shadow-md w-full max-w-md flex flex-col items-center">
        
        <h2 class="text-2xl font-bold mb-6 text-center">Forgot Your Password?</h2>
        <p class="mb-6 text-sm text-gray-600 text-center">
            No problem. Just let us know your email address and we will email you a password reset link.
        </p>

        <!-- Session Status Message (e.g., "Reset link sent!") -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-700 bg-green-100 border border-green-400 p-3 rounded-md w-full text-center" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="w-full space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-lg font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 block w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center pt-4">
                <button type="submit" class="bg-black text-white px-6 py-2 rounded-md font-medium hover:bg-gray-800 transition">
                    Email Password Reset Link
                </button>
            </div>
            <div class="text-center mt-4">
                 <a href="{{ route('login') }}" class="text-sm text-gray-600 underline hover:text-gray-900">
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
