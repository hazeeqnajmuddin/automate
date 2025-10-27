@extends('layouts.app')

@section('title', 'AI Service Recommender')

@section('content')
<div class="container mx-auto p-4 md:p-8 flex flex-col items-center justify-center min-h-[70vh]">
    <div class="max-w-md w-full text-center">
        
        <h1 class="text-4xl font-bold mb-8">Service Recommender</h1>

        {{-- Form to select car and trigger recommendation --}}
        {{-- We'll need a route like 'ai.recommend' to handle this later --}}
            @csrf

            <div>
                <label for="car_id" class="sr-only">Choose A Car</label>
                <select id="car_id" name="car_id" class="mt-1 block w-full px-3 py-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-lg" required>
                    <option value="" disabled selected>Choose A Car</option>
                    {{-- Loop through the user's cars (passed from controller later) --}}
                    {{-- Example: --}}
                    {{-- @foreach($userCars as $car) --}}
                    {{--     <option value="{{ $car->car_id }}">{{ $car->registered_year }} {{ $car->brand }} {{ $car->model }}</option> --}}
                    {{-- @endforeach --}}
                    <option value="1">2017 Perodua Myvi SE</option> 
                    <option value="2">2020 Mitsubishi Xpander</option> 
                </select>
                @error('car_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <p class="text-sm text-gray-600">
                Have you updated your car info? 
                {{-- Link to the My Cars page --}}
                <a href="{{ route('cars.index') }}" class="font-semibold underline hover:text-gray-800">Update My Car!</a>
            </p>
<br>
            <a href="{{ route('ai.recommend') }}"class="w-full bg-black text-white px-6 py-3 rounded-md font-medium text-lg hover:bg-gray-800 transition">
                Recommend Service Now
            </a>

    </div>
</div>
@endsection
