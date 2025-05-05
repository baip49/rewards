<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrdersChat extends Component
{
    public $orders;
    public $selectedOrderId = null;
    public $message = '';

    public function mount($orders)
    {
        $this->orders = $orders;
    }

    public function selectOrder($orderId)
    {
        $this->selectedOrderId = $orderId;
    }

    public function sendMessage()
    {

        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        $order = Order::findOrFail($this->selectedOrderId);
        $order->messages()->create([
            'user_id' => auth()->id(),
            'message' => $this->message,
        ]);
        $this->message = '';
    }

    public function close($orderId)
    {
        $order = Order::findOrFail($orderId);
        $this->authorize('close', $order);

        $user = auth()->user();

        $order->update(['is_open' => false]);

        $this->orders = $user->role === 'admin'
            ? Order::with('user', 'reward')->get()
            : Order::with('user', 'reward')->where('user_id', $user->id)->get();

        session()->flash('success', __('orders.closed_correctly'));
    }

    public function open($orderId)
    {
        $order = Order::findOrFail($orderId);
        $this->authorize('open', $order);

        $user = auth()->user();
        $order->update(['is_open' => true]);
        $this->orders = $user->role === 'admin'
            ? Order::with('user', 'reward')->get()
            : Order::with('user', 'reward')->where('user_id', $user->id)->get();
        session()->flash('success', __('orders.opened_correctly'));
    }

    public function render()
    {
        $selectedOrder = $this->selectedOrderId
            ? Order::with(['messages.user', 'reward', 'user'])->find($this->selectedOrderId)
            : null;

        return view('livewire.orders-chat', [
            'selectedOrder' => $selectedOrder,
        ]);
    }
}
