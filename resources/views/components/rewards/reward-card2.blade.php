@props(['id', 'title', 'description', 'cost', 'stock', 'points'])

<div class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg">
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <flux:heading size="lg" class="text-2xl!" id="rewardTitle-{{ $id }}">
                {{ $title }}
            </flux:heading>

            @can('isAdmin', App\Models\User::class)
                <button onclick="openEditModal({{ $id }})" class="px-4 py-2 bg-green-700 text-white rounded-lg
                    hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100
                    ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                    <flux:icon.pencil />
                    {{ __('reward-card.edit') }}
                </button>
            @endcan
        </div>
        <p class="text-sm text-zinc-600 dark:text-zinc-300" id="rewardDescription-{{ $id }}">
            {{ $description }}
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

<!-- Modal de edición -->
<dialog id="editModal-{{ $id }}" class="modal bg-white dark:bg-zinc-900 p-6 rounded-xl max-w-md w-full">
    <form method="POST" action="{{ route('rewards.update', $id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <h2 class="text-xl font-semibold mb-2">Editar Premio</h2>

        <input type="hidden" name="id" value="{{ $id }}">

        <div>
            <label for="title-{{ $id }}">Título</label>
            <input id="modalTitle-{{ $id }}" type="text" name="title" class="w-full p-2 border rounded"
                required>
        </div>

        <div>
            <label for="description-{{ $id }}">Descripción</label>
            <textarea id="modalDescription-{{ $id }}" name="description" class="w-full p-2 border rounded" required></textarea>
        </div>

        <div>
            <label for="cost-{{ $id }}">Costo</label>
            <input id="modalCost-{{ $id }}" type="number" name="cost" class="w-full p-2 border rounded"
                required>
        </div>

        <div>
            <label for="stock-{{ $id }}">Stock</label>
            <input id="modalStock-{{ $id }}" type="number" name="stock" class="w-full p-2 border rounded"
                required>
        </div>

        <div class="flex justify-between gap-2 mt-4 flex-wrap">
            <button type="button" onclick="document.getElementById('editModal-{{ $id }}').close()"
                class="px-3 py-1 bg-gray-400 rounded">Cancelar</button>
            <button type="submit" class="px-3 py-1 bg-green-700 text-white rounded">Guardar</button>

            @can('isAdmin', Auth::user())
                <button type="button" onclick="confirmDelete({{ $id }})"
                    class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded">
                    Eliminar
                </button>
            @endcan
        </div>
    </form>

    <!-- Formulario para eliminación (fuera del form de edición) -->
    <form id="deleteForm-{{ $id }}" method="POST" action="{{ route('rewards.destroy', $id) }}"
        class="hidden">
        @csrf
        @method('DELETE')
    </form>
</dialog>

<!-- Toast -->
<div id="toast"
    class="hidden fixed bottom-5 right-5 px-4 py-2 bg-green-700 text-white rounded-lg shadow-lg z-50 flex items-center gap-2">
    <span id="toast-icon">✔️</span>
    <p id="toast-message" class="m-0"></p>
</div>

<!-- Script -->
<script>
    function openEditModal(id) {
        const modal = document.getElementById(`editModal-${id}`);
        document.getElementById(`modalTitle-${id}`).value = document.getElementById(`rewardTitle-${id}`).innerText
            .trim();
        document.getElementById(`modalDescription-${id}`).value = document.getElementById(`rewardDescription-${id}`)
            .innerText.trim();
        document.getElementById(`modalCost-${id}`).value = parseInt(document.getElementById(`rewardCost-${id}`)
            .innerText);
        const stockText = document.getElementById(`rewardStock-${id}`).innerText;
        const stockMatch = stockText.match(/\d+/);
        document.getElementById(`modalStock-${id}`).value = stockMatch ? parseInt(stockMatch[0]) : 0;
        modal.showModal();
    }

    function confirmDelete(id) {
        if (confirm("¿Estás seguro de eliminar este premio?")) {
            document.getElementById(`deleteForm-${id}`).submit();
        }
    }

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        const toastIcon = document.getElementById('toast-icon');

        toastMessage.textContent = message;
        toastIcon.textContent = type === 'success' ? '✔️' : '❌';

        toast.classList.remove('hidden', 'bg-red-700', 'bg-green-700');
        toast.classList.add(type === 'success' ? 'bg-green-700' : 'bg-red-700');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 4000);
    }

    @if (session('success'))
        showToast("{{ session('success') }}", 'success');
    @elseif (session('error'))
        showToast("{{ session('error') }}", 'error');
    @endif
</script>
