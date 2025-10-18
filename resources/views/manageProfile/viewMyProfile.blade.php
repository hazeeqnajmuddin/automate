@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto">
        
        <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2 mb-8">My Profile</h1>

        <!-- Success Message -->
        @if (session('status') === 'profile-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">Your profile has been updated.</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Profile Picture Section -->
            <div class="flex flex-col items-center md:items-start">
                <div class="relative w-40 h-40 rounded-full bg-purple-200 flex items-center justify-center mb-4">
                    <!-- Placeholder Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <button class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100">
                        <!-- Edit Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 6.732z" /></svg>
                    </button>
                </div>
            </div>

            <!-- Profile Details Form -->
            <div class="md:col-span-2">
                <form action="
                {{-- {{ route('profile.update') }} --}}
                " method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-lg font-medium text-gray-700">Username:</label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}" class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm sm:text-sm" disabled>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-lg font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm sm:text-sm" disabled>
                    </div>

                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-lg font-medium text-gray-700">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-lg font-medium text-gray-700">Phone Number:</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                         @error('phone_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-lg font-medium text-gray-700">New Password:</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                     <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Confirm Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Save Button -->
                    <div class="text-right">
                        <button type="submit" class="inline-flex justify-center py-2 px-8 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
