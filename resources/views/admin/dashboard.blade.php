@extends('layouts.app')

@section('title', 'Admin Control Center')

@section('content')
<div class="container mx-auto p-4 md:p-12">

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div id="success-popup" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-8 shadow-sm flex justify-between items-center" role="alert">
            <div>
                <p class="font-black uppercase tracking-widest text-xs">System Notification</p>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">✕</button>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
        
        <!-- Left Side: Admin Identity Card -->
        <div class="w-full lg:w-1/3 flex sticky top-24">
            <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center w-full border-4 border-indigo-500/30 group transition-all duration-500">
                <div class="relative">
                    <img src="{{ asset('images/logo.png') }}" alt="Automate Logo" class="w-full max-w-xs h-auto transform transition-transform group-hover:scale-105 duration-500 drop-shadow-2xl">
                    <!-- Admin Badge -->
                    <div class="absolute -top-4 -right-4 bg-indigo-600 text-white px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg border-2 border-slate-900">
                        Admin Mode
                    </div>
                </div>
                <div class="mt-12 text-center">
                    <h2 class="text-4xl font-black text-white tracking-tighter uppercase italic">Automate</h2>
                    <div class="h-1.5 w-24 bg-indigo-500 mx-auto mt-2 rounded-full"></div>
                    <p class="text-indigo-300 font-bold mt-4 uppercase tracking-widest text-xs">System Control Center</p>
                </div>
                
                <!-- Quick Stats for Admin -->
                <div class="mt-10 w-full grid grid-cols-2 gap-4">
                    <div class="bg-white/5 p-4 rounded-2xl text-center border border-white/10">
                        <p class="text-indigo-400 text-2xl font-black">{{ count($users) }}</p>
                        <p class="text-[8px] font-black text-white uppercase tracking-tighter">Total Users</p>
                    </div>
                    <div class="bg-white/5 p-4 rounded-2xl text-center border border-white/10">
                        <p class="text-green-400 text-2xl font-black">{{ $users->where('user_role', 'admin')->count() }}</p>
                        <p class="text-[8px] font-black text-white uppercase tracking-tighter">Admins</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Management Sections -->
        <div class="w-full lg:w-2/3 flex flex-col">
            <header class="mb-12">
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-ping"></span>
                    <span>System Online</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Control <span class="text-indigo-600">Dashboard</span>
                </h1>
                <p class="text-xl text-gray-500 mt-4 font-medium">Overview of the Automate platform. Manage users, monitor activity, and oversee system health.</p>
            </header>

            <!-- Action Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                
                <!-- Manage Users Card -->
                <a href="{{ route('admin.users.index') }}" class="group bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2 transition-all duration-300 border-b-8 border-b-indigo-500">
                    <div class="flex items-center space-x-6">
                        <div class="p-5 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-2xl text-gray-900 tracking-tight uppercase italic">User Management</h4>
                            <p class="text-gray-500 mt-1 font-medium">Verify, edit, or remove users.</p>
                        </div>
                    </div>
                </a>

                <!-- Add User Card -->
                <a href="{{ route('admin.users.create') }}" class="group bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-green-500/10 hover:-translate-y-2 transition-all duration-300 border-b-8 border-b-green-500">
                    <div class="flex items-center space-x-6">
                        <div class="p-5 bg-green-50 text-green-600 rounded-2xl group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-2xl text-gray-900 tracking-tight uppercase italic">Create Admin</h4>
                            <p class="text-gray-500 mt-1 font-medium">Provision new staff accounts.</p>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Recent Activity / Info Box -->
            <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter italic">System Summary</h3>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Snapshot</span>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-white rounded-2xl shadow-sm">
                        <span class="text-gray-600 font-bold uppercase tracking-widest text-xs">Platform Role</span>
                        <span class="px-4 py-1 bg-yellow-100 text-yellow-800 rounded-full font-black text-[10px] uppercase tracking-widest border border-yellow-200">System Admin</span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-white rounded-2xl shadow-sm">
                        <span class="text-gray-600 font-bold uppercase tracking-widest text-xs">Total Database Records</span>
                        <span class="text-indigo-600 font-black text-sm">{{ count($users) }} Entries</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple script to auto-hide success popups if present
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
@endsection