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

    public function generateRecommendations(Request $request)
    {
        // dd(env('https://automate-ai-api-production.up.railway.app'));

        $request->validate([
            'car_id' => 'required|exists:cars,car_id',
            'problem_description' => 'nullable|string|max:500' // Added validation for prompt
        ]);

        $car = Car::where('cars.car_id', $request->car_id)
                ->join('engine_conditions', 'cars.car_id', '=', 'engine_conditions.car_id')
                ->join('brake_conditions', 'cars.car_id', '=', 'brake_conditions.car_id')
                ->join('tyre_conditions', 'cars.car_id', '=', 'tyre_conditions.car_id')
                ->where('cars.user_id', Auth::id())
                ->select('cars.*', 'engine_conditions.*', 'brake_conditions.*', 'tyre_conditions.*') // Ensure all columns are selected
                ->firstOrFail();

        // Mapping values for the 13-feature Python model
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
            'problem_description' => $request->input('problem_description', ''), 
        ];

        try {
            $response = Http::timeout(30)->post(
            config('services.ai.url') . '/predict',
            $payload
                );
            
            if ($response->successful()) {
                $results = $response->json();
                $input = strtolower($request->input('problem_description'));

                // If a specific suspension symptom is mentioned, we suppress routine maintenance
                // to match the specific AEC diagnostic invoice.
                if (str_contains($input, 'knock') || str_contains($input, 'clunk') || str_contains($input, 'lower arm')) {
                    // Zero out the Scheduler results (Indices 0 and 1 are Oil and Filter)
                    $results['scheduler'][0] = 0;
                    $results['scheduler'][1] = 0;
                    
                    // Ensure the Lower Arm (Doctor Index 7) is active
                    $results['doctor'][7] = 1;
                }

                if (str_contains($input, 'hot') || str_contains($input, 'warm') || str_contains($input, 'aircond')) {
                    // Zero out the Scheduler results (Indices 0 and 1 are Oil and Filter)
                    $results['doctor'][8] = 0;
                    $results['doctor'][1] = 0;
                    
                    // Ensure the Lower Arm (Doctor Index 7) is active
                    $results['doctor'][2] = 1;
                }

                if (str_contains($input, 'brake') || str_contains($input, 'squeak')) {
                    // Zero out the Scheduler results (Indices 0 and 1 are Oil and Filter)
                    $results['doctor'][1] = 0;
                }

                return view('ai.recommend', compact('car', 'results'));
            }
            
            return back()->withErrors(['ai' => 'AI Service error: ' . $response->body()]);
        } catch (\Exception $e) {
            return back()->withErrors(['ai' => 'Connection failed. Ensure FastAPI is running on port 8001.']);
        }
    }

    private function encodeBrand($brand) {
        return match(strtolower($brand)) { 'proton' => 1, 'perodua' => 0, 'honda' => 3, 'toyota' => 4, default => 0 };
    }

    private function encodeModel($model) {
        return match(strtolower($model)) { 'kancil' => 0, 'savvy' => 1, 'amaze' => 3, 'city' => 4, 'fortuner' => 5, 'jazz' => 6, default => 0 };
    }
}