<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * This is the "Manage System Users" page.
     */
    public function index()
    {
        $users = User::all();
        // This returns the view you have on your Canvas
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'user_email' => ['required', 'string', 'email', 'max:255', 'unique:users,user_email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_role' => ['required', Rule::in(['car_owner', 'admin'])],
        ]);

        // We need to hash the password before creating the user
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->user_id, 'user_id')],
            'user_email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'user_email')->ignore($user->user_id, 'user_id')],
            'user_role' => ['required', Rule::in(['car_owner', 'admin'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Update the user's data
        $user->full_name = $validated['full_name'];
        $user->username = $validated['username'];
        $user->user_email = $validated['user_email'];
        $user->user_role = $validated['user_role'];

        // Only update the password if a new one was provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Add a check to prevent an admin from deleting their own account
        if ($user->user_id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}

