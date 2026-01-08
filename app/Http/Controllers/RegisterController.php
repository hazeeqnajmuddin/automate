<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function show()
    {
        // Using your updated view path
        return view('manageSignUp.register');
    }

    /**
     * Handle the registration form submission.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,user_email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Create the new user with the correct database column names
        $user = User::create([
            'full_name' => $validated['name'],
            'username' => $validated['username'],
            'user_email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_role' => 'car_owner',
        ]);

        // 3. Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}

