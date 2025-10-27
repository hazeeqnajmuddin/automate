<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\AiRecommendation; // Assuming you created this model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiController extends Controller
{
    /**
     * Display the AI service recommender index page.
     * Fetches the user's cars for the selection dropdown.
     */
    public function index()
    {
       
        $user = Auth::user();
        $userCars = $user->cars; // Assumes User model has cars() relationship

        // Ensure the view path is correct for your project
        return view('ai.index', ['userCars' => $userCars]);
        //  dd('✅ AiController index() reached');
    }

    public function generateRecommendations()
    {
        // Fetch only the cars belonging to the currently authenticated user
        $cars = Auth::user()->cars()->get(); // Assuming User model has a 'cars' relationship defined

        // Return the view, passing the user's cars
        return view('ai.recommend', ['cars' => $cars]);
    }

    /**
     * Generate and display service recommendations for the selected car.
     * (Placeholder logic for now)
     */
    // public function generateRecommendations(Request $request)
    // {
    //     // 1. Validate the incoming request
    //     $validated = $request->validate([
    //         'car_id' => 'required|exists:cars,car_id',
    //     ]);

    //     // 2. Find the selected car (ensure it belongs to the current user)
    //     $car = Car::where('car_id', $validated['car_id'])
    //               ->where('user_id', Auth::id())
    //               ->firstOrFail();

    //     // --- AI LOGIC PLACEHOLDER ---
    //     // Fetch recommendations associated with the car
    //     $recommendations = AiRecommendation::where('car_id', $car->car_id)
    //                                         ->orderBy('importance_score', 'desc')
    //                                         ->take(5) // Example limit
    //                                         ->get();
    //     // --- END AI LOGIC PLACEHOLDER ---

    //     // Ensure the view path is correct
    //     return view('ai.recommendations', [
    //         'car' => $car,
    //         'recommendations' => $recommendations
    //     ]);
    // }
}
