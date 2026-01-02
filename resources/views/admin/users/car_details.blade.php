@extends('layouts.app')

{{-- Dynamically set the title --}}
@section('title', "Inspection: " . $car->brand . " " . $car->model)

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">

        <!-- Top Header with Back Button -->
        <header class="flex justify-between items-center mb-12">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>Technical Specification Audit</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Vehicle <span class="text-indigo-600">Details</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium italic">Asset ID: #VEH-{{ str_pad($car->car_id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
            
            <a href="{{ route('admin.users.cars', $user) }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Garage
            </a>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
            
            <!-- Left Side: Vehicle & Owner Identity Card -->
            <div class="w-full lg:w-1/3 flex sticky top-24">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-between w-full border-4 border-indigo-500/30 group">
                    
                    <!-- Vehicle Icon/Visual Area - UPDATED to display image -->
                    <div class="w-full flex flex-col items-center">
                        <div class="h-48 w-full rounded-3xl bg-indigo-600 flex items-center justify-center border-4 border-white shadow-2xl rotate-3 mb-8 overflow-hidden group-hover:rotate-0 transition-transform duration-500">
                            @if($car->car_image_path)
                                <img src="{{ asset('storage/' . $car->car_image_path) }}" alt="Vehicle Image" class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            @endif
                        </div>
                        <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic text-center">{{ $car->brand }} {{ $car->model }}</h2>
                        <p class="text-indigo-400 font-bold mt-1 uppercase tracking-widest text-[10px]">{{ $car->registered_year }} Registration</p>
                    </div>

                    <!-- Owner Context -->
                    <div class="mt-12 w-full bg-white/5 p-6 rounded-3xl border border-white/10">
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-4 text-center">Verified Owner</p>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                @if ($user->profile_pic_path)
                                    <img src="{{ asset('storage/' . $user->profile_pic_path) }}" alt="Owner Profile" class="h-16 w-16 rounded-2xl object-cover border-2 border-indigo-500 shadow-lg">
                                @else
                                    <div class="h-16 w-16 rounded-2xl bg-indigo-600 flex items-center justify-center font-black text-white text-xl italic border-2 border-indigo-400">
                                        {{ substr($user->username, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-white font-black uppercase tracking-tight italic truncate">{{ $user->full_name }}</p>
                                <p class="text-indigo-300 text-[10px] font-bold uppercase tracking-widest">{{ $user->username }}</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.show', $user) }}" class="mt-4 w-full block py-2 bg-indigo-600/20 text-indigo-400 rounded-xl text-[9px] font-black uppercase tracking-widest text-center hover:bg-indigo-600 hover:text-white transition-all">View Owner Account</a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Technical Specs & Analytics -->
            <div class="w-full lg:w-2/3 flex flex-col space-y-8">
                
                <!-- 1. Technical Specification Block -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-8 italic border-b border-gray-100 pb-4">Core Specifications</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Brand</span>
                            <p class="text-lg font-bold text-gray-900">{{ $car->brand }}</p>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Plate No</span>
                            <p class="text-lg font-bold text-indigo-600 uppercase">{{ $car->license_plate }}</p>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Mileage</span>
                            <p class="text-lg font-bold text-gray-900">{{ number_format($car->mileage) }} KM</p>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Transmission</span>
                            <p class="text-lg font-bold text-gray-900">{{ $car->transmission_type }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-12">
                         <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Fuel System</span>
                            <p class="text-lg font-bold text-gray-900">{{ $car->fuel_type }}</p>
                        </div>
                         <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Engine Size</span>
                            <p class="text-lg font-bold text-gray-900">{{ $car->engineCondition->engine_size ?? 'N/A' }}L</p>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block">Age</span>
                            <p class="text-lg font-bold text-gray-900">{{ $car->age }} Yrs</p>
                        </div>
                    </div>
                </div>

                <!-- 3. Diagnostic Sensor Lights -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div>
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-1 italic">Diagnostic Sensors</h3>
                        <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest">Real-time instrument cluster telemetry</p>
                    </div>

                    <div class="flex items-center space-x-8">
                        <div class="flex flex-col items-center">
                            <div class="h-16 w-16 rounded-2xl {{ $car->battery_light_on ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }} flex items-center justify-center mb-2 shadow-sm border border-black/5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="text-[9px] font-black uppercase tracking-widest {{ $car->battery_light_on ? 'text-red-500' : 'text-green-500' }}">
                                Battery: {{ $car->battery_light_on ? 'WARNING' : 'PASS' }}
                            </span>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="h-16 w-16 rounded-2xl {{ ($car->engineCondition->engine_light ?? false) ? 'bg-orange-100 text-orange-600' : 'bg-indigo-100 text-indigo-600' }} flex items-center justify-center mb-2 shadow-sm border border-black/5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <span class="text-[9px] font-black uppercase tracking-widest {{ ($car->engineCondition->engine_light ?? false) ? 'text-orange-500' : 'text-indigo-600' }}">
                                Engine: {{ ($car->engineCondition->engine_light ?? false) ? 'CHECK' : 'SECURE' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Admin Action Footer -->
                <div class="flex justify-end items-center space-x-4 pt-8">
                    <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('ADMIN ALERT: Deleting this asset is irreversible. Proceed?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-8 py-4 border-2 border-red-100 text-red-500 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                            Purge Asset
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection