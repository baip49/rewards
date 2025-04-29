@props(['id', 'title', 'description', 'cost', 'stock', 'points'])

<div class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg">
   <div class="space-y-4">
      <div class="flex justify-between items-center">
         <h2 class="text-xl font-semibold text-zinc-800 dark:text-white">{{ $title }}</h2>

         @if ($stock > 0 && $points >= $cost)
            <button onclick="openRedeemModal({{ $id }}, '{{ $title }}', {{ $cost }})"
               class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
               {{ __('reward-card.redeem') }}
            </button>
         @elseif ($stock <= 0)
            <button class="px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed opacity-50" disabled>
               {{ ucfirst(__('reward-card.out_of_stock')) }}
            </button>
         @else
            <button class="px-4 py-2 bg-yellow-400 text-white rounded-lg cursor-not-allowed opacity-50" disabled>
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

<!-- Modal de confirmación para canje -->
<dialog id="redeemModal" class="modal bg-white dark:bg-zinc-900 p-6 rounded-xl max-w-md w-full z-50">
   <form method="POST" id="redeemForm">
      @csrf
      <h2 class="text-xl font-semibold mb-4 text-white">¿Confirmar canje?</h2>
      <p id="redeemModalMessage" class="text-white mb-4"></p>

      <div class="flex justify-end gap-2">
         <button type="button" onclick="document.getElementById('redeemModal').close()" class="px-3 py-1 bg-gray-400 rounded">Cancelar</button>
         <button type="submit" class="px-3 py-1 bg-green-700 text-white rounded">Confirmar</button>
      </div>
   </form>
</dialog>

<!-- Script para manejar modal -->
<script>
   function openRedeemModal(rewardId, title, cost) {
      const form = document.getElementById('redeemForm');
      const message = document.getElementById('redeemModalMessage');
      const modal = document.getElementById('redeemModal');

      form.action = `/rewards/${rewardId}/redeem`; // Asegúrate de que esta ruta exista
      message.textContent = `¿Estás seguro que deseas canjear "${title}" por ${cost} puntos?`;

      modal.showModal();
   }
</script>
