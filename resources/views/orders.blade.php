<x-layouts.app :title="__('dashboard.orders')">
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <div class="max-w-7xl mx-6 my-6 mx-auto">
            <flux:heading class="text-center my-3" size="xl">{{ __('orders.heading') }}</flux:heading>
            @if ($orders->isEmpty())
                <p class="text-center text-neutral-500">{{ __('orders.no_orders') }}</p>
            @else
                <ul>
                    @foreach ($orders as $order)
                        <li>
                            <a href="{{ route('order.show', $order) }}">
                                Chat con {{ $order->user->name }} sobre {{ $order->reward->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
         </div>
      </div>
</x-layouts.app>
