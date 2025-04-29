<x-layouts.app :title="__('dashboard.progress')">
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <x-rewards.summary name="{{ auth()->user()->name }}" role="{{ auth()->user()->role }}"
            points="{{ auth()->user()->points }}" spent_points="{{ auth()->user()->spent_points }}" />
         <div class="max-w-7xl mx-auto">
            <div class="text-center mb-6">
               <flux:heading size="xl">{{ __('progress.heading') }}</flux:heading>
               <flux:text>{{ __('progress.text') }}</flux:text>
            </div>
            <div class="grid grid-cols-1 gap-5 mb-6 mx-6">
               <x-rewards.reward-card id="1" title="Spotify" description="Tarjeta prepago de Spotify $200" cost="5000"
                  stock="10" points="{{ auth()->user()->points }}" />
               {{-- <x-rewards.reward-card title="Netflix" description="Tarjeta prepago de Netflix $300" cost="7000"
                  stock="5" points="{{ (auth()->user()->points) }}" />
               <x-rewards.reward-card title="Amazon" description="Tarjeta de regalo Amazon $500" cost="10000"
                  stock="0" points="{{ (auth()->user()->points) }}" /> --}}
            </div>
         </div>
      </div>
   </div>
</x-layouts.app>
