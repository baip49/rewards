<x-layouts.app :title="__('dashboard.rewadmin')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="max-w-7xl mx-6 my-6 mx-auto">

                @can('isAdmin', App\Models\User::class)
                <flux:heading size="xl" class="text-center mb-4">
                    Administrar premios
                </flux:heading>

                <!-- Botón Crear Premio -->
                <div class="flex justify-center mb-6">
                    <button onclick="openCreateModal()" class="px-6 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
                        Crear Nuevo Premio
                    </button>
                </div>

                <!-- Modal de Crear Premio -->
                <dialog id="createModal" class="modal bg-white dark:bg-zinc-900 p-6 rounded-xl max-w-md w-full z-50">
                    <form method="POST" action="{{ route('rewards.store') }}" class="space-y-4">
                        @csrf
                        <h2 class="text-xl font-semibold mb-2">Crear Nuevo Premio</h2>

                        <div>
                            <label for="createTitle" class="block text-sm font-medium text-white">Título</label>
                            <input id="createTitle" name="title" type="text" required class="mt-1 block w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="createDescription" class="block text-sm font-medium text-white">Descripción</label>
                            <textarea id="createDescription" name="description" required class="mt-1 block w-full p-2 border rounded"></textarea>
                        </div>

                        <div>
                            <label for="createCost" class="block text-sm font-medium text-white">Costo</label>
                            <input id="createCost" name="cost" type="number" required class="mt-1 block w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="createStock" class="block text-sm font-medium text-white">Stock</label>
                            <input id="createStock" name="stock" type="number" required class="mt-1 block w-full p-2 border rounded" />
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <button type="button" onclick="document.getElementById('createModal').close()" class="px-3 py-1 bg-gray-400 rounded">Cancelar</button>
                            <button type="submit" class="px-3 py-1 bg-blue-700 text-white rounded">Crear</button>
                        </div>
                    </form>
                </dialog>

                <!-- Grid de premios -->
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
                @else
                    <div class="text-center text-red-600 text-xl mt-10">
                        No tienes permiso para ver esta sección.
                    </div>
                @endcan

            </div>
        </div>

        <!-- Toast Component -->
        <div id="toast" class="hidden fixed bottom-10 right-10 px-4 py-3 rounded-lg text-white flex items-center space-x-2 shadow-lg z-50">
            <span id="toast-icon">✔️</span>
            <p id="toast-message"></p>
        </div>
    </div>

    <!-- Script para abrir el modal y mostrar toast -->
    <script>
        function openCreateModal() {
            document.getElementById('createModal').showModal();
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const icon = document.getElementById('toast-icon');
            const msg = document.getElementById('toast-message');

            icon.textContent = type === 'success' ? '✔️' : '❌';
            msg.textContent = message;

            toast.classList.remove('hidden', 'bg-green-700', 'bg-red-700');
            toast.classList.add(type === 'success' ? 'bg-green-700' : 'bg-red-700');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 4000);
        }

        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @elseif(session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
    </script>
</x-layouts.app>
