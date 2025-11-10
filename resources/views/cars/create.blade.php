@extends('layouts.app')

@section('title', 'Add New Car')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-2xl mx-auto">
        
        <h1 class="text-3xl font-bold border-b-2 border-gray-800 pb-2 mb-8">Add New Car</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('cars.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="brand" class="block text-lg font-medium text-gray-700">Brand:</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('brand') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="model" class="block text-lg font-medium text-gray-700">Model:</label>
                    <input type="text" id="model" name="model" value="{{ old('model') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('model') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="registered_year" class="block text-lg font-medium text-gray-700">Registered Year:</label>
                    <input type="number" id="registered_year" name="registered_year" value="{{ old('registered_year') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required min="1900" max="{{ date('Y') }}">
                    @error('registered_year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
        <label for="age" class="block text-lg font-medium text-gray-700">Age (Years):</label>
        {{-- MODIFIED: Added readonly and a placeholder/default value --}}
        <input type="number" id="age" name="age" value="{{ old('age', $car->age ?? 0) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly min="0">
        {{-- We remove the error block for 'age' since it's auto-calculated --}}
    </div>

                <div>
                    <label for="license_plate" class="block text-lg font-medium text-gray-700">License Plate:</label>
                    <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('license_plate') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="mileage" class="block text-lg font-medium text-gray-700">Mileage (KM):</label>
                    <input type="number" id="mileage" name="mileage" value="{{ old('mileage') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required min="0">
                    @error('mileage') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="transmission_type" class="block text-lg font-medium text-gray-700">Transmission Type:</label>
                    <input type="text" id="transmission_type" name="transmission_type" value="{{ old('transmission_type') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('transmission_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="fuel_type" class="block text-lg font-medium text-gray-700">Fuel Type:</label>
                    <input type="text" id="fuel_type" name="fuel_type" value="{{ old('fuel_type') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('fuel_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="battery_light_on" name="battery_light_on" value="1" {{ old('battery_light_on') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <label for="battery_light_on" class="text-lg font-medium text-gray-700">Battery Light On?</label>
                    @error('battery_light_on') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('cars.index') }}" class="inline-flex justify-center py-2 px-6 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent rounded-md text-sm font-medium text-white bg-gray-800 hover:bg-gray-900">
                        Add Car
                    </button>
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
        
        if (registeredYearInput) {
            registeredYearInput.addEventListener('input', calculateAge);
        }
    });
</script>
@endsection
