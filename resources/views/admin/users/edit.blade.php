@extends('layouts.app')

@section('title', 'Admin: Edit User ' . $user->username)

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <!-- Top Header with Back Button -->
        <header class="flex justify-between items-center mb-12">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600"></span>
                    <span>Administrative Edit Mode</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Edit <span class="text-indigo-600">User</span>
                </h1>
            </div>
            
            <a href="{{ route('admin.users.index') }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
            
            <!-- Left Side: User Context Card -->
            <div class="w-full lg:w-1/3 flex sticky top-24">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center w-full border-4 border-indigo-500/30 group">
                    
                    <div class="relative">
                        <div class="relative w-48 h-48 rounded-full bg-slate-800 flex items-center justify-center border-4 border-indigo-500 overflow-hidden shadow-2xl">
                            <img id="profile-pic-preview" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                 src="{{ $user->profile_pic_path ? asset('storage/' . $user->profile_pic_path) : 'https://placehold.co/200x200/1e293b/4f46e5?text=' . substr($user->username, 0, 1) }}" 
                                 alt="Profile preview" />
                        </div>
                        <!-- Role Badge -->
                        <div class="absolute -top-2 -right-2 {{ $user->user_role == 'admin' ? 'bg-amber-500' : 'bg-emerald-500' }} text-white px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg border-2 border-slate-900">
                            {{ $user->user_role == 'admin' ? 'System Admin' : 'Car Owner' }}
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic">{{ $user->username }}</h2>
                        <p class="text-indigo-300 font-bold mt-1 uppercase tracking-widest text-[10px]">Editing Account UID #{{ str_pad($user->user_id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>

                    <!-- Informational Box -->
                    <div class="mt-10 w-full bg-white/5 p-6 rounded-2xl border border-white/10 text-center">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Database Integrity</p>
                        <p class="text-xs text-indigo-200 mt-2 font-medium px-4 leading-relaxed italic">"Modification of user credentials requires system administrative privileges."</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Edit Form -->
            <div class="w-full lg:w-2/3 flex flex-col">
                <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 flex-1">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-8 italic border-b border-gray-100 pb-4">Account Modifications</h3>

                        <!-- Profile Picture Upload -->
                        <div class="flex items-center space-x-6 bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-200">
                            <div class="shrink-0 p-2 bg-white rounded-xl shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <label for="profile_pic_input" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Update Avatar (Optional)</label>
                                <input type="file" name="profile_pic" id="profile_pic_input" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition cursor-pointer"/>
                            </div>
                        </div>
                        @error('profile_pic') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Full Name -->
                            <div class="space-y-2">
                                <label for="full_name" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Full Name</label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" 
                                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold" required>
                                @error('full_name') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Username -->
                            <div class="space-y-2">
                                <label for="username" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Username</label>
                                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" 
                                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold" required>
                                @error('username') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="user_email" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Email Address</label>
                                <input type="email" id="user_email" name="user_email" value="{{ old('user_email', $user->user_email) }}" 
                                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold" required>
                                @error('user_email') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="space-y-2">
                                <label for="phone_number" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Phone Number</label>
                                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" 
                                       class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold">
                                @error('phone_number') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- User Role -->
                            <div class="space-y-2">
                                <label for="user_role" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">System Role</label>
                                <select id="user_role" name="user_role" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold appearance-none" required>
                                    <option value="car_owner" {{ old('user_role', $user->user_role) == 'car_owner' ? 'selected' : '' }}>Car Owner (Standard)</option>
                                    <option value="admin" {{ old('user_role', $user->user_role) == 'admin' ? 'selected' : '' }}>System Admin (Full Access)</option>
                                </select>
                                @error('user_role') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- New Password -->
                            <div class="space-y-2">
                                <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Reset Password (Optional)</label>
                                <input type="password" id="password" name="password" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" placeholder="New password">
                                @error('password') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end items-center space-x-4 pt-12 border-t border-gray-50">
                            <a href="{{ route('admin.users.index') }}" class="px-8 py-4 border-2 border-gray-100 text-gray-400 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-50 hover:text-gray-800 transition-all">
                                Cancel
                            </a>
                            <button type="submit" class="px-12 py-4 bg-indigo-600 text-white rounded-xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/30 active:scale-95">
                                Update User Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for image preview --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('profile_pic_input');
        const previewImage = document.getElementById('profile-pic-preview');

        if (fileInput && previewImage) {
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
        }
    });
</script>
@endsection