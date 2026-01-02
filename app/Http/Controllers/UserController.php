<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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

    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
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
            'profile_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ]);

        // We need to hash the password before creating the user
        $validated['password'] = Hash::make($validated['password']);

        // Handle the profile picture upload if a file is provided
        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('avatars', 'public');
            // Add the path to the validated data array
            $validated['profile_pic_path'] = $path;
        }


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
            'profile_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ]);

            // Handle the profile picture upload if a new file is provided
            if ($request->hasFile('profile_pic')) {
                // Delete the old picture from storage if it exists
                if ($user->profile_pic_path) {
                    Storage::disk('public')->delete($user->profile_pic_path);
                }
                // Store the new picture and update the path in the database
                $user->profile_pic_path = $request->file('profile_pic')->store('avatars', 'public');
            }

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

    /**
     * Display a listing of the specified user's cars (Admin view).
     */
    public function showCars(User $user)
    {
        // Eager load the cars relationship
        $user->load('cars'); 

        // Pass the user and their cars to the admin view
        return view('admin.users.cars', [
            'user' => $user,
            'cars' => $user->cars 
        ]);
    }

    public function showCarDetails(User $user, Car $car)
{
    if ($car->user_id !== $user->user_id) {
        abort(404, 'Asset/Owner mismatch detected.');
    }

    return view('admin.users.car_details', [
        'user' => $user,
        'car' => $car
    ]);
}

}

