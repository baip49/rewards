<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'reward')->get();
        return view('orders', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $messages = $order->messages()->with('user')->get();
        return view('orders.order', compact('order', 'messages'));
    }

    public function sendMessage(Request $request, Order $order)
    {
        $this->authorize('view', $order);

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'message' => $validated['message'],
        ]);

        return redirect()->back();
    }

    public function close(Order $order)
    {
        $this->authorize('update', $order);

        $order->update(['is_open' => false]);

        return redirect()->route('orders.index')->with('success', __('orders.closed_correctly'));
    }
}
