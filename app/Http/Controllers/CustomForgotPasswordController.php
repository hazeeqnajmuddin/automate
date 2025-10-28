<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; // Import the Password facade

class CustomForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link, using your custom view.
     */
    public function showLinkRequestForm()
    {
        // Point to your custom view file name (ensure path is correct)
        return view('manageLogin.forgotPassword'); 
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // 1. Validate the email address
        $request->validate(['email' => 'required|email']);

        // 2. Use the Password facade to send the reset link
        // We need to use 'users' as the password broker guard
        $status = Password::broker()->sendResetLink([
    'user_email' => $request->input('email'),
]);


        // 3. Check the status and redirect back with a message
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status)); // Success message
        }

        // If sending failed (e.g., email not found)
        return back()->withInput($request->only('email'))
                     ->withErrors(['email' => __($status)]); // Error message
    }
}
