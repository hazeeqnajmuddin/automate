@extends('layouts.app')

@section('title', 'Edit Car Details')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto">
        
        <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2 mb-8">
            {{ $car->registered_year }} {{ $car->brand }} {{ $car->model }}
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            {{-- Need enctype if you add car image uploads later --}}
            <form action="{{ route('cars.update', $car) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') {{-- Or PATCH --}}

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Column 1: Image, Accident, Service --}}
                    <div class="flex flex-col items-center space-y-4">
                         <div class="w-full h-40 bg-gray-200 rounded flex items-center justify-center">
                            {{-- Placeholder for car image - Future feature --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div class="flex space-x-4">
                            {{-- Links to future Accident/Service history pages --}}
                            <a href="#" class="text-center p-2 rounded hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-1 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                <span class="text-xs">Accident and Damage History</span>
                            </a>
                             <a href="#" class="text-center p-2 rounded hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-1 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                <span class="text-xs">Service History</span>
                            </a>
                        </div>
                    </div>

                    {{-- Column 2 & 3: Car Details --}}
                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-700">Brand:</label>
                            <input type="text" id="brand" name="brand" value="{{ old('brand', $car->brand) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            @error('brand') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                         <div>
                            <label for="model" class="block text-sm font-medium text-gray-700">Model:</label>
                            <input type="text" id="model" name="model" value="{{ old('model', $car->model) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            @error('model') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="registered_year" class="block text-sm font-medium text-gray-700">Registered Year:</label>
                            <input type="number" id="registered_year" name="registered_year" value="{{ old('registered_year', $car->registered_year) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required min="1900" max="{{ date('Y') }}">
                            @error('registered_year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                         <div>
        <label for="age" class="block text-lg font-medium text-gray-700">Age (Years):</label>
        {{-- MODIFIED: Added readonly and a placeholder/default value --}}
        <input type="number" id="age" name="age" value="{{ old('age', $car->age ?? 0) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly min="0">
        {{-- We remove the error block for 'age' since it's auto-calculated --}}
    </div>

                         <div>
                            <label for="license_plate" class="block text-sm font-medium text-gray-700">License Plate:</label>
                            <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            @error('license_plate') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="mileage" class="block text-sm font-medium text-gray-700">Mileage (KM):</label>
                            <input type="number" id="mileage" name="mileage" value="{{ old('mileage', $car->mileage) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required min="0">
                            @error('mileage') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="transmission_type" class="block text-sm font-medium text-gray-700">Transmission Type:</label>
                            <input type="text" id="transmission_type" name="transmission_type" value="{{ old('transmission_type', $car->transmission_type) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            @error('transmission_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="fuel_type" class="block text-sm font-medium text-gray-700">Fuel Type:</label>
                            <input type="text" id="fuel_type" name="fuel_type" value="{{ old('fuel_type', $car->fuel_type) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            @error('fuel_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="flex items-center space-x-2">
                             <input type="hidden" name="battery_light_on" value="0"> {{-- Sends 0 if checkbox is unchecked --}}
                            <input type="checkbox" id="battery_light_on" name="battery_light_on" value="1" {{ old('battery_light_on', $car->battery_light_on) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            <label for="battery_light_on" class="text-sm font-medium text-gray-700">Battery Light On?</label>
                            @error('battery_light_on') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        {{-- Placeholders for future condition fields --}}
                        {{-- Add Engine Size, Engine Condition, Brake Condition, Tyre Condition inputs here later --}}

                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('cars.index') }}" class="inline-flex justify-center py-2 px-6 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </a>
                     <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent rounded-md text-sm font-medium text-white bg-gray-800 hover:bg-gray-900">
                        Update
                    </button>
                    {{-- Delete Button (moved to index page) --}}
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ADDED: JavaScript for automatic age calculation --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const registeredYearInput = document.getElementById('registered_year');
        const ageInput = document.getElementById('age');
        
        function calculateAge() {
            const currentYear = new Date().getFullYear();
            const registeredYear = parseInt(registeredYearInput.value, 10);
            
            if (registeredYear && registeredYear <= currentYear && registeredYear.toString().length === 4) {
                const age = currentYear - registeredYear;
                ageInput.value = age >= 0 ? age : 0;
            } else {
                ageInput.value = 0; // Default to 0 if year is invalid or not set
            }
        }
        
        // Add event listener to the year input
        if (registeredYearInput) {
            registeredYearInput.addEventListener('input', calculateAge);
            // Calculate age on page load (for the edit form)
            calculateAge(); 
        }
    });
</script>
@endsection
