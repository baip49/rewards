<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;

class RewardController extends Controller
{
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
