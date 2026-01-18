@extends('layouts.app')

@section('title', 'AI Service Recommender')

@section('content')
@if ($errors->any())
    <div class="max-w-7xl mx-auto mb-6">
        <div class="bg-red-50 border-l-4 border-red-500 p-4">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-red-700 font-black uppercase italic">
                        Validation Error Detected:
                    </p>
                    <ul class="mt-1 list-disc list-inside text-xs text-red-600 font-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>Intelligent Diagnostic Engine</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Service <span class="text-indigo-600">Recommender</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium italic">Describe your car's symptoms and let AutoMate's AI do the rest.</p>
            </div>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[60vh]">
            
            <div class="w-full lg:w-1/3 flex sticky top-24">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center w-full border-4 border-indigo-500/30 group overflow-hidden relative">
                    <div class="absolute -right-10 -top-10 h-40 w-40 bg-indigo-500/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                    
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="h-40 w-40 rounded-3xl bg-indigo-600 flex items-center justify-center border-4 border-white shadow-2xl rotate-3 mb-8 group-hover:rotate-0 transition-all duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic leading-none">AI Assistant</h2>
                        <p class="text-indigo-400 font-bold mt-2 uppercase tracking-widest text-[10px]">Natural Language Processor v1.0</p>
                    </div>

                    <div class="mt-12 w-full bg-white/5 p-6 rounded-2xl border border-white/10 text-center relative z-10">
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2">Diagnostic Status</p>
                        <div class="flex items-center justify-center space-x-2 text-emerald-400 font-black italic">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            <span class="text-sm tracking-tighter">WAITING FOR INPUT</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 flex flex-col">
                <div class="bg-white p-10 md:p-12 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 flex-grow flex flex-col">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 italic border-b border-gray-100 pb-4">Describe the Problem</h3>
                    
                    <form action="{{ route('ai.recommend') }}" method="POST" class="flex flex-col flex-grow">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="car_id" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">1. Select Target Vehicle</label>
                            <select id="car_id" name="car_id" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 font-bold text-sm uppercase" required>
                                <option value="" disabled selected>— Choose A Vehicle —</option>
                                @foreach($userCars as $car)
                                    <option value="{{ $car->car_id }}">{{ $car->license_plate }} ({{ $car->brand }} {{ $car->model }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="relative flex-grow flex flex-col mb-6">
                            <label for="problem_description" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">2. What is happening with your car?</label>
                            <textarea 
                                id="problem_description" 
                                name="problem_description" 
                                rows="6"
                                class="w-full flex-grow border-2 border-indigo-50 focus:border-indigo-500 focus:ring-0 rounded-[2rem] p-8 text-xl font-medium placeholder-gray-300 transition-all resize-none shadow-inner bg-gray-50/50"
                                placeholder="Example: My car makes a clicking sound when I turn the steering wheel..."
                                required
                            ></textarea>
                        </div>

                        <div class="mb-8">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Common Symptoms</p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" onclick="fillPrompt('Knocking sound when going over bumps')" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-full text-[11px] font-bold text-slate-600 hover:bg-indigo-600 hover:text-white transition-all">Suspension Knock</button>
                                
                                <button type="button" onclick="fillPrompt('Aircond is blowing hot air')" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-full text-[11px] font-bold text-slate-600 hover:bg-indigo-600 hover:text-white transition-all">A/C Hot Air</button>
                                
                                <button type="button" onclick="fillPrompt('Brakes screeching and hard to stop')" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-full text-[11px] font-bold text-slate-600 hover:bg-indigo-600 hover:text-white transition-all">Brake Squeak</button>
                                
                                <button type="button" onclick="fillPrompt('Car is shaking and vibrating at high speed')" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-full text-[11px] font-bold text-slate-600 hover:bg-indigo-600 hover:text-white transition-all">Unstable Steering</button>
                                
                                <button type="button" onclick="fillPrompt('I see an oil leak near the engine cap')" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-full text-[11px] font-bold text-slate-600 hover:bg-indigo-600 hover:text-white transition-all">Oil Leakage</button>
                                
                                <button type="button" onclick="fillPrompt('Windshield washer spray is not working')" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-full text-[11px] font-bold text-slate-600 hover:bg-indigo-600 hover:text-white transition-all">Washer Motor</button>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white py-6 rounded-2xl font-black text-sm uppercase tracking-[0.3em] hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-500/30 flex items-center justify-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span>Analyze Symptoms</span>
                        </button>
                    </form>
                </div>

                <p class="text-center mt-8 text-[9px] font-black text-gray-400 uppercase tracking-[0.5em]">Automate Intelligence Framework v1.0</p>
            </div>
        </div>
    </div>
</div>

<script>
    function fillPrompt(text) {
        document.getElementById('problem_description').value = text;
    }
</script>
@endsection