<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $orders = Order::with('user', 'reward')->get();
        } else {
            $orders = Order::with('user', 'reward')->where('user_id', $user->id)->get();
        }
        return view('orders', compact('orders'));
    }
}
