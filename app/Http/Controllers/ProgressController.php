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

    public function pin($id)
    {
        // $reward es el ID recibido por la URL
        $user = Auth::user();
        $user->goal_reward_id = $id;
        $user->save();

        return redirect()->route('progress')->with('success', 'Recompensa establecida con éxito');
    }

    public function unpin($id)
    {
        $user = Auth::user();
        if ($user->goal_reward_id != $id) {
            return redirect()->back()->with('error', 'No puedes eliminar esta recompensa');
        }

        $user->goal_reward_id = null;
        $user->save();

        return redirect()->back()->with('success', 'Recompensa removida con éxito');
    }
}
