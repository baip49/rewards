<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function updatePoints(Request $request, User $user)
    {
    $validated = $request->validate([
        'points' => 'required|integer|min:0',
        'spent_points' => 'required|integer|min:0',
        'name' => 'required|string|max:255',
        'role' => 'required|in:admin,alumno',
        'profile_photo_url' => 'nullable|image|max:2048' // 2MB máximo
    ]);

    $user->points = $validated['points'];
    $user->spent_points = $validated['spent_points'];
    $user->name = $validated['name'];
    $user->role = $validated['role'];

    if ($request->hasFile('profile_photo_url')) {
        $path = $request->file('profile_photo_url')->store('profile_photos', 'public');
        $user->profile_photo_url = $path;
    }

    $user->save();

    return response()->json([
        'success' => true,
        'user' => $user
    ]);
}

}
