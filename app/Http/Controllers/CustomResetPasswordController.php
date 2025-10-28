<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password; // Import Password facade
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class CustomResetPasswordController extends Controller
{
    /**
     * Display the password reset view for the given token, using your custom view.
     */
    public function showResetForm(Request $request, $token = null)
    {
         // Point to your custom view file name (ensure path is correct)
        return view('manageLogin.resetPassword')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Handle an incoming reset password request.
     */
    public function reset(Request $request)
    {
        // 1. Validate the incoming data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email', // Changed from user_email to match form
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Attempt to reset the user's password using the Password facade
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // This closure runs if the reset is successful
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                // Optionally log the user in after reset
                // Auth::login($user); 
            }
        );

        // 3. Check the status and redirect
        if ($status == Password::PASSWORD_RESET) {
            // Redirect to login page with success message
            return redirect()->route('login')->with('status', __($status));
        }

        // If reset failed (e.g., invalid token or email)
        return back()->withInput($request->only('email'))
                     ->withErrors(['email' => __($status)]);
    }
}
