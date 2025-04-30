<x-layouts.app :title="__('dashboard.orders')">
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <div class="max-w-7xl mx-6 my-6 mx-auto">
            <flux:heading class="text-center my-3" size="xl">{{ __('orders.heading') }}</flux:heading>
            <h1>Órden sobre {{ $order->reward->title }}</h1>
            <div>
               @foreach ($messages as $message)
                  <p><strong>{{ $message->user->name ?? 'Admin' }}:</strong> {{ $message->message }}</p>
               @endforeach
            </div>
            <form method="POST" action="{{ route('order.sendMessage', $order) }}">
               @csrf
               <textarea name="message" required></textarea>
               <button type="submit">Enviar</button>
            </form>
            <form method="POST" action="{{ route('order.close', $order) }}">
               @csrf
               @method('PUT')
               <button type="submit">Cerrar órden</button>
            </form>
         </div>
      </div>
</x-layouts.app>
