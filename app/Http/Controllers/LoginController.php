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
        return view('manageLogin.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);
        
        // ✅ Corrected: use 'user_email' to match your database column
        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'user_email' : 'username';

        \Log::info('Attempting login', [$loginField => $request->username]);

        // Attempt login with correct column
        if (Auth::attempt([
            $loginField => $request->username, 
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            // ✅ Redirect based on role
        if (Auth::user()->user_role === 'admin') {
            return redirect()->intended('/admin/dashboard')->with('success', 'Welcome back, Admin!');
        }

        return redirect()->intended('/home')->with('success', 'Login successful!');
    }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
