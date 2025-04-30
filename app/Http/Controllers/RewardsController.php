<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class RewardsController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('rewards', compact('rewards'));
    }

    public function redeem($id)
    {
        $reward = Reward::findOrFail($id);
        $user = auth()->user();

        if ($user->points < $reward->cost || $reward->stock <= 0) {
            return redirect()->back()->with('error', __('reward-card.redeem_failed'));
        }

        $user->points -= $reward->cost;
        $user->spent_points += $reward->cost;
        $reward->stock -= 1;

        $user->save();
        $reward->save();

        $order = Order::create([
            'user_id' => $user->id,
            'reward_id' => $reward->id,
        ]);

        return redirect()->back()->with('success', __('reward-card.redeem_success'));
    }

    public function admin() {
        $rewards = Reward::all();
        return view('rewadmin', compact('rewards'));
    }

    public function create() 
    {

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'cost' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $reward = Reward::findOrFail($id);

            $reward->update($validated);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $content = file_get_contents($file->getRealPath());
                $path = 'rewards/' . $file->getClientOriginalName();
                Storage::disk('public')->put($path, $content);
                $reward->image = $path;
                $reward->save();
            }

            return redirect()->back()->with('success', __('reward-card.update_success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('reward-card.update_failed') . ': ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $reward = Reward::findOrFail($id);
        $reward->delete();

        return redirect()->back()->with('success', __('reward-card.delete_success'));
    }
}
