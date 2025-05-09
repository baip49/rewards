<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('viewAny', $user);
        $users = User::all();
        return view('users', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,student',
            'points' => 'required|integer|min:0',
            'spent_points' => 'required|integer|min:0',
        ]);
        // dd($validated);

        try {
            $user->update($validated);
            return redirect()->route('admin.users')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', 'Hubo un problema al actualizar el usuario.');
        }

        // dd($user);
        // return redirect()->route('users')->with('success', 'Usuario actualizado exitosamente.');
    }

    // public function delete(User $user)
    // {
    //     $user->delete();

    //     return redirect()->route('admin.users')->with('success', 'Usuario eliminado exitosamente.');
    // }
}
