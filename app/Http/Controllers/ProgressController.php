<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $rewards = Reward::all(); // Obtener todas las recompensas
        return view('progress', compact('rewards'));
    }

    public function setGoalReward(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
        ]);

        $user = Auth::user();
        $user->goal_reward_id = $request->reward_id;
        $user->save();

        return redirect()->route('progress')->with('success', '¡Recompensa meta establecida!');
    }
}
