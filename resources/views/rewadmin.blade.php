<x-layouts.app :title="__('dashboard.rewadmin')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="max-w-7xl mx-6 my-6 mx-auto">

                <flux:heading size="xl" class="text-center mb-4">
                    Administrar premios
                </flux:heading>

                {{-- Botón centrado para crear nuevo premio --}}
                <div class="flex justify-center mb-6">
                    <button 
                        onclick="openCreateModal()" 
                        class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800"
                    >
                        Crear nuevo premio
                    </button>
                </div>

                <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 mb-6 mx-6">
                    @foreach ($rewards as $reward)
                        <x-rewards.reward-card2 
                            :id="$reward->id"
                            :title="$reward->title"
                            :description="$reward->description"
                            :cost="$reward->cost"
                            :stock="$reward->stock"
                            :points="auth()->user()->points"
                        />
                    @endforeach
                </div>

                @if (session('success'))
                    <div class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-layouts.app>

{{-- Modal para crear un nuevo premio --}}
<dialog id="createModal" class="modal bg-white dark:bg-zinc-900 p-6 rounded-xl max-w-md w-full">
    <form method="POST" action="{{ route('rewards.store') }}" class="space-y-4">
        @csrf

        <h2 class="text-xl font-semibold mb-2">Crear nuevo premio</h2>

        <div>
            <label for="createTitle">Título</label>
            <input id="createTitle" type="text" name="title" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label for="createDescription">Descripción</label>
            <textarea id="createDescription" name="description" class="w-full p-2 border rounded" required></textarea>
        </div>

        <div>
            <label for="createCost">Costo</label>
            <input id="createCost" type="number" name="cost" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label for="createStock">Stock</label>
            <input id="createStock" type="number" name="stock" class="w-full p-2 border rounded" required>
        </div>

        <div class="flex justify-end gap-2 mt-4">
            <button type="button" onclick="document.getElementById('createModal').close()" class="px-3 py-1 bg-gray-400 rounded">Cancelar</button>
            <button type="submit" class="px-3 py-1 bg-blue-700 text-white rounded">Crear</button>
        </div>
    </form>
</dialog>

<script>
    function openCreateModal() {
        document.getElementById('createModal').showModal();
    }
</script>
