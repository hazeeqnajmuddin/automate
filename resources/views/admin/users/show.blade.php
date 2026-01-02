@extends('layouts.app')

@section('title', "Admin View: " . $user->username)

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <!-- Top Header with Back Button -->
        <header class="flex justify-between items-center mb-12">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600"></span>
                    <span>Administrative Profile View</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    User <span class="text-indigo-600">Profile</span>
                </h1>
            </div>
            
            <a href="{{ route('admin.users.index') }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-stretch">
            
            <!-- Left Side: User Identity Card -->
            <div class="w-full lg:w-1/3 flex">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center w-full border-4 border-indigo-500/30">
                    <div class="relative group">
                        <div class="relative w-48 h-48 rounded-full bg-slate-800 flex items-center justify-center border-4 border-indigo-500 overflow-hidden shadow-2xl">
                            @if ($user->profile_pic_path)
                                <img src="{{ asset('storage/' . $user->profile_pic_path) }}" alt="Profile Picture" class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @endif
                        </div>
                        <!-- Role Badge -->
                        <div class="absolute -top-2 -right-2 {{ $user->user_role == 'admin' ? 'bg-amber-500' : 'bg-emerald-500' }} text-white px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg border-2 border-slate-900">
                            {{ $user->user_role == 'admin' ? 'System Admin' : 'Car Owner' }}
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic">{{ $user->username }}</h2>
                        <p class="text-indigo-300 font-bold mt-1 uppercase tracking-widest text-[10px]">{{ $user->user_email }}</p>
                    </div>

                    <!-- Quick Admin Stats -->
                    <div class="mt-10 w-full bg-white/5 p-6 rounded-2xl border border-white/10 text-center">
                        <p class="text-xs font-black text-indigo-400 uppercase tracking-widest mb-1">Asset Ownership</p>
                        <p class="text-3xl font-black text-white italic tracking-tighter">{{ $user->cars->count() }} Vehicles</p>
                        <a href="{{ route('admin.users.cars', $user) }}" class="text-[10px] font-bold text-gray-400 hover:text-white transition-colors uppercase tracking-widest mt-2 block underline">Inspect Garage</a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Detailed Information -->
            <div class="w-full lg:w-2/3 flex flex-col">
                <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 flex-1">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-8 italic border-b border-gray-100 pb-4">Personal Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Full Name</span>
                            <p class="text-xl font-bold text-gray-900 leading-tight">{{ $user->full_name }}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Contact Number</span>
                            <p class="text-xl font-bold text-gray-900 leading-tight">{{ $user->phone_number ?? 'Not Provided' }}</p>
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Account Email</span>
                            <p class="text-xl font-bold text-gray-900 leading-tight">{{ $user->user_email }}</p>
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Unique Username</span>
                            <p class="text-xl font-bold text-gray-900 leading-tight">{{ $user->username }}</p>
                        </div>
                    </div>

                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 italic border-b border-gray-100 pb-4">System Metadata</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                         <div class="p-5 bg-slate-50 rounded-2xl border border-gray-100">
                            <span class="text-gray-400 font-bold uppercase tracking-widest text-[9px] block mb-1">Registration Date</span>
                            <span class="text-gray-900 font-black text-sm tracking-tighter">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="p-5 bg-slate-50 rounded-2xl border border-gray-100">
                            <span class="text-gray-400 font-bold uppercase tracking-widest text-[9px] block mb-1">Last Update</span>
                            <span class="text-gray-900 font-black text-sm tracking-tighter">{{ $user->updated_at->format('d M Y') }}</span>
                        </div>
                        <div class="p-5 bg-slate-50 rounded-2xl border border-gray-100">
                            <span class="text-gray-400 font-bold uppercase tracking-widest text-[9px] block mb-1">User ID</span>
                            <span class="text-indigo-600 font-black text-sm tracking-tighter">#{{ str_pad($user->user_id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>

                    <!-- Actions Footer -->
                    <div class="flex justify-end items-center space-x-4 pt-8 border-t border-gray-50">
                        <a href="{{ route('admin.users.edit', $user) }}" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/30">
                            Edit User Account
                        </a>
                        <a href="{{ route('admin.users.cars', $user) }}" class="px-8 py-4 bg-slate-800 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg">
                            Manage Garage
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection