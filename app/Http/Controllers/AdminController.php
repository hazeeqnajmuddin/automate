<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        // Fetch all users to display on the dashboard
        $users = User::all();

        // Pass the users data to the admin dashboard view
        return view('admin.dashboard', ['users' => $users]);
    }
}
