@extends('layouts.app')

@section('title', 'My Garage')

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">

        <!-- Top Header with Action -->
        <header class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="flex-1">
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600"></span>
                    <span>Fleet Management</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    My <span class="text-indigo-600">Garage</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium">Monitor your vehicle health and manage your digital car keys.</p>
            </div>
            
            <a href="{{ route('cars.create') }}" class="group inline-flex items-center px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-500/30 hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transform group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                Add Vehicle
            </a>
        </header>

        {{-- Session Notifications --}}
        @if (session('success'))
            <div id="status-popup" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-6 rounded-2xl mb-8 shadow-sm flex justify-between items-center" role="alert">
                <div>
                    <p class="font-black uppercase tracking-widest text-xs">Action Successful</p>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold hover:scale-110 transition-transform">✕</button>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[60vh]">
            
            <!-- Left Side: Profile Summary Card -->
            <div class="w-full lg:w-1/3 flex sticky top-24">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center w-full border-4 border-indigo-500/30">
                    <div class="relative mb-8">
                        @if (Auth::user()->profile_pic_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_pic_path) }}" alt="Profile" class="h-32 w-32 rounded-3xl object-cover border-4 border-white shadow-2xl rotate-3">
                        @else
                            <div class="h-32 w-32 rounded-3xl bg-indigo-600 flex items-center justify-center font-black text-white text-4xl italic border-4 border-white shadow-2xl rotate-3">
                                {{ substr(Auth::user()->username, 0, 1) }}
                            </div>
                        @endif
                        <div class="absolute -bottom-2 -right-2 bg-indigo-500 p-2 rounded-xl shadow-lg border-4 border-slate-900 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>

                    <div class="text-center mb-10">
                        <h2 class="text-2xl font-black text-white tracking-tighter uppercase italic">{{ Auth::user()->full_name }}</h2>
                        <p class="text-indigo-400 font-bold mt-1 uppercase tracking-widest text-[10px]">Verified Car Owner</p>
                    </div>

                    <div class="w-full space-y-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/10 flex justify-between items-center">
                            <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Total Fleet</span>
                            <span class="text-white font-black italic">{{ $cars->count() }} Units</span>
                        </div>
                        <a href="{{ route('ai.index') }}" class="w-full flex items-center justify-center space-x-3 py-4 bg-indigo-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span>Run AI Health Check</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Car Inventory -->
            <div class="w-full lg:w-2/3 flex flex-col space-y-8">
                @forelse ($cars as $car)
                    <div class="group relative bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 transition-all duration-500 hover:shadow-indigo-500/10 hover:-translate-y-2 border-l-8 border-l-indigo-600 overflow-hidden">
                        
                        <!-- Floating Timestamp -->
                        <div class="absolute top-6 right-8 text-[9px] font-black uppercase tracking-widest text-gray-300">
                            Synced {{ $car->updated_at->diffForHumans() }}
                        </div>

                        <div class="flex flex-col md:flex-row items-center gap-10">
                            {{-- Visual Image / Icon --}}
                            <div class="shrink-0 w-32 h-32 md:w-40 md:h-40 bg-slate-50 rounded-3xl border border-gray-100 group-hover:bg-indigo-50 transition-colors overflow-hidden flex items-center justify-center">
                                @if($car->car_image_path)
                                    <img src="{{ asset('storage/' . $car->car_image_path) }}" alt="{{ $car->brand }} image" class="w-full h-full object-cover">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                @endif
                            </div>

                            <div class="flex-1 text-center md:text-left">
                                <h2 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic leading-none">
                                    {{ $car->registered_year }} {{ $car->brand }}
                                </h2>
                                <p class="text-xl font-bold text-indigo-600 uppercase tracking-widest mt-1">{{ $car->model }}</p>
                                
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Mileage</p>
                                        <p class="text-sm font-black text-gray-800">{{ number_format($car->mileage) }} KM</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Fuel</p>
                                        <p class="text-sm font-black text-gray-800">{{ $car->fuel_type }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Transmission</p>
                                        <p class="text-sm font-black text-gray-800">{{ $car->transmission_type }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Vehicle Age</p>
                                        <p class="text-sm font-black text-gray-800">{{ $car->age }} Yrs</p>
                                    </div>
                                </div>
                            </div>

                            <div class="shrink-0 flex flex-col space-y-3 pt-6 md:pt-0">
                                <a href="{{ route('cars.edit', $car) }}" class="inline-flex items-center justify-center px-8 py-3 bg-slate-900 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg active:scale-95">
                                    Update
                                </a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this vehicle from your garage?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-3 border-2 border-red-50 text-red-500 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all active:scale-95">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-slate-50 p-20 rounded-[2.5rem] border border-dashed border-gray-200 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-200 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <h3 class="text-xl font-black text-gray-400 uppercase tracking-tighter italic">Your Garage Is Empty</h3>
                        <p class="text-gray-400 mt-2 font-medium">You haven't added any vehicles yet. Start by registering your first car.</p>
                        <a href="{{ route('cars.create') }}" class="mt-8 inline-block px-10 py-4 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-500/30">Register Vehicle</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
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
</script>
@endsection