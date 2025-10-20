@extends('layouts.app')

@section('title', 'Manage System Users')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Main Title -->
        <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2 mb-8">Registered User List</h1>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif


        <div class="bg-white p-6 rounded-lg shadow-md">
            
            <!-- Users Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No.</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Username</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Role</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($users as $user)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $user->username }}</td>
                                <td class="py-3 px-4">{{ $user->user_email }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                        {{ $user->user_role === 'admin' ? 'bg-yellow-200 text-yellow-900' : 'bg-green-200 text-green-900' }}">
                                        {{ ucfirst(str_replace('_', ' ', $user->user_role)) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 flex items-center space-x-3">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 hover:text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 6.732z" /></svg>
                                    </a>
                                    <!-- Delete Button Form -->
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-500">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add User Button -->
        <div class="mt-6 flex justify-end">
            <a href="{{ route('admin.users.create') }}" class="bg-black text-white px-5 py-2 rounded-md hover:bg-gray-800 transition flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                <span>Add User</span>
            </a>
        </div>

    </div>
</div>
@endsection
