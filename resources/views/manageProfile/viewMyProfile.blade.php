@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto p-4 md:p-12">

    <!-- Success Message 'Pop-up' -->
    @if (session('status') === 'profile-updated' || session('status') === 'avatar-updated')
        <div id="success-popup" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-8 shadow-sm flex justify-between items-center" role="alert">
            <div>
                <p class="font-black uppercase tracking-widest text-xs">System Notification</p>
                <p class="font-bold">Your profile has been successfully updated.</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">✕</button>
        </div>

        <script>
            setTimeout(() => {
                const popup = document.getElementById('success-popup');
                if (popup) {
                    popup.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    popup.style.opacity = '0';
                    popup.style.transform = 'translateY(-20px)';
                    setTimeout(() => popup.remove(), 500);
                }
            }, 5000);
        </script>
    @endif

    <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
        
        <!-- Left Side: Profile Identity Card -->
        <div class="w-full lg:w-1/3 flex sticky top-24">
            <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center w-full border-4 border-indigo-500/30 group transition-all duration-500">
                
                <!-- Avatar Section -->
                <div class="relative group">
                    <form id="avatar-form" action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="relative w-48 h-48 rounded-full bg-slate-800 flex items-center justify-center border-4 border-indigo-500 overflow-hidden shadow-2xl">
                            @if (Auth::user()->profile_pic_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_pic_path) }}" alt="Profile Picture" class="w-full h-full object-cover transform transition-transform group-hover:scale-110 duration-500">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @endif

                            <!-- Overaly for upload -->
                            <div id="edit-avatar-btn" class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*">
                    </form>

                    <!-- Status Badge -->
                    <div class="absolute -top-2 -right-2 bg-green-500 text-white px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg border-2 border-slate-900">
                        Active User
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic">{{ Auth::user()->username }}</h2>
                    <p class="text-indigo-300 font-bold mt-1 uppercase tracking-widest text-[10px]">{{ Auth::user()->user_email }}</p>
                </div>

                <!-- Garage Stats (New Feature) -->
                <div class="mt-10 w-full bg-white/5 p-6 rounded-2xl border border-white/10 text-center">
                    <p class="text-xs font-black text-indigo-400 uppercase tracking-widest mb-1">Garage Summary</p>
                    <p class="text-3xl font-black text-white italic tracking-tighter">{{ Auth::user()->cars->count() }} Vehicles</p>
                    <a href="{{ route('cars.index') }}" class="text-[10px] font-bold text-gray-400 hover:text-white transition-colors uppercase tracking-widest mt-2 block underline">Manage Garage</a>
                </div>
            </div>
        </div>

        <!-- Right Side: Profile Settings -->
        <div class="w-full lg:w-2/3 flex flex-col">
            <header class="mb-12 flex justify-between items-start">
                <div>
                    <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                        Account <span class="text-indigo-600">Settings</span>
                    </h1>
                    <p class="text-xl text-gray-500 mt-2 font-medium">Update your personal information and security credentials.</p>
                </div>
                <!-- Back Button -->
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </header>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Full Name -->
                    <div class="space-y-2">
                        <label for="full_name" class="block text-xs font-black uppercase tracking-widest text-gray-500">Full Name</label>
                        <input type="text" id="full_name" name="full_name"
                               class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold" 
                               value="{{ old('full_name', $user->full_name) }}">
                        @error('full_name') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="space-y-2">
                        <label for="phone_number" class="block text-xs font-black uppercase tracking-widest text-gray-500">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number"
                               class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold" 
                               value="{{ old('phone_number', $user->phone_number) }}">
                        @error('phone_number') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- New Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-xs font-black uppercase tracking-widest text-gray-500">New Password</label>
                        <input type="password" id="password" name="password"
                               class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                               placeholder="Leave blank to keep current">
                        @error('password') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest text-gray-500">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50" 
                               placeholder="Repeat new password">
                    </div>
                </div>

                <!-- Account Status Info (Read-only section) -->
                <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-gray-100 mt-8">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-4 italic">Security Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                         <div class="flex justify-between items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                            <span class="text-gray-400 font-bold uppercase tracking-widest text-[9px]">Account Created</span>
                            <span class="text-gray-800 font-black text-[10px] uppercase tracking-tighter">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                            <span class="text-gray-400 font-bold uppercase tracking-widest text-[9px]">Platform Role</span>
                            <span class="px-3 py-0.5 bg-indigo-100 text-indigo-800 rounded-full font-black text-[9px] uppercase tracking-widest">{{ ucfirst(str_replace('_', ' ', $user->user_role)) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="pt-6 flex justify-end">
                    <button type="submit"
                            class="px-12 py-4 bg-indigo-600 text-white rounded-xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/30 active:scale-95">
                        Save Profile Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButton = document.getElementById('edit-avatar-btn');
        const fileInput = document.getElementById('avatar-input');
        const avatarForm = document.getElementById('avatar-form');

        if (editButton && fileInput) {
            editButton.addEventListener('click', () => fileInput.click());
            
            fileInput.addEventListener('change', function () {
                if (fileInput.files.length > 0) {
                    avatarForm.submit();
                }
            });
        }
    });
</script>
@endsection