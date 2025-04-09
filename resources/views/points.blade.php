<x-layouts.app :title="__('dashboard.points')">
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <x-rewards.summary 
            name="{{ auth()->user()->name }}" 
            points="{{ auth()->user()->points }}" 
            spent_points="{{ auth()->user()->spent_points }}" 
         />
      </div>
   </div>
</x-layouts.app>
