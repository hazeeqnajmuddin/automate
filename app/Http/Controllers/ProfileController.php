<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the user's profile page.
     */
    public function show()
    {
        // Pass the currently authenticated user to the view
        return view('manageProfile.viewMyProfile', ['user' => Auth::user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming form data
        $validated = $request->validate([
            'full_name' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            // The password is optional, but if present, must be confirmed and strong
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        // Update fields if they were filled in the form
        if ($request->filled('full_name')) {
            $user->full_name = $validated['full_name'];
        }

        if ($request->filled('phone_number')) {
            $user->phone_number = $validated['phone_number'];
        }
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Save the changes to the database
        $user->save();

        // Redirect back to the profile page with a success message
        return back()->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile picture.
     */
    public function updateAvatar(Request $request)
    {
        // 1. Validate the uploaded file
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 2MB
        ]);

        $user = Auth::user();

        // 2. Delete the old avatar from storage if it exists
        if ($user->profile_pic_path) {
            Storage::disk('public')->delete($user->profile_pic_path);
        }

        // 3. Store the new avatar in 'storage/app/public/avatars' and get its path
        $path = $request->file('avatar')->store('avatars', 'public');

        // 4. Update the user's 'profile_pic_path' in the database
        $user->profile_pic_path = $path;
        $user->save();

        // 5. Redirect back with a different success message
        return back()->with('status', 'avatar-updated');
    }
}


