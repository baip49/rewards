<x-layouts.app :title="__('dashboard.dashboard')">

   @php
      $role = auth()->user()->role;
   @endphp

   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <div
            class="flex h-full w-full items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600 text-white">
            <div class="text-center">
               <h1 class="text-4xl font-bold flex items-center">
                  Bienvenido, {{ auth()->user()->name }}<flux:badge variant="solid"
                     color="{{ $role === __('user.admin') ? 'red' : 'yellow' }}" class="ms-2" inset="bottom">
                     {{ ucfirst($role) }}</flux:badge>
               </h1>
            </div>
         </div>
      </div>
   </div>
</x-layouts.app>
