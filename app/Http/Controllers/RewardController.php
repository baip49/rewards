<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;

class RewardController extends Controller
{
        public function showRewards()
    {
        $rewards = Reward::all();
        return view('rewards', compact('rewards'));
    }

    public function redeem(Reward $reward)
    {
        $user = auth()->user();
    
        if ($reward->stock <= 0) {
            return redirect()->back()->with('error', 'Este premio está agotado.');
        }
    
        if ($user->points < $reward->cost) {
            return redirect()->back()->with('error', 'No tienes suficientes puntos.');
        }
    
        $user->points -= $reward->cost;
        $user->spent_points += $reward->cost;
        $user->save();
    
        auth()->setUser($user);
    
        $reward->stock -= 1;
        $reward->save();
    
        return redirect()->back()->with('success', 'Premio canjeado con éxito.');
    }
    


    // Apartado Admin//
    public function index()
    {
        $rewards = Reward::all();
        return view('rewadmin', compact('rewards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'cost' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        Reward::create($request->only('title', 'description', 'cost', 'stock'));

        return redirect()->route('rewards.admin')->with('success', 'Premio creado con éxito');
    }

    public function update(Request $request, Reward $reward)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'cost' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        $reward->update([
            'title' => $request->title,
            'description' => $request->description,
            'cost' => $request->cost,
            'stock' => $request->stock,
        ]);

        return redirect()->route('rewards.admin')->with('success', 'Premio actualizado con éxito');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();

        return redirect()->route('rewards.admin')->with('success', 'Premio eliminado con éxito');
    }
}
