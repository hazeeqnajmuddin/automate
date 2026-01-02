@extends('layouts.app')

@section('title', 'Add New Vehicle')

@section('content')
<div class="container mx-auto p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        
        <!-- Top Header with Back Button -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>Fleet Expansion</span>
                </div>
                <h1 class="text-5xl font-black text-gray-900 leading-tight tracking-tighter uppercase italic">
                    Register <span class="text-indigo-600">Vehicle</span>
                </h1>
                <p class="text-xl text-gray-500 mt-2 font-medium italic">Add a new asset to your digital garage for AI diagnostics.</p>
            </div>
            
            <a href="{{ route('cars.index') }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Garage
            </a>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-stretch min-h-[70vh]">
            
            <!-- Left Side: Visual Identity Card -->
            <div class="w-full lg:w-1/3 flex sticky top-24">
                <div class="bg-slate-900 p-12 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center w-full border-4 border-indigo-500/30 group overflow-hidden relative">
                    
                    <!-- Decorative Background -->
                    <div class="absolute -right-10 -top-10 h-40 w-40 bg-indigo-500/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>

                    <!-- Image/Icon Preview Area -->
                    <div class="relative z-10 w-full flex flex-col items-center">
                        <div class="h-48 w-full rounded-3xl bg-indigo-600 flex items-center justify-center border-4 border-white shadow-2xl mb-8 overflow-hidden transition-transform duration-500 group-hover:rotate-0 rotate-3">
                            <img id="car-image-preview" src="" alt="Preview" class="hidden w-full h-full object-cover">
                            <div id="image-placeholder" class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span class="text-[9px] font-black text-indigo-200 uppercase tracking-[0.2em] mt-3">Identity Pending</span>
                            </div>
                        </div>
                        
                        <h2 id="preview-title" class="text-2xl font-black text-white tracking-tighter uppercase italic text-center leading-none">New Asset</h2>
                        <p id="preview-subtitle" class="text-indigo-400 font-bold mt-2 uppercase tracking-widest text-[10px]">Awaiting Specifications</p>
                    </div>

                    <!-- Compliance Note -->
                    <div class="mt-12 w-full bg-white/5 p-6 rounded-2xl border border-white/10 text-center relative z-10">
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">System Protocol</p>
                        <p class="text-[10px] text-indigo-200 mt-2 font-medium leading-relaxed italic">"Ensure mileage and engine data are accurate for optimal AI diagnostic performance."</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Creation Form -->
            <div class="w-full lg:w-2/3 flex flex-col">
                <div class="bg-white p-10 md:p-16 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 flex-1">
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                        @csrf

                        <div>
                            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-10 italic border-b border-gray-100 pb-4">Vehicle Specifications</h3>
                            
                            <!-- Image Upload Section -->
                            <div class="mb-10 space-y-4 bg-slate-50 p-8 rounded-3xl border-2 border-dashed border-slate-200 transition-colors hover:border-indigo-300">
                                <label for="car_image" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Vehicle Profile Photo</label>
                                <div class="flex items-center space-x-6">
                                    <div class="shrink-0 p-4 bg-white rounded-2xl shadow-sm text-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="file" id="car_image" name="car_image" accept="image/*"
                                           class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition cursor-pointer">
                                </div>
                                @error('car_image') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                                <!-- Brand -->
                                <div class="space-y-2">
                                    <label for="brand" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Manufacturer</label>
                                    <input type="text" id="brand" name="brand" value="{{ old('brand') }}" 
                                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-4 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase tracking-tight" placeholder="e.g. TOYOTA" required>
                                    @error('brand') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Model -->
                                <div class="space-y-2">
                                    <label for="model" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Model Name</label>
                                    <input type="text" id="model" name="model" value="{{ old('model') }}" 
                                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-4 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase tracking-tight" placeholder="e.g. VIOS" required>
                                    @error('model') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Reg Year -->
                                <div class="space-y-2">
                                    <label for="registered_year" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Registration Year</label>
                                    <input type="number" id="registered_year" name="registered_year" value="{{ old('registered_year') }}" 
                                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-4 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold" 
                                           required min="1900" max="{{ date('Y') }}">
                                    @error('registered_year') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Age (Read-only) -->
                                <div class="space-y-2">
                                    <label for="age" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Calculated Age (Yrs)</label>
                                    <input type="number" id="age" name="age" value="{{ old('age', 0) }}" 
                                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-4 bg-gray-100 font-black text-gray-500 outline-none" readonly>
                                </div>

                                <!-- License Plate -->
                                <div class="space-y-2">
                                    <label for="license_plate" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">License Plate</label>
                                    <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" 
                                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-4 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase" placeholder="e.g. ABC 1234" required>
                                    @error('license_plate') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Mileage -->
                                <div class="space-y-2">
                                    <label for="mileage" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Odometer Reading (KM)</label>
                                    <input type="number" id="mileage" name="mileage" value="{{ old('mileage') }}" 
                                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-4 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold" placeholder="0" required min="0">
                                    @error('mileage') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Transmission -->
                                <div class="space-y-2">
                                    <label for="transmission_type" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Transmission</label>
                                    <select id="transmission_type" name="transmission_type" 
                                            class="w-full border-2 border-gray-100 rounded-xl px-4 py-4 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase cursor-pointer appearance-none" required>
                                        <option value="" disabled selected>— Select —</option>
                                        <option value="Auto" {{ old('transmission_type') == 'Auto' ? 'selected' : '' }}>Automatic</option>
                                        <option value="Manual" {{ old('transmission_type') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                        <option value="Semi" {{ old('transmission_type') == 'Semi' ? 'selected' : '' }}>Semi-Auto</option>
                                    </select>
                                    @error('transmission_type') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Fuel Type -->
                                <div class="space-y-2">
                                    <label for="fuel_type" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Fuel System</label>
                                    <select id="fuel_type" name="fuel_type" 
                                            class="w-full border-2 border-gray-100 rounded-xl px-4 py-4 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase cursor-pointer appearance-none" required>
                                        <option value="" disabled selected>— Select —</option>
                                        <option value="Petrol" {{ old('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                        <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric (EV)</option>
                                        <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                    @error('fuel_type') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Engine Diagnostics Section -->
                        <div>
                            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-8 italic border-b border-gray-100 pb-4">Engine Diagnostics</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label for="engine_size" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Engine Displacement</label>
                                    <select id="engine_size" name="engine_size" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase" required>
                                        <option value="" disabled selected>— Select Size —</option>
                                        <option value="1.0" {{ old('engine_size') == '1.0' ? 'selected' : '' }}>1.0L - 1.2L</option>
                                        <option value="1.5" {{ old('engine_size') == '1.5' ? 'selected' : '' }}>1.3L - 1.6L</option>
                                        <option value="2.0" {{ old('engine_size') == '2.0' ? 'selected' : '' }}>1.8L - 2.4L</option>
                                    </select>
                                    @error('engine_size') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="engine_noise" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Engine Noise Status</label>
                                    <select id="engine_noise" name="engine_noise" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase" required>
                                        <option value="" disabled selected>— Select Condition —</option>
                                        <option value="Normal" {{ old('engine_noise') == 'Normal' ? 'selected' : '' }}>Normal / Quiet</option>
                                        <option value="Tapping" {{ old('engine_noise') == 'Tapping' ? 'selected' : '' }}>Tapping / Clicking</option>
                                        <option value="Grinding" {{ old('engine_noise') == 'Grinding' ? 'selected' : '' }}>Rough Grinding</option>
                                    </select>
                                    @error('engine_noise') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex items-center space-x-4 pt-2">
                                    <input type="hidden" name="engine_light" value="0">
                                    <label class="relative inline-flex items-center cursor-pointer group">
                                        <input type="checkbox" name="engine_light" value="1" {{ old('engine_light') ? 'checked' : '' }} class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-orange-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                        <span class="ml-3 text-sm font-black text-gray-900 uppercase tracking-widest">Check Engine Light On?</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Brakes & Tyres Section -->
                        <div>
                            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-8 italic border-b border-gray-100 pb-4">Brakes & Tyres</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label for="brake_effectiveness" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Brake Effectiveness</label>
                                    <select id="brake_effectiveness" name="brake_effectiveness" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase" required>
                                        <option value="" disabled selected>— Select Status —</option>
                                        <option value="High" {{ old('brake_effectiveness') == 'High' ? 'selected' : '' }}>High / Firm</option>
                                        <option value="Medium" {{ old('brake_effectiveness') == 'Medium' ? 'selected' : '' }}>Medium / Average</option>
                                        <option value="Low" {{ old('brake_effectiveness') == 'Low' ? 'selected' : '' }}>Low / Mushy</option>
                                    </select>
                                    @error('brake_effectiveness') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="tyre_tread" class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Tyre Tread Condition</label>
                                    <select id="tyre_tread" name="tyre_tread" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-all outline-none bg-gray-50 font-bold uppercase" required>
                                        <option value="" disabled selected>— Select Condition —</option>
                                        <option value="New" {{ old('tyre_tread') == 'New' ? 'selected' : '' }}>New / Excellent</option>
                                        <option value="Good" {{ old('tyre_tread') == 'Good' ? 'selected' : '' }}>Good / Fair</option>
                                        <option value="Worn" {{ old('tyre_tread') == 'Worn' ? 'selected' : '' }}>Worn / Bald</option>
                                    </select>
                                    @error('tyre_tread') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dashboard Status Indicators -->
                        <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-gray-100">
                            <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest mb-6 italic">Health Indicators</h3>
                            <div class="flex items-center space-x-4">
                                <input type="hidden" name="battery_light_on" value="0">
                                <label class="relative inline-flex items-center cursor-pointer group">
                                    <input type="checkbox" id="battery_light_on" name="battery_light_on" value="1" {{ old('battery_light_on') ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                                    <span class="ml-4 text-sm font-black text-gray-900 uppercase tracking-widest">Battery Warning Light Active?</span>
                                </label>
                            </div>
                            @error('battery_light_on') <p class="text-red-500 text-[10px] font-bold uppercase tracking-tight mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Action Footer -->
                        <div class="flex justify-end items-center space-x-4 pt-10 border-t border-gray-50">
                            <a href="{{ route('cars.index') }}" class="px-8 py-4 border-2 border-gray-100 text-gray-400 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-50 hover:text-gray-800 transition-all">
                                Cancel
                            </a>
                            <button type="submit" class="px-12 py-4 bg-indigo-600 text-white rounded-xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/30 active:scale-95">
                                Add Vehicle to Fleet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const registeredYearInput = document.getElementById('registered_year');
        const ageInput = document.getElementById('age');
        const imageInput = document.getElementById('car_image');
        const imagePreview = document.getElementById('car-image-preview');
        const placeholder = document.getElementById('image-placeholder');
        
        const brandInput = document.getElementById('brand');
        const modelInput = document.getElementById('model');
        const previewTitle = document.getElementById('preview-title');
        const previewSubtitle = document.getElementById('preview-subtitle');
        
        // Age Calculation
        function calculateAge() {
            const currentYear = new Date().getFullYear();
            const registeredYear = parseInt(registeredYearInput.value, 10);
            
            if (registeredYear && registeredYear <= currentYear && registeredYear.toString().length === 4) {
                const age = currentYear - registeredYear;
                ageInput.value = age >= 0 ? age : 0;
                previewSubtitle.textContent = registeredYear + ' Registration';
            } else {
                ageInput.value = 0; 
                previewSubtitle.textContent = 'Awaiting Specifications';
            }
        }

        // Title Preview
        function updatePreviewTitle() {
            const brand = brandInput.value.trim().toUpperCase();
            const model = modelInput.value.trim().toUpperCase();
            
            if (brand || model) {
                previewTitle.textContent = (brand + ' ' + model).trim();
            } else {
                previewTitle.textContent = 'New Asset';
            }
        }
        
        if (registeredYearInput) registeredYearInput.addEventListener('input', calculateAge);
        if (brandInput) brandInput.addEventListener('input', updatePreviewTitle);
        if (modelInput) modelInput.addEventListener('input', updatePreviewTitle);

        // Image Preview Script
        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        if (placeholder) placeholder.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection