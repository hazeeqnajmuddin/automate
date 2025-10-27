@extends('layouts.app')

@section('title', 'Service Recommendations')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto">
        
        {{-- Display Car Name (Passed from controller) --}}
        {{-- Example: <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2 mb-8">{{ $car->registered_year }} {{ $car->brand }} {{ $car->model }}</h1> --}}
        <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2 mb-8">2017 Perodua Myvi SE</h1> 

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Car Image Placeholder --}}
            <div class="flex flex-col items-center md:items-start">
                <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
            </div>

            {{-- Recommendations List --}}
            <div class="md:col-span-2">
                <div class="space-y-4">
                    {{-- Table Header --}}
                    <div class="grid grid-cols-5 gap-4 font-semibold border-b pb-2">
                        <div class="col-span-3">Recommend Service</div>
                        <div class="text-right">Service Cost</div>
                        <div class="text-right">Importance</div>
                    </div>

                    {{-- Loop through recommendations (passed from controller) --}}
                    {{-- Example: --}}
                    {{-- @forelse ($recommendations as $rec) --}}
                    {{-- <div class="grid grid-cols-5 gap-4 items-center"> --}}
                    {{--     <div class="col-span-3">{{ $loop->iteration }}. {{ $rec->recommended_service }}</div> --}}
                    {{--     <div class="text-right">RM {{ number_format($rec->cost_estimation, 2) }}</div> --}}
                    {{--     <div class="text-right">{{ $rec->importance_score }}%</div> --}}
                    {{-- </div> --}}
                    {{-- @empty --}}
                    {{--     <p class="text-gray-500">No recommendations available at this time.</p> --}}
                    {{-- @endforelse --}}

                    {{-- Placeholder Data --}}
                    <div class="grid grid-cols-5 gap-4 items-center">
                        <div class="col-span-3">1. Engine Diagnostic</div>
                        <div class="text-right">RM 250.00</div>
                        <div class="text-right">76%</div>
                    </div>
                    <div class="grid grid-cols-5 gap-4 items-center">
                        <div class="col-span-3">2. Break Pad Replacement</div>
                        <div class="text-right">RM 178.00</div>
                        <div class="text-right">71%</div>
                    </div>
                    <div class="grid grid-cols-5 gap-4 items-center">
                        <div class="col-span-3">3. Coolant Liquid Refill</div>
                        <div class="text-right">RM 110.00</div>
                        <div class="text-right">28%</div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Back Button --}}
         <div class="mt-8 text-center">
             <a href="{{ route('ai.index') }}" class="inline-flex justify-center py-2 px-6 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                 Back to Recommender
             </a>
         </div>

    </div>
</div>
@endsection
