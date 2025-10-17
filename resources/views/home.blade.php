@extends('layouts.app') {{-- This page uses your main app layout --}}

@section('title', 'Dashboard') {{-- Sets the title for this page --}}

@section('content') {{-- This section's content gets injected into the layout --}}
    <div class="dashboard-welcome">
        <div class="main-logo">LOGO</div>
        <h1>Welcome Back!</h1>
        <p>This is your main dashboard. Select an option from the navigation above to get started.</p>
    </div>
@endsection