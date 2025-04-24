<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class rewardController extends Controller
{
    public function edit($id)
    {
        $reward = Reward::findOrFail($id);
        return view('rewards.edit', compact('reward'));
    }
    
    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);
        $reward->update($request->only(['title', 'description', 'stock', 'cost']));
    
        return redirect()->route('rewards.edit', $id)->with('success', 'Recompensa actualizada');
    }
    
}