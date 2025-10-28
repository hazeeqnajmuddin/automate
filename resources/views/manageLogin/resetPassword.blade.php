@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-gray-300 p-10 rounded-md shadow-md w-full max-w-md flex flex-col items-center">

        <h2 class="text-2xl font-bold mb-6 text-center">Reset Your Password</h2>

        <form method="POST" action="{{ route('password.update') }}" class="w-full space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label for="email" class="block text-lg font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required autofocus
                       class="mt-1 block w-full px-3 py-2 border border-gray-400 rounded-md @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-lg font-medium text-gray-700">New Password:</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-400 rounded-md @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password-confirm" class="block text-lg font-medium text-gray-700">Confirm Password:</label>
                <input type="password" id="password-confirm" name="password_confirmation" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-400 rounded-md">
            </div>
            <div class="flex justify-center pt-4">
                <button type="submit" class="bg-black text-white px-6 py-2 rounded-md font-medium hover:bg-gray-800 transition">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
