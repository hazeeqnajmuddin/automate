@extends('layouts.app')

@section('title', "User's Profile")

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        
        <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2 mb-8">
            {{ $user->username }}'s Profile
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Profile Picture Section --><div class="flex flex-col items-center md:items-start space-y-4">
                <div class="relative w-40 h-40 rounded-full bg-purple-200 flex items-center justify-center overflow-hidden border-2 border-purple-500">
                    @if ($user->profile_pic_path)
                        <img src="{{ asset('storage/' . $user->profile_pic_path) }}" alt="Profile Picture" class="w-full h-full object-cover">
                    @else
                        <!-- Placeholder Icon --><svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endif
                </div>
                {{-- No edit button here since this is an admin view --}}
            </div>

            <!-- User Information Section --><div class="space-y-4">
                <div>
                    <label class="block text-lg font-medium text-gray-700">Username :</label>
                    <p class="mt-1 text-gray-900">{{ $user->username }}</p>
                </div>
                <div>
                    <label class="block text-lg font-medium text-gray-700">Email :</label>
                    <p class="mt-1 text-gray-900">{{ $user->user_email }}</p>
                </div>
                <div>
                    <label class="block text-lg font-medium text-gray-700">Role :</label>
                    <p class="mt-1 text-gray-900">{{ ucfirst($user->user_role) }}</p>
                </div>
                <div>
                    <label class="block text-lg font-medium text-gray-700">Full Name :</label>
                    <p class="mt-1 text-gray-900">{{ $user->full_name }}</p>
                </div>
                <div>
                    <label class="block text-lg font-medium text-gray-700">Phone Number :</label>
                    <p class="mt-1 text-gray-900">{{ $user->phone_number ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons at the bottom --><div class="flex justify-end space-x-4 pt-8">
            <a href="{{ route('admin.users.index') }}" class="inline-flex justify-center py-2 px-6 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Back to User List
            </a>
            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                Edit User Profile
            </a>
            <a href="{{ route('admin.users.cars', $user) }}" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-900">
                Cars
            </a>
        </div>
    </div>
</div>
@endsection
