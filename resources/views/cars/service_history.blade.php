@extends('layouts.app')

@section('title', 'Service History: ' . $car->brand . ' ' . $car->model)

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>Maintenance Ledger</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Service <span class="text-indigo-600">History</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium italic">Chronological record of maintenance for {{ $car->license_plate }}</p>
            </div>
            
            <div class="flex space-x-4">
                <a href="{{ route('cars.show', $car) }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Report
                </a>
                <a href="{{ route('cars.manage_services', $car) }}" class="group inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Log New Service
                </a>
            </div>
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

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
            
            <!-- Left Side: Identity Card -->
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

                        <!-- Stats Grid -->
                        <div class="mt-10 w-full grid grid-cols-2 gap-4">
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                                <p class="text-white text-xl font-black italic">{{ number_format($car->mileage) }}</p>
                                <p class="text-[8px] font-black text-gray-500 uppercase tracking-widest mt-1">KM Mileage</p>
                            </div>
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                                <p class="text-indigo-400 text-xl font-black italic">{{ $car->serviceHistories->count() }}</p>
                                <p class="text-[8px] font-black text-gray-500 uppercase tracking-widest mt-1">Total Logs</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 w-full bg-white/5 p-6 rounded-2xl border border-white/10 text-center relative z-10">
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Ownership Integrity</p>
                        <p class="text-[10px] text-indigo-200 mt-2 font-medium italic">Viewing records for owner: {{ Auth::user()->username }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Service Log List -->
            <div class="w-full lg:w-2/3 flex flex-col space-y-6">
                
                @forelse ($car->serviceHistories->sortByDesc('service_date') as $service)
                    <div class="group relative bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 transition-all duration-500 hover:shadow-indigo-500/10 hover:-translate-y-1 border-l-8 border-l-indigo-600">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <!-- Date Badge -->
                            <div class="shrink-0 flex flex-col items-center justify-center h-20 w-20 bg-slate-50 rounded-2xl border border-gray-100 group-hover:bg-indigo-50 transition-colors">
                                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($service->service_date)->format('M') }}</span>
                                <span class="text-2xl font-black text-indigo-600 italic leading-none">{{ \Carbon\Carbon::parse($service->service_date)->format('d') }}</span>
                                <span class="text-[10px] font-bold text-gray-400 mt-1">{{ \Carbon\Carbon::parse($service->service_date)->format('Y') }}</span>
                            </div>
                            
                            <div class="flex-1 text-center md:text-left">
                                <div class="flex flex-col md:flex-row md:items-center gap-2">
                                    <h4 class="text-2xl font-black text-gray-900 tracking-tight uppercase italic leading-none">{{ $service->service_type }}</h4>
                                    <span class="inline-flex items-center px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded text-[8px] font-black uppercase tracking-widest border border-indigo-100">{{ $service->service_location ?? 'Verified Center' }}</span>
                                </div>
                                <p class="text-gray-500 mt-3 text-sm font-medium leading-relaxed">
                                    {{ $service->service_description }}
                                </p>
                            </div>

                            <div class="shrink-0 flex flex-col items-center md:items-end space-y-4">
                                <div class="text-center md:text-right">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                                    <div class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-200">
                                        Completed
                                    </div>
                                </div>

                                {{-- Added Purge/Delete Button --}}
                                <form action="{{ route('cars.service.destroy', [$car, $service]) }}" method="POST" onsubmit="return confirm('ADMIN ALERT: Permanently delete this service record from the history?');">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="group flex items-center space-x-2 px-4 py-2 border-2 border-red-50 text-red-500 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Purge Record</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="bg-slate-50 p-20 rounded-[2.5rem] border border-dashed border-gray-200 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-200 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <h3 class="text-xl font-black text-gray-400 uppercase tracking-tighter italic">No Maintenance Logs</h3>
                        <p class="text-gray-400 mt-2 font-medium">You haven't recorded any service history for this vehicle yet.</p>
                        <a href="{{ route('cars.manage_services', $car) }}" class="mt-8 inline-block px-10 py-4 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-500/30">Log First Service</a>
                    </div>
                @endforelse

                <div class="pt-8 text-center">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">End of Log Entries</p>
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