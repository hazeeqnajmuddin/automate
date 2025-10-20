@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="flex">
        
        {{-- Main content --}}
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
            <p>Total users: {{ count($users) }}</p>
        </div>
    </div>
@endsection
