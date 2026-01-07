@extends('layouts.app')

@section('title', 'Vehicle Details: ' . $car->brand . ' ' . $car->model)

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">

        <!-- Top Header with Navigation -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>Diagnostic Overview</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Vehicle <span class="text-indigo-600">Report</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium italic">Comprehensive technical profile for Asset #{{ str_pad($car->car_id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
            
            <a href="{{ route('cars.index') }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Garage
            </a>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
            
            <!-- Left Side: Visual Identity Card -->
            <div class="w-full lg:w-1/3 flex sticky top-24">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-between w-full border-4 border-indigo-500/30 group overflow-hidden relative">
                    
                    <div class="absolute -right-10 -top-10 h-40 w-40 bg-indigo-500/10 rounded-full blur-3xl transition-transform duration-700"></div>

                    <div class="relative z-10 w-full flex flex-col items-center text-center">
                        <div class="h-48 w-full rounded-3xl bg-indigo-600 flex items-center justify-center border-4 border-white shadow-2xl mb-8 overflow-hidden transition-transform duration-500 group-hover:rotate-0 rotate-3">
                            @if($car->car_image_path)
                                <img src="{{ asset('storage/' . $car->car_image_path) }}" alt="Car Image" class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            @endif
                        </div>
                        <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic leading-none">{{ $car->brand }} {{ $car->model }}</h2>
                        <div class="mt-4 px-4 py-1 bg-white/10 rounded-full">
                            <span class="text-[9px] font-black text-indigo-300 uppercase tracking-widest">{{ $car->license_plate }}</span>
                        </div>
                    </div>

                    <!-- Sidebar Navigation Actions -->
                    <div class="mt-12 w-full space-y-4 relative z-10">
                        <a href="{{ route('cars.edit', $car) }}" class="flex items-center justify-center space-x-3 py-4 bg-white/5 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-600 transition-all border border-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            <span>Update Car</span>
                        </a>
                        <a href="{{ route('cars.service_history', $car) }}" class="flex items-center justify-center space-x-3 py-4 bg-indigo-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                            <span>View Service History</span>
                        </a>
                        <a href="{{ route('cars.accident_history', $car) }}" class="flex items-center justify-center space-x-3 py-4 bg-indigo-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            <span>View Accident History</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Detailed Tech Specs -->
            <div class="w-full lg:w-2/3 flex flex-col space-y-8">
                
                <!-- Core Specifications Grid -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-8 italic border-b border-gray-100 pb-4">Core Specifications</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Manufacturer</p>
                            <p class="text-lg font-bold text-gray-900">{{ $car->brand }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Model variant</p>
                            <p class="text-lg font-bold text-gray-900">{{ $car->model }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Reg Year</p>
                            <p class="text-lg font-bold text-gray-900">{{ $car->registered_year }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Calculated Age</p>
                            <p class="text-lg font-bold text-indigo-600">{{ $car->age }} Years</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-12">
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Current Odometer</p>
                            <p class="text-lg font-bold text-gray-900">{{ number_format($car->mileage) }} KM</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Transmission</p>
                            <p class="text-lg font-bold text-gray-900">{{ $car->transmission_type }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Fuel system</p>
                            <p class="text-lg font-bold text-gray-900">{{ $car->fuel_type }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Engine Displacement</p>
                            <p class="text-lg font-bold text-gray-900">{{ $car->engineCondition->engine_size ?? 'N/A' }}L</p>
                        </div>
                    </div>
                </div>

                <!-- Diagnostic Health Blocks -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Engine Condition -->
                    <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-gray-100">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="p-3 bg-white rounded-2xl shadow-sm text-indigo-600 border border-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <h4 class="text-xs font-black uppercase tracking-widest text-gray-900 italic">Engine Diagnostics</h4>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Noise Status</span>
                                <span class="text-sm font-black text-gray-800 uppercase italic">{{ $car->engineCondition->engine_noise ?? 'Unknown' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Check Engine Lamp</span>
                                <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest {{ ($car->engineCondition->engine_light ?? false) ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                    {{ ($car->engineCondition->engine_light ?? false) ? 'Active Alert' : 'Normal' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Brakes & Tyres -->
                    <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-gray-100">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="p-3 bg-white rounded-2xl shadow-sm text-indigo-600 border border-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <h4 class="text-xs font-black uppercase tracking-widest text-gray-900 italic">Safety Systems</h4>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Brake Response</span>
                                <span class="text-sm font-black text-gray-800 uppercase italic">{{ $car->brakeCondition->brake_effectiveness ?? 'Unknown' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tyre Tread Level</span>
                                <span class="text-sm font-black text-gray-800 uppercase italic">{{ $car->tyreCondition->tyre_tread ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Critical Alerts Panel -->
                <div class="bg-indigo-900 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-20 -bottom-20 h-64 w-64 bg-indigo-500/20 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                        <div>
                            <h4 class="text-indigo-300 font-black uppercase tracking-widest text-[10px] mb-1 italic">Dashboard Instrument Cluster</h4>
                            <h2 class="text-white text-3xl font-black tracking-tighter uppercase leading-none italic">Health Status</h2>
                        </div>
                        
                        <div class="flex items-center space-x-8">
                            <div class="flex flex-col items-center">
                                <div class="h-16 w-16 rounded-2xl flex items-center justify-center mb-2 border-2 {{ $car->battery_light_on ? 'bg-red-500/10 border-red-500 text-red-500 shadow-[0_0_15px_rgba(239,68,68,0.3)]' : 'bg-emerald-500/10 border-emerald-500 text-emerald-500' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                </div>
                                <span class="text-[8px] font-black uppercase tracking-widest {{ $car->battery_light_on ? 'text-red-400' : 'text-emerald-400' }}">
                                    Battery: {{ $car->battery_light_on ? 'WARNING' : 'PASS' }}
                                </span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="h-16 w-16 rounded-2xl flex items-center justify-center mb-2 border-2 {{ ($car->engineCondition->engine_light ?? false) ? 'bg-orange-500/10 border-orange-500 text-orange-500 shadow-[0_0_15px_rgba(249,115,22,0.3)]' : 'bg-indigo-400/10 border-indigo-400 text-indigo-400' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                </div>
                                <span class="text-[8px] font-black uppercase tracking-widest {{ ($car->engineCondition->engine_light ?? false) ? 'text-orange-400' : 'text-indigo-400' }}">
                                    Engine: {{ ($car->engineCondition->engine_light ?? false) ? 'CHECK' : 'SECURE' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection