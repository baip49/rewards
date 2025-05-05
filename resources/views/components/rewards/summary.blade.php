@props(['name', 'role', 'points', 'spent_points'])

<div class="p-7 lg:p-12 bg-gradient-to-r from-blue-600 to-blue-400 rounded-xl mb-6 shadow-lg">
   <div class="max-w-7xl mx-auto">
      <div class="flex items-center mb-6">
         <flux:heading size="xl" level="2">Hola, {{ $name }}</flux:heading>
         <flux:badge variant="solid" color="{{ $role === 'admin' ? 'red' : 'yellow' }}" class="ms-2">
            {{ __('users.' . $role) }}
         </flux:badge>
      </div>

      <div class="flex justify-between items-center">
         <div class="flex-col grid justify-items-start text-start">
            <flux:icon.trophy class="size-12" />
            <flux:heading size="xl">{{ $points }}</flux:heading>
            <flux:text>Puntos disponibles</flux:text>
         </div>
         <div class="flex-col grid justify-items-end text-end items-end">
            <flux:icon.shopping-bag class="size-12" />
            <flux:heading size="xl">{{ $spent_points }}</flux:heading>
            <flux:text>Puntos gastados</flux:text>
         </div>
      </div>
   </div>
</div>
