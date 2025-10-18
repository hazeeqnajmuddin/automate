<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function show()
    {
        // This returns the Blade file you just showed me
        // Assuming it's saved as resources/views/login.blade.php
        // And you have a layouts/app.blade.php
        return view('manageLogin.login');
    }

    /**
     * Handle an authentication attempt.
     */
    // ...
public function login(Request $request)
{
    // 1. Validate the form data
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required'],
    ]);

    // 2. Attempt to log in using EITHER username or email
    // This is a much better login experience for your users
    
    $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    if (Auth::attempt([
        $loginField => $request->username, 
        'password' => $request->password
    ])) {
        // 3. Successful login
        $request->session()->regenerate();
        return redirect()->intended('/home');
    }

    // 4. Failed login
    return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
}
public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to the landing page after logout
    }

}