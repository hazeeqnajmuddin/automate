@extends('layouts.app')

@section('title', 'Manage System Users')

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="flex-1">
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600"></span>
                    <span>Database Management</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Registered <span class="text-indigo-600">User List</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium">Oversee all accounts registered within the Automate platform.</p>
            </div>
            
            <a href="{{ route('admin.users.create') }}" class="group inline-flex items-center px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-500/30 hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transform group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                Add New User
            </a>
        </header>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div id="status-popup" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-6 rounded-2xl mb-8 shadow-sm flex justify-between items-center" role="alert">
                <div>
                    <p class="font-black uppercase tracking-widest text-xs">Action Successful</p>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold hover:scale-110 transition-transform">✕</button>
            </div>
        @endif
        
        @if (session('error'))
            <div id="status-popup" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-6 rounded-2xl mb-8 shadow-sm flex justify-between items-center" role="alert">
                <div>
                    <p class="font-black uppercase tracking-widest text-xs">System Alert</p>
                    <p class="font-bold">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-700 font-bold hover:scale-110 transition-transform">✕</button>
            </div>
        @endif

        <!-- Users Table Card -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-slate-900">
                        <tr>
                            <th class="px-8 py-6 text-left text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em]">ID</th>
                            <th class="px-8 py-6 text-left text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em]">Account Info</th>
                            <th class="px-8 py-6 text-left text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em]">Role Status</th>
                            <th class="px-8 py-6 text-right text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em]">Command</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse ($users as $user)
                            <tr class="hover:bg-indigo-50/30 cursor-pointer transition-colors group" data-href="{{ route('admin.users.show', $user) }}">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <span class="text-sm font-black text-gray-400">#{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center font-black text-indigo-600 text-xs italic border-2 border-white shadow-sm">
                                            {{ substr($user->username, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-black text-gray-900 uppercase tracking-tight italic">{{ $user->username }}</div>
                                            <div class="text-xs font-medium text-gray-400">{{ $user->user_email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    @if($user->user_role === 'admin')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-amber-100 text-amber-700 border border-amber-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 mr-2"></span>
                                            System Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                            Car Owner
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end items-center space-x-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="action-button p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit User">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="action-button inline-block" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete User">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">No users found in database</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer / Legend -->
        <div class="mt-8 flex justify-between items-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">
            <p>Total Registered Accounts: {{ count($users) }}</p>
            <p>Click a row to view full profile details</p>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle row clicks
        const rows = document.querySelectorAll('tr[data-href]');
        rows.forEach(row => {
            row.addEventListener('click', function () {
                window.location.href = this.dataset.href;
            });
        });

        // Stop propagation for action buttons
        const actionButtons = document.querySelectorAll('.action-button');
        actionButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });

        // Auto-hide popup
        const popup = document.getElementById('status-popup');
        if (popup) {
            setTimeout(() => {
                popup.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                popup.style.opacity = '0';
                popup.style.transform = 'translateY(-10px)';
                setTimeout(() => popup.remove(), 500);
            }, 5000);
        }
    });
</script>
@endsection