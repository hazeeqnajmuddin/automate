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
     * This will be our "Manage System Users" page.
     */
    public function index()
    {
        $users = User::all();
        // We will create this new view file in the next step
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     * This is the "Add User" page.
     */
    public function create()
    {
        // We will create this view file
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
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

        User::create([
            'full_name' => $validated['full_name'],
            'username' => $validated['username'],
            'user_email' => $validated['user_email'],
            'password' => Hash::make($validated['password']),
            'user_role' => $validated['user_role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     * This is the "User's Profile" page for admins.
     */
    public function edit(User $user)
    {
        // We will create this view file
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->user_id, 'user_id')],
            'user_email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->user_id, 'user_id')],
            'user_role' => ['required', Rule::in(['car_owner', 'admin'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->full_name = $validated['full_name'];
        $user->username = $validated['username'];
        $user->user_email = $validated['user_email'];
        $user->user_role = $validated['user_role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // You might want to add a check here to prevent an admin from deleting themselves
        if ($user->user_id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
