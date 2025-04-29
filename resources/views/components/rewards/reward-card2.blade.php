@props(['id', 'title', 'description', 'cost', 'stock', 'points'])

<div class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg mb-3">

    <!-- Botón Editar -->
    <button 
        onclick="openEditModal({{ $id }})"
        class="edit-button px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none"
    >
        Editar
    </button>

    <flux:heading size="lg" id="rewardTitle-{{ $id }}">
        {{ $title }}
    </flux:heading>

    <p class="text-sm text-zinc-600 dark:text-zinc-300" id="rewardDescription-{{ $id }}">
        {{ $description }}
    </p>

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

<!-- Modal de edición (oculto por defecto) -->
<dialog id="editModal-{{ $id }}" class="modal bg-white dark:bg-zinc-900 p-6 rounded-xl max-w-md w-full">
    <form method="POST" action="{{ route('rewards.update', $id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <h2 class="text-xl font-semibold mb-2">Editar Premio</h2>

        <input type="hidden" name="id" value="{{ $id }}">

        <div>
            <label for="title-{{ $id }}">Título</label>
            <input id="modalTitle-{{ $id }}" type="text" name="title" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label for="description-{{ $id }}">Descripción</label>
            <textarea id="modalDescription-{{ $id }}" name="description" class="w-full p-2 border rounded" required></textarea>
        </div>

        <div>
            <label for="cost-{{ $id }}">Costo</label>
            <input id="modalCost-{{ $id }}" type="number" name="cost" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label for="stock-{{ $id }}">Stock</label>
            <input id="modalStock-{{ $id }}" type="number" name="stock" class="w-full p-2 border rounded" required>
        </div>

        <div class="flex justify-between gap-2 mt-4">
            <button type="button" onclick="document.getElementById('editModal-{{ $id }}').close()" class="px-3 py-1 bg-gray-400 rounded">Cancelar</button>
            <button type="submit" class="px-3 py-1 bg-green-700 text-white rounded">Guardar</button>
            <form method="POST" action="{{ route('rewards.destroy', $id) }}" onsubmit="return confirm('¿Estás seguro de eliminar este premio?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1 bg-red-700 text-white rounded">Eliminar</button>
            </form>
        </div>
    </form>
</dialog>

<!-- Script de apertura del modal -->
<script>
    function openEditModal(id) {
        const modal = document.getElementById(`editModal-${id}`);
        document.getElementById(`modalTitle-${id}`).value = document.getElementById(`rewardTitle-${id}`).innerText.trim();
        document.getElementById(`modalDescription-${id}`).value = document.getElementById(`rewardDescription-${id}`).innerText.trim();
        document.getElementById(`modalCost-${id}`).value = parseInt(document.getElementById(`rewardCost-${id}`).innerText);
        const stockText = document.getElementById(`rewardStock-${id}`).innerText;
        const stockMatch = stockText.match(/\d+/);
        document.getElementById(`modalStock-${id}`).value = stockMatch ? parseInt(stockMatch[0]) : 0;
        modal.showModal();
    }
</script>