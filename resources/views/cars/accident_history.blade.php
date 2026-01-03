@extends('layouts.app')

@section('title', 'Accident History: ' . $car->brand . ' ' . $car->model)

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-red-50 text-red-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-red-600 animate-pulse"></span>
                    <span>Incident Archive</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Accident <span class="text-red-600">History</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium italic">Damage and repair log for {{ $car->license_plate }}</p>
            </div>
            
            <div class="flex space-x-4">
                <a href="{{ route('cars.show', $car) }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Report
                </a>
                {{-- Placeholder for logging new incidents --}}
                <a href="{{ route('cars.manage_accidents', $car) }}" class="group inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Report Incident
                </a>
            </div>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
            
            <!-- Left Side: Identity Card -->
            <div class="w-full lg:w-1/3 flex sticky top-24">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-between w-full border-4 border-red-500/30 group overflow-hidden relative">
                    
                    <div class="absolute -right-10 -top-10 h-40 w-40 bg-red-500/10 rounded-full blur-3xl transition-transform duration-700"></div>

                    <div class="relative z-10 w-full flex flex-col items-center text-center">
                        <div class="h-48 w-full rounded-3xl bg-red-600 flex items-center justify-center border-4 border-white shadow-2xl mb-8 overflow-hidden transition-transform duration-500 group-hover:rotate-0 rotate-3">
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
                            <span class="text-[9px] font-black text-red-300 uppercase tracking-widest">{{ $car->license_plate }}</span>
                        </div>

                        <!-- Stats Grid -->
                        <div class="mt-10 w-full grid grid-cols-2 gap-4">
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/10 text-center">
                                <p class="text-white text-xl font-black italic">{{ $car->accidentHistories->count() }}</p>
                                <p class="text-[8px] font-black text-gray-500 uppercase tracking-widest mt-1">Incident Count</p>
                            </div>
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/10 text-center">
                                <p class="text-red-400 text-xl font-black italic">Active</p>
                                <p class="text-[8px] font-black text-gray-500 uppercase tracking-widest mt-1">Audit Status</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 w-full bg-white/5 p-6 rounded-2xl border border-white/10 text-center relative z-10">
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Asset Integrity</p>
                        <p class="text-[10px] text-red-200 mt-2 font-medium italic">Transparency in accident reporting improves vehicle resale valuation.</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Accident List -->
            <div class="w-full lg:w-2/3 flex flex-col space-y-6">
                
                @forelse ($car->accidentHistories->sortByDesc('AnD_date') as $accident)
                    <div class="group relative bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 transition-all duration-500 hover:shadow-red-500/10 hover:-translate-y-1 border-l-8 border-l-red-600">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <!-- Date Badge -->
                            <div class="shrink-0 flex flex-col items-center justify-center h-20 w-20 bg-slate-50 rounded-2xl border border-gray-100 group-hover:bg-red-50 transition-colors">
                                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($accident->AnD_date)->format('M') }}</span>
                                <span class="text-2xl font-black text-red-600 italic leading-none">{{ \Carbon\Carbon::parse($accident->AnD_date)->format('d') }}</span>
                                <span class="text-[10px] font-bold text-gray-400 mt-1">{{ \Carbon\Carbon::parse($accident->AnD_date)->format('Y') }}</span>
                            </div>
                            
                            <div class="flex-1 text-center md:text-left">
                                <div class="flex flex-col md:flex-row md:items-center gap-2">
                                    <h4 class="text-2xl font-black text-gray-900 tracking-tight uppercase italic leading-none">{{ $accident->AnD_type }}</h4>
                                    <span class="inline-flex items-center px-2 py-0.5 bg-red-50 text-red-600 rounded text-[8px] font-black uppercase tracking-widest border border-red-100">{{ $accident->AnD_location ?? 'Recorded Location' }}</span>
                                </div>
                                <p class="text-gray-500 mt-3 text-sm font-medium leading-relaxed">
                                    {{ $accident->AnD_description }}
                                </p>
                            </div>

                            <div class="shrink-0">
                                <form action="{{ route('cars.accident.destroy', [$car, $accident]) }}" method="POST" onsubmit="return confirm('WARNING: This will permanently purge this record from the ledger. Proceed?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="group flex items-center space-x-2 px-5 py-2 border-2 border-red-50 text-red-500 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    <span>Delete Record</span>
                                </button>
                            </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="bg-slate-50 p-20 rounded-[2.5rem] border border-dashed border-gray-200 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-200 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                        <h3 class="text-xl font-black text-gray-400 uppercase tracking-tighter italic">No Incidents Found</h3>
                        <p class="text-gray-400 mt-2 font-medium">This vehicle has a clean record with no reported accidents or damages.</p>
                    </div>
                @endforelse

                <div class="pt-8 text-center">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">End of Archive</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection