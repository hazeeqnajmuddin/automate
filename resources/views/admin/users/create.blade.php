@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-2xl mx-auto">
        
        <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2 mb-8">Add New User</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Profile Picture Section -->
                <div class="flex items-center space-x-6">
                    <div class="shrink-0">
                        <img id="profile-pic-preview" class="h-20 w-20 object-cover rounded-full" src="https://placehold.co/80x80/e2e8f0/e2e8f0" alt="Profile photo placeholder" />
                    </div>
                    <label class="block">
                        <span class="text-gray-700">Choose profile photo</span>
                        <input type="file" name="profile_pic" id="profile_pic_input" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
                    </label>
                </div>
                @error('profile_pic') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror


                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-lg font-medium text-gray-700">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-lg font-medium text-gray-700">Username:</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="user_email" class="block text-lg font-medium text-gray-700">Email:</label>
                    <input type="email" id="user_email" name="user_email" value="{{ old('user_email') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('user_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- phone number -->
<div>
    <label for="phone_number" class="block text-lg font-medium text-gray-700">Phone Number:</label>
    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    @error('phone_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

                <!-- User Role -->
                <div>
                    <label for="user_role" class="block text-lg font-medium text-gray-700">Role:</label>
                    <select id="user_role" name="user_role" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="car_owner" {{ old('user_role') == 'car_owner' ? 'selected' : '' }}>Car Owner</option>
                        <option value="admin" {{ old('user_role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('user_role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-lg font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                 <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex justify-center py-2 px-6 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-900">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- JavaScript for image preview --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('profile_pic_input');
        const previewImage = document.getElementById('profile-pic-preview');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection

