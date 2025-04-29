@props(['id', 'title', 'description', 'cost', 'stock', 'points'])

<div class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg">
   <div class="space-y-4">
      <div class="flex justify-between items-center">
         <h2 class="text-xl font-semibold text-zinc-800 dark:text-white">{{ $title }}</h2>

         @if ($stock > 0 && $points >= $cost)
            <form method="POST" action="{{ route('rewards.redeem', $id) }}">
               @csrf
               <button type="submit"
                  class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none">
                  {{ __('reward-card.redeem') }}
               </button>
            </form>
         @elseif ($stock <= 0)
            <button class="px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed opacity-50" disabled>
               {{ __('reward-card.out_of_stock') }}
            </button>
         @else
            <button class="px-4 py-2 bg-yellow-500 text-white rounded-lg cursor-not-allowed opacity-70" disabled>
               {{ __('reward-card.not_enough_points') }}
            </button>
         @endif
      </div>

      <p class="text-sm text-zinc-600 dark:text-zinc-300">{{ $description }}</p>
   </div>

   <div class="flex justify-between items-center">
      <div class="flex flex-row text-green-600 dark:text-green-400">
         <flux:icon.trophy class="me-1" />
         <span class="text-lg font-bold">
            {{ $cost . ' ' . __('reward-card.points') }}
         </span>
      </div>
      <span class="text-sm text-zinc-500 dark:text-zinc-400">
         {{ $stock > 0 ? $stock . ' ' . __('reward-card.stock') : __('reward-card.out_of_stock') }}
      </span>
   </div>

   <flux:text>Progreso</flux:text>
   <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
      <div class="bg-blue-600 h-4 rounded-full" style="width: {{ min(($points / $cost) * 100, 100) }}%;"></div>
   </div>
</div>
