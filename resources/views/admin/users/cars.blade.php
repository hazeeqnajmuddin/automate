@extends('layouts.app')

{{-- Dynamically set the title based on the user --}}
@section('title', $user->username . "'s Cars")

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2">
                {{ $user->username }}'s Cars 
            </h1>
            {{-- Maybe add a button here later for admin to add a car TO this user? Optional. --}}
        </div>

        {{-- Display messages if needed --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
         @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif


        <div class="space-y-6">
            {{-- Loop through the specific user's cars passed from the controller --}}
            @forelse ($cars as $car)
                <div class="bg-gray-200 p-6 rounded-lg shadow-md flex flex-col md:flex-row items-start md:items-center justify-between relative">
                    <div class="absolute top-2 right-2 bg-white text-gray-600 text-xs px-2 py-1 rounded-full shadow">
                        Last updated {{ $car->updated_at->diffForHumans() }}
                    </div>
                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                        <div class="w-20 h-20 bg-gray-400 rounded flex items-center justify-center">
                            {{-- Placeholder for car image --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">{{ $car->registered_year }} {{ $car->brand }} {{ $car->model }}</h2>
                            <p class="text-sm text-gray-600">Mileage: {{ number_format($car->mileage) }} KM</p>
                            <p class="text-sm text-gray-600">Car Age: {{ $car->age }} Years</p>
                            <p class="text-sm text-gray-600">Fuel Type: {{ $car->fuel_type }}</p>
                            <p class="text-sm text-gray-600">Transmission Type: {{ $car->transmission_type }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        {{-- Admin might want to edit/delete the car directly? Or just view? --}}
                        {{-- For now, just viewing. Add buttons later if needed --}}
                         <a href="{{ route('cars.edit', $car) }}" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition text-sm">
                             View/Edit Details
                         </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-8">
                    This user hasn't added any cars yet.
                </div>
            @endforelse
        </div>
        
         <div class="mt-8">
             <a href="{{ route('admin.users.show', $user) }}" class="inline-flex justify-center py-2 px-6 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                 Back to User Profile
             </a>
         </div>

    </div>
</div>
@endsection
