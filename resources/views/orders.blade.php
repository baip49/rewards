<x-layouts.app :title="__('dashboard.orders')">
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <div class="max-w-8xl mx-6 my-6 mx-auto">
            <flux:heading class="text-center my-3" size="xl">{{ __('orders.heading') }}</flux:heading>
            @livewire('orders-chat', ['orders' => $orders])
         </div>
      </div>
   </div>
</x-layouts.app>
