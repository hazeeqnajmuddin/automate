@extends('layouts.app')

@section('title', 'Manage Maintenance: ' . $car->brand)

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>Maintenance Portfolio</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Log <span class="text-indigo-600">Service</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium italic">Update your vehicle's maintenance logs for AI predictive care.</p>
            </div>
            
            <a href="{{ route('cars.service_history', $car) }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Service History
            </a>
        </header>

        {{-- Session Notifications --}}
        @if (session('success'))
            <div id="status-popup" class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-6 rounded-2xl mb-8 shadow-sm flex justify-between items-center transition-all duration-500" role="alert">
                <div>
                    <p class="font-black uppercase tracking-widest text-[10px] text-emerald-600 mb-1">Success</p>
                    <p class="font-bold tracking-tight">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-12 items-stretch">
            
            <!-- Left Side: Identity Card -->
            <div class="w-full lg:w-1/3 flex sticky top-24 self-start">
                <div class="bg-slate-900 p-10 rounded-[3rem] shadow-2xl flex flex-col items-center w-full border-4 border-indigo-500/30">
                    <div class="h-40 w-40 rounded-3xl bg-indigo-600 flex items-center justify-center border-4 border-white shadow-2xl rotate-3 mb-8 overflow-hidden">
                        @if($car->car_image_path)
                            <img src="{{ asset('storage/' . $car->car_image_path) }}" alt="Car" class="w-full h-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        @endif
                    </div>
                    <h2 class="text-2xl font-black text-white tracking-tighter uppercase italic text-center leading-tight">{{ $car->brand }} {{ $car->model }}</h2>
                    <p class="text-indigo-400 font-bold mt-1 uppercase tracking-widest text-[10px]">{{ $car->license_plate }}</p>

                    <!-- Navigation Sidebar Buttons -->

                    <div class="mt-8 w-full bg-white/5 p-6 rounded-2xl border border-white/10 text-center">
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2">Predictive Maintenance</p>
                        <p class="text-[10px] text-indigo-200 font-medium leading-relaxed italic">Updating your service history helps the AI more accurately predict your next maintenance window.</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form & List -->
            <div class="w-full lg:w-2/3 space-y-12">
                
                <!-- Reporting Form -->
                <div class="bg-white p-10 md:p-12 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-10 italic border-b border-gray-100 pb-4">Log New Service</h3>
                    
                    <form action="{{ route('cars.service.store', $car) }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label for="service_date" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Date of Service</label>
                                <input type="date" id="service_date" name="service_date" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold" required>
                            </div>
                            <div class="space-y-2">
                                <label for="service_type" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Service Type</label>
                                <select id="service_type" name="service_type" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase cursor-pointer" required>
                                    <option value="Oil Change">Oil Change</option>
                                    <option value="Major Service">Major Service</option>
                                    <option value="Tire Rotation">Tire Rotation</option>
                                    <option value="Brake Service">Brake Service</option>
                                    <option value="Battery Replacement">Battery Replacement</option>
                                    <option value="Other">Other Maintenance</option>
                                </select>
                            </div>
                            <div class="md:col-span-2 space-y-2">
                                <label for="service_location" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Service Center Location</label>
                                <input type="text" id="service_location" name="service_location" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase" placeholder="e.g. Toyota Service Center, Section 13" required>
                            </div>
                            <div class="md:col-span-2 space-y-2">
                                <label for="service_description" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Notes & Components Replaced</label>
                                <textarea id="service_description" name="service_description" rows="3" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-medium" placeholder="Briefly list items replaced (e.g. Oil filter, air filter, spark plugs)..." required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/30 active:scale-95">
                            Commit Service to Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-hide popup after 5 seconds
    const popup = document.getElementById('status-popup');
    if (popup) {
        setTimeout(() => {
            popup.style.opacity = '0';
            popup.style.transform = 'translateY(-10px)';
            setTimeout(() => popup.remove(), 500);
        }, 5000);
    }
</script>
@endsection