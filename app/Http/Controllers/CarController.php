<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the logged-in user's cars.
     */
    public function index()
    {
        $cars = Auth::user()->cars()->get();
        return view('cars.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created car in storage.
     */
    /**
 * Store a newly created car and its initial diagnostic conditions.
 */
public function store(Request $request)
{
    $validated = $request->validate([
        'brand' => ['required', 'string', 'max:255'],
        'model' => ['required', 'string', 'max:255'],
        'registered_year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y')],
        'transmission_type' => ['required', 'string'],
        'fuel_type' => ['required', 'string'],
        'mileage' => ['required', 'integer', 'min:0'],
        'license_plate' => ['required', 'string', Rule::unique('cars', 'license_plate')],
        'car_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        
        // Diagnostics
        'engine_size' => ['required'],
        'engine_noise' => ['required'],
        'engine_light' => ['nullable', 'boolean'],
        'brake_effectiveness' => ['required'],
        'tyre_tread' => ['required'],
    ]);

    

    DB::transaction(function () use ($request, $validated) {

        $imagePath = null;
    if ($request->hasFile('car_image')) {
        // This stores the image in storage/app/public/car_photos
        $imagePath = $request->file('car_image')->store('car_photos', 'public');
    }

        $car = Car::create([
            'user_id' => Auth::id(),
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'registered_year' => $validated['registered_year'],
            'transmission_type' => $validated['transmission_type'],
            'fuel_type' => $validated['fuel_type'],
            'mileage' => $validated['mileage'],
            'license_plate' => $validated['license_plate'],
            'battery_light_on' => $request->boolean('battery_light_on'),
            'age' => date('Y') - $validated['registered_year'],
            'car_image_path' => $imagePath,
        ]);

        $car->engineCondition()->create([
            'engine_size' => $validated['engine_size'],
            'engine_noise' => $validated['engine_noise'],
            'engine_light' => $request->boolean('engine_light'),
        ]);

        $car->brakeCondition()->create([
            'brake_effectiveness' => $validated['brake_effectiveness'],
        ]);

        $car->tyreCondition()->create([
            'tyre_tread' => $validated['tyre_tread'],
        ]);
    });

    return redirect()->route('cars.index')->with('success', 'Car and diagnostics recorded.');
}


    /**
     * Show the form for editing the specified car.
     */
    public function edit(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }

        // Eager load diagnostic relationships to prevent N+1 issues in the view
        $car->load(['engineCondition', 'brakeCondition', 'tyreCondition']);

        return view('cars.edit', ['car' => $car]);
    }

    /**
     * Update the specified car and its diagnostic conditions.
     */
    public function update(Request $request, Car $car)
{
    if ($car->user_id !== Auth::id()) abort(403);

    $validated = $request->validate([
        'brand' => ['required', 'string', 'max:255'],
        'model' => ['required', 'string', 'max:255'],
        'registered_year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y')],
        'mileage' => ['required', 'integer', 'min:0'],
        'license_plate' => ['required', Rule::unique('cars', 'license_plate')->ignore($car->car_id, 'car_id')],
        'car_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',


        // Diagnostics
        'engine_size' => ['required'],
        'engine_noise' => ['required'],
        'engine_light' => ['nullable', 'boolean'],
        'brake_effectiveness' => ['required'],
        'tyre_tread' => ['required'],
        'battery_light_on' => ['nullable', 'boolean'],
    ]);

    $newImagePath = $car->car_image_path;
        if ($request->hasFile('car_image')) {
            $newImagePath = $request->file('car_image')->store('car_photos', 'public');
        }

    DB::transaction(function () use ($request, $car, $validated, $newImagePath) {

        $oldImagePath = $car->car_image_path;

        $car->update([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'registered_year' => $validated['registered_year'],
            'mileage' => $validated['mileage'],
            'license_plate' => $validated['license_plate'],
            'battery_light_on' => $request->boolean('battery_light_on'),
            'age' => date('Y') - $validated['registered_year'],
            'car_image_path' => $newImagePath,
        ]);

        $car->engineCondition()->updateOrCreate(
            ['car_id' => $car->car_id],
            [
                'engine_size' => $validated['engine_size'],
                'engine_noise' => $validated['engine_noise'],
                'engine_light' => $request->boolean('engine_light'),
            ]
        );

        $car->brakeCondition()->updateOrCreate(
            ['car_id' => $car->car_id],
            [
                'brake_effectiveness' => $validated['brake_effectiveness'],
            ]
        );

        $car->tyreCondition()->updateOrCreate(
            ['car_id' => $car->car_id],
            [
                'tyre_tread' => $validated['tyre_tread'],
            ]
        );
        // ONLY delete the old image if the DB update succeeded and a new one was uploaded
            if ($request->hasFile('car_image') && $oldImagePath && $oldImagePath !== $newImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
        });

        return redirect()->route('cars.index')->with('success', 'Car and diagnostics updated successfully.');
    }


    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}