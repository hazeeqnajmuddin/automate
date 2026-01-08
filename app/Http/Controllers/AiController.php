<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userCars = $user->cars; 
        return view('ai.index', ['userCars' => $userCars]);
    }

    /**
     * One-Click Prediction: Retrieves data from DB and calls AI.
     */
    public function generateRecommendations(Request $request)
{
    // Validate the input using your database specific primary key
    $request->validate(['car_id' => 'required|exists:cars,car_id']);

    $car = Car::where('cars.car_id', $request->car_id)
            ->join('engine_conditions', 'cars.car_id', '=', 'engine_conditions.car_id')
            ->join('brake_conditions', 'cars.car_id', '=', 'brake_conditions.car_id')
            ->join('tyre_conditions', 'cars.car_id', '=', 'tyre_conditions.car_id')
            ->where('cars.user_id', Auth::id())
            ->firstOrFail();

    // Map your database strings to numerical values for the AI
    $payload = [
            'age' => (float)$car->age,
            'fuel_type' => ($car->fuel_type == 'Petrol') ? 1 : 2,
            'transmission_type' => ($car->transmission_type == 'Auto') ? 1 : 2,
            'engine_size' => (float)$car->engine_size,
            'mileage' => (int)$car->mileage,
            'tyre_tread' => match($car->tyre_tread) { 'Worn' => 1, 'Good' => 2, 'New' => 3, default => 3 },
            'brake_effectiveness' => match($car->brake_effectiveness) { 'Low' => 1, 'Medium' => 2, 'High' => 3, default => 3 },
            'brand' => $this->encodeBrand($car->brand),
            'model' => $this->encodeModel($car->model),
            'registered_year' => (float)$car->registered_year,
            'engine_noise' => ($car->engine_noise == 'Normal') ? 0 : 1,
            'engine_light' => (float)$car->engine_light,
            'battery_light_on' => (int)$car->battery_light_on,
    ];

    try {
        // Call the FastAPI service (running on port 8001)
        $response = Http::timeout(5)->post('http://127.0.0.1:8001/predict', $payload);
        
        if ($response->successful()) {
            $results = $response->json();
            return view('ai.recommend', compact('car', 'results'));
        }
        
        return back()->withErrors(['ai' => 'The AI Service returned an error.']);
    } catch (\Exception $e) {
        return back()->withErrors(['ai' => 'Could not connect to the AI Service. Please ensure FastAPI is running.']);
    }
}
private function encodeBrand($brand) {
        return match(strtolower($brand)) { 'honda' => 1, 'toyota' => 2, 'proton' => 3, 'perodua' => 4, default => 0 };
    }

    private function encodeModel($model) {
        return match(strtolower($model)) { 'civic' => 1, 'vios' => 2, 'exora' => 3, 'axia' => 4, default => 0 };
    }
}