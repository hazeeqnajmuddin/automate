@extends('layouts.app')

@section('title', 'My Cars')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2">My Cars</h1>
            <a href="{{ route('cars.create') }}" class="bg-black text-white px-5 py-2 rounded-md hover:bg-gray-800 transition flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                <span>Add A Car</span>
            </a>
        </div>

        <!-- Success/Error Messages -->
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
            @forelse ($cars as $car)
                <div class="bg-gray-200 p-6 rounded-lg shadow-md flex flex-col md:flex-row items-start md:items-center justify-between relative">
                    <div class="absolute top-2 right-2 bg-white text-gray-600 text-xs px-2 py-1 rounded-full shadow">
                        Last updated {{ $car->updated_at->diffForHumans() }}
                    </div>
                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                        <div class="w-20 h-20 bg-gray-400 rounded flex items-center justify-center">
                            {{-- Placeholder for car image - We can add this later --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">{{ $car->registered_year }} {{ $car->brand }} {{ $car->model }}</h2>
                            <p class="text-sm text-gray-600">Mileage: {{ number_format($car->mileage) }} KM</p>
                            <p class="text-sm text-gray-600">Car Age: {{ $car->age }} Years</p>
                            <p class="text-sm text-gray-600">Fuel Type: {{ $car->fuel_type }}</p>
                            <p class="text-sm text-gray-600">Transmission Type: {{ $car->transmission_type }}</p>
                            {{-- You can add Engine Size and Last Service later when those tables are linked --}}
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('cars.edit', $car) }}" class="bg-black text-white px-5 py-2 rounded-md hover:bg-gray-800 transition">
                            Update
                        </a>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-8">
                    You haven't added any cars yet.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
