<div class="flex h-[calc(100vh-20vh)] bg-zinc-50 dark:bg-zinc-900 rounded-xl overflow-hidden">
   <!-- Sidebar -->
   <aside class="w-72 bg-zinc-50 border-e border-zinc-200 dark:border-white/10 dark:bg-zinc-900 p-4 flex flex-col gap-2 overflow-y-auto">
      @foreach ($orders->sortByDesc('is_open') as $order)
          <button wire:click="selectOrder({{ $order->id }})"
            class="w-full flex-1 min-h-[100px] max-h-[100px] cursor-pointer break-normal h-full text-left px-4 py-2 rounded-lg mb-1
                  {{ $selectedOrderId === $order->id ? 'bg-gray-200 text-black dark:bg-white/10 dark:text-white' : 'hover:bg-gray-100 text-black dark:hover:bg-white/30 dark:text-white' }}">
            <div class="font-semibold">
               {{ __('orders.order', ['id' => $order->id]) }} - {{ $order->user->name }}
            </div>
            <div class="flex gap-2 mt-1">
               <flux:badge color="emerald" size="sm">{{ $order->reward->title }}</flux:badge>
               <flux:badge variant="solid" color="{{ $order->is_open ? 'lime' : 'red' }}" size="sm">
                  {{ $order->is_open ? __('orders.opened') : __('orders.closed') }}
               </flux:badge>
            </div>
         </button>
      @endforeach
   </aside>

   <!-- Main content -->
   <main class="flex-1 flex flex-col overflow-y-auto">
      @if ($selectedOrder)
         <!-- Header -->
         <div class="flex items-center justify-between bg-black/10 dark:bg-white/10 border-b border-zinc-200 dark:border-white/10 px-8 py-4">
            <flux:heading size="lg">{{ __('orders.reward_redeemed') . ': ' . $selectedOrder->reward->title }}
            </flux:heading>
            @if (auth()->user()->role === 'admin')
               @if ($selectedOrder->is_open)
                  <div wire:key="header-{{ $selectedOrder->id }}">
                     <flux:modal.trigger :name="'close-order-' . $selectedOrder->id">
                        <flux:tooltip content="{{ __('orders.close_order') }}">
                           <button type="button"
                              class="p-2 text-dark dark:text-white border border-red-500 rounded-lg hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
                              <flux:icon.lock-closed />
                           </button>
                        </flux:tooltip>
                     </flux:modal.trigger>
                     <flux:modal :name="'close-order-' . $selectedOrder->id" class="md:w-96">
                        <div class="space-y-3">
                           <flux:heading size="lg">{{ __('orders.close_confirmation') }}</flux:heading>
                           <flux:text class="mt-2">{{ __('orders.close_description') }}</flux:text>
                           <div class="flex gap-2">
                              <flux:spacer />
                              <flux:modal.close>
                                 <flux:button variant="ghost" class="cursor-pointer">{{ __('orders.cancel') }}</flux:button>
                              </flux:modal.close>
                                <flux:button wire:click="close({{ $selectedOrder->id }})" type="submit" variant="danger" class="cursor-pointer">
                                  {{ __('orders.close_order') }}
                                </flux:button>
                           </div>
                        </div>
                     </flux:modal>
                  </div>
               @else
               <div>
                  <flux:modal.trigger :name="'open-order-' . $selectedOrder->id">
                     <flux:tooltip content="{{ __('orders.open_order') }}">
                        <button type="button"
                           class="p-2 text-dark dark:text-white border border-green-500 rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                           <flux:icon.lock-open />
                        </button>
                     </flux:tooltip>
                  </flux:modal.trigger>
                  <flux:modal :name="'open-order-' . $selectedOrder->id" class="md:w-96">
                     <div class="space-y-3">
                        <flux:heading size="lg">{{ __('orders.open_confirmation') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('orders.open_description') }}</flux:text>
                        <div class="flex gap-2">
                           <flux:spacer />
                           <flux:modal.close>
                              <flux:button variant="ghost" class="cursor-pointer">{{ __('orders.cancel') }}</flux:button>
                           </flux:modal.close>
                           <flux:button wire:click="open({{ $selectedOrder->id }})" type="submit" variant="primary" class="cursor-pointer">
                              {{ __('orders.open_order') }}
                           </flux:button>
                        </div>
                     </div>
                  </flux:modal>
               </div>
               @endif
            @endif
         </div>

         <!-- Ticket details -->
         <div class="px-8 py-4 border-b border-zinc-200 dark:border-white/10 flex items-center justify-between">
            <flex:text>{{ $selectedOrder->reward->description }}</flex:text>
            <flux:text>{{ $selectedOrder->created_at }}</flux:text>
         </div>

         <!-- Chat messages -->
         <div class="flex-1 overflow-y-auto px-8 py-4 flex flex-col gap-4">
            @forelse ($selectedOrder->messages as $message)
               <div>
                  <div class="flex items-center gap-2 mb-1">
                     <flux:avatar name="{{ $message->user->name }}" color="auto"
                     color:seed="{{ $message->user->id }}" />
                     <flux:text>{{ $message->user->name }}</flux:text>
                     <flux:badge variant="solid" size="sm"
                     color="{{ $message->user->isAdmin() ? 'red' : 'yellow' }}" class="ms-2">
                     {{ __('users.' . $message->user->role) }}
                     </flux:badge>
                  </div>
                  <flux:text class="text-base rounded p-3 {{ $message->user->isAdmin() ? 'bg-gray-200 dark:bg-white/20' : 'bg-gray-100 dark:bg-white/10' }}">
                     {{ $message->message }}
                  </flux:text>
                  <flux:text class="text-xs">{{ $message->created_at }}</flux:text>
               </div>
            @empty
               <div class="text-gray-400">No hay mensajes aún.</div>
            @endforelse
         </div>

         <!-- Message input -->
          @if ($selectedOrder->is_open)
            <form wire:submit.prevent="sendMessage"
               class="border-t border-zinc-200 dark:border-white/10 px-8 py-4">
               <flux:input.group>
                 <flux:input wire:model.defer="message" placeholder="{{ __('orders.type_message') }}" required/>
                 <flux:button type="submit" icon="paper-airplane" class="cursor-pointer">
                   {{ __('orders.send') }}
                 </flux:button>
               </flux:input.group>
            </form>
          @else
            <div class="border-t border-zinc-200 dark:border-white/10 px-8 py-4 text-gray-400">
               {{ __('orders.cannot_send_closed') }}
            </div>
          @endif
      @else
         <div class="flex-1 flex items-center justify-center text-gray-400">
            Selecciona una orden para ver el chat.
         </div>
      @endif
   </main>
</div>
