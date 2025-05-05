<x-layouts.app :title="__('dashboard.dashboard')">

   @php
      $role = auth()->user()->role;
   @endphp

   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <div
            class="flex h-full w-full items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600 text-white">
            <div class="text-center flex flex-col items-center gap-2">
               <h1 class="text-4xl font-bold flex items-center">
                 Bienvenido, {{ auth()->user()->name }}
               </h1>
               <flux:badge variant="solid" color="{{ $role === 'admin' ? 'red' : 'yellow' }}" class="inline-block">
                 {{ __('users.' . $role) }}
               </flux:badge>
            </div>
         </div>
      </div>
   </div>
</x-layouts.app>
