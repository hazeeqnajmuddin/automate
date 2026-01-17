@extends('layouts.app')

@section('title', 'AI Service Roadmap')

@section('content')
@php
    // Define the labels and prices for each AI target index
    // This matches the target groups we trained in Python Phase 4
    $recommendationMap = [
        ['label' => 'Engine Oil Change', 'val' => $results['scheduler'][0], 'price' => 180, 'desc' => 'Lubrication System', 'color' => 'indigo'],
        ['label' => 'Oil Filter Replacement', 'val' => $results['scheduler'][1], 'price' => 45, 'desc' => 'Filtration System', 'color' => 'indigo'],
        ['label' => 'Spark Plug Change', 'val' => $results['scheduler'][2], 'price' => 125, 'desc' => 'Ignition System', 'color' => 'indigo'],
        ['label' => 'Coolant Liquid Refill', 'val' => $results['scheduler'][3], 'price' => 85, 'desc' => 'Cooling System', 'color' => 'indigo'],
        ['label' => 'Brake Pad Replacement', 'val' => $results['wear_tear'][0], 'price' => 195, 'desc' => 'Braking System', 'color' => 'indigo'],
        ['label' => 'Tyre Replacement', 'val' => $results['wear_tear'][1], 'price' => 280, 'desc' => 'Traction & Safety', 'color' => 'indigo'],
        ['label' => 'Wheel Alignment', 'val' => $results['wear_tear'][2], 'price' => 65, 'desc' => 'Handling & Balance', 'color' => 'indigo'],
        ['label' => 'Engine Diagnostic', 'val' => $results['doctor'][0], 'price' => 150, 'desc' => 'Critical System Analysis', 'color' => 'indigo'],
        ['label' => 'Battery Replacement', 'val' => $results['doctor'][1], 'price' => 230, 'desc' => 'Electrical System', 'color' => 'indigo'],
        ['label' => 'Transmission Fluid', 'val' => $results['doctor'][2], 'price' => 210, 'desc' => 'Drivetrain Management', 'color' => 'indigo'],
    ];

    $activeRecommendations = array_filter($recommendationMap, fn($item) => $item['val'] == 1);
    $totalCost = array_sum(array_column($activeRecommendations, 'price'));
    $count = 1;
@endphp

<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600"></span>
                    <span>System Diagnostic Report</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Analysis <span class="text-indigo-600">Results</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium italic">Comprehensive maintenance roadmap generated for your {{ $car->brand }}.</p>
            </div>
            
            <a href="{{ route('ai.index') }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                New Analysis
            </a>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
            
            <div class="w-full lg:w-1/3 flex sticky top-24">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-between w-full border-4 border-indigo-500/30 group">
                    <div class="w-full flex flex-col items-center">
                        <div class="h-48 w-full rounded-3xl bg-indigo-600 flex items-center justify-center border-4 border-white shadow-2xl rotate-3 mb-8 group-hover:rotate-0 transition-transform duration-500 overflow-hidden">
                            <img src="{{ asset('storage/' . $car->car_image_path) }}" class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic text-center leading-none">
                            {{ $car->license_plate }} 
                        </h2>
                        <div class="mt-4 px-4 py-1 bg-white/10 rounded-full">
                            <span class="text-[20px] font-black text-indigo-300 uppercase tracking-widest">{{ $car->registered_year }} {{ $car->brand }} {{ $car->model }}</span>
                        </div>
                    </div>

                    <div class="mt-12 w-full space-y-4">
                        <div class="bg-white/5 p-5 rounded-2xl border border-white/10">
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-1">Current Mileage</p>
                            <p class="text-white font-black italic">{{ number_format($car->mileage) }} KM</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 flex flex-col space-y-8">
                <h3 class="text-xs font-black text-gray-900 uppercase tracking-[0.2em] mb-2 italic">Priority Service Roadmap</h3>

                @forelse($activeRecommendations as $item)
                    <div class="group relative bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 transition-all duration-500 hover:shadow-indigo-500/10 hover:-translate-y-1 border-l-8 border-l-{{ $item['color'] }}-500">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <div class="shrink-0 h-16 w-16 bg-{{ $item['color'] }}-50 text-{{ $item['color'] }}-500 rounded-2xl flex items-center justify-center font-black italic text-2xl">
                                {{ str_pad($count++, 2, '0', STR_PAD_LEFT) }}
                            </div>
                            
                            <div class="flex-1 text-center md:text-left">
                                <h4 class="text-2xl font-black text-gray-900 tracking-tight uppercase italic leading-none">{{ $item['label'] }}</h4>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-2">{{ $item['desc'] }}</p>
                            </div>

                            <div class="text-center md:text-right">
                                <p class="text-2xl font-black text-gray-900 tracking-tighter italic">RM {{ number_format($item['price'], 2) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 bg-emerald-50 rounded-[3rem] border-2 border-dashed border-emerald-200 text-center">
                        <p class="text-emerald-800 font-black italic text-xl uppercase">Vehicle Status: Optimal</p>
                        <p class="text-emerald-600 text-sm mt-2">The AI models suggest no immediate maintenance is required for your current mileage.</p>
                    </div>
                @endforelse

                @if($totalCost > 0)
                <div class="bg-slate-900 p-10 rounded-[2.5rem] border border-gray-100 mt-8 text-center md:text-left shadow-2xl">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div>
                            <h4 class="text-sm font-black text-indigo-300 uppercase tracking-widest italic">Total Estimated Maintenance</h4>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <p class="text-5xl font-black text-white tracking-tighter italic leading-none">RM {{ number_format($totalCost, 2) }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection