<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    /**
     * Display a listing of the logged-in user's cars.
     * Corresponds to the "My Cars" page.
     */
    public function index()
    {
        // Fetch only the cars belonging to the currently authenticated user
        $cars = Auth::user()->cars()->get(); // Assuming User model has a 'cars' relationship defined

        // Return the view, passing the user's cars
        return view('cars.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new car.
     * Corresponds to the "Add A Car" button/page.
     */
    public function create()
    {
        // Return the view containing the form to add a new car
        return view('cars.create');
    }

    /**
     * Store a newly created car in storage for the logged-in user.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data based on the 'cars' table structure
        $validated = $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'registered_year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y')],
            'transmission_type' => ['required', 'string', 'max:255'],
            'fuel_type' => ['required', 'string', 'max:255'],
            'mileage' => ['required', 'integer', 'min:0'],
            'license_plate' => ['required', 'string', 'max:255', Rule::unique('cars', 'license_plate')],
            'age' => ['required', 'integer', 'min:0'],
            'battery_light_on' => ['nullable', 'boolean'], // Allow nullable for optional fields
        ]);

        // Add the logged-in user's ID to the validated data
        $validated['user_id'] = Auth::id();

        // Create the new car record
        Car::create($validated);

        // Redirect the user back to their car list with a success message
        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }

    /**
     * Show the form for editing the specified car.
     * Corresponds to the "Car Info" page.
     */
    public function edit(Car $car)
    {
        // Authorization: Ensure the logged-in user owns this car
        if ($car->user_id !== Auth::id()) {
            abort(403); // Forbidden access if not the owner
        }

        // Return the view for editing the car, passing the car data
        return view('cars.edit', ['car' => $car]);
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, Car $car)
    {
        // Authorization: Ensure the logged-in user owns this car
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'registered_year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y')],
            'transmission_type' => ['required', 'string', 'max:255'],
            'fuel_type' => ['required', 'string', 'max:255'],
            'mileage' => ['required', 'integer', 'min:0'],
            // Ensure license plate is unique, ignoring the current car's plate
            'license_plate' => ['required', 'string', 'max:255', Rule::unique('cars', 'license_plate')->ignore($car->car_id, 'car_id')],
             'age' => ['required', 'integer', 'min:0'],
            'battery_light_on' => ['nullable', 'boolean'],
        ]);

        // Update the car record with the validated data
        $car->update($validated);

        // Redirect back to the car list with a success message
        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        // Authorization: Ensure the logged-in user owns this car
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete the car record
        $car->delete();

        // Redirect back to the car list with a success message
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}

