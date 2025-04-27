@props(['title', 'description', 'cost', 'stock', 'points'])

@php
   $id = Str::slug($title);
@endphp

<div class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg">
   <div class="space-y-4">
      <div class="flex justify-between items-center">
         <h2 class="text-xl font-semibold text-zinc-800 dark:text-white" id="rewardTitle-{{ $id }}">
            {{ $title }}</h2>

         <!-- Botón Editar -->
         <button class="edit-button px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none"
            data-modal-id="modal-{{ $id }}">
            Editar
         </button>
      </div>

      <p class="text-sm text-zinc-600 dark:text-zinc-300" id="rewardDescription-{{ $id }}">{{ $description }}
      </p>
   </div>

   <div class="flex justify-between items-center">
      <div class="flex flex-row text-green-600 dark:text-green-400">
         <flux:icon.trophy class="me-1" />
         <span class="text-lg font-bold" id="rewardCost-{{ $id }}">
            {{ $cost . ' ' . __('reward-card.points') }}
         </span>
      </div>
      <span class="text-sm text-zinc-500 dark:text-zinc-400" id="rewardStock-{{ $id }}">
         {{ $stock > 0 ? $stock . ' ' . __('reward-card.stock') : __('reward-card.out_of_stock') }}
      </span>
   </div>

   <flux:text>Progreso</flux:text>
   <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
      <div class="bg-blue-600 h-4 rounded-full" style="width: {{ min(($points / $cost) * 100, 100) }}%;"></div>
   </div>
</div>

<!-- Modal específico -->
<div id="modal-{{ $id }}"
   class="modal hidden fixed inset-0 flex items-center justify-center bg-[rgba(0,0,0,0.5)] z-50">
   <div class="bg-white p-6 rounded-lg space-y-6 w-11/12 max-w-lg shadow-xl" @click.stop>
      <h2 class="text-2xl font-bold text-gray-800">Editar {{ $title }}</h2>
      <form id="editForm-{{ $id }}">
         <!-- Nombre -->
         <label class="block text-sm font-medium text-gray-600">Nombre del premio</label>
         <input type="text" id="rewardName-{{ $id }}" value="{{ $title }}"
            class="border p-3 w-full rounded-lg mb-4 text-black bg-white" />

         <!-- Stock -->
         <label class="block text-sm font-medium text-gray-600">Stock</label>
         <input type="number" id="rewardStock-{{ $id }}" value="{{ $stock }}"
            class="border p-3 w-full rounded-lg mb-4 text-black bg-white" />

         <!-- Puntos necesarios -->
         <label class="block text-sm font-medium text-gray-600">Puntos necesarios</label>
         <input type="number" id="rewardCost-{{ $id }}" value="{{ $cost }}"
            class="border p-3 w-full rounded-lg mb-4 text-black bg-white" />

         <!-- Botones -->
         <div class="flex justify-end gap-3">
            <button type="button"
               class="close-modal bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow"
               data-modal-id="modal-{{ $id }}">Cancelar</button>
            <button type="submit"
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow">Guardar</button>
         </div>
      </form>
   </div>
</div>

<!-- Script -->
<script>
   document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.edit-button').forEach(button => {
         button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.remove('hidden');
         });
      });

      document.querySelectorAll('.close-modal').forEach(button => {
         button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.add('hidden');
         });
      });

      document.querySelectorAll('.modal').forEach(modal => {
         modal.addEventListener('click', (e) => {
            if (e.target === modal) {
               modal.classList.add('hidden');
            }
         });
      });

      // Guardar cambios
      document.querySelectorAll('#editForm-{{ $id }}').forEach(form => {
         form.addEventListener('submit', (e) => {
            e.preventDefault(); // Evitar recargar la página

            // Obtener los nuevos valores de los campos
            const newName = document.getElementById('rewardName-{{ $id }}').value;
            const newStock = document.getElementById('rewardStock-{{ $id }}').value;
            const newCost = document.getElementById('rewardCost-{{ $id }}').value;

            // Actualizar la interfaz con los nuevos valores
            document.getElementById('rewardTitle-{{ $id }}').textContent = newName;
            document.getElementById('rewardDescription-{{ $id }}').textContent =
               "Descripción actualizada"; // Puedes actualizar con tu texto real
            document.getElementById('rewardCost-{{ $id }}').textContent = newCost + ' ' +
               __('reward-card.points');
            document.getElementById('rewardStock-{{ $id }}').textContent = newStock + ' ' +
               __('reward-card.stock');

            // Cerrar el modal
            const modal = document.getElementById('modal-{{ $id }}');
            if (modal) modal.classList.add('hidden');
         });
      });
   });
</script>
