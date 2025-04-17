<x-layouts.app :title="__('dashboard.rewards')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="max-w-7xl mx-6 my-6">
                <flux:heading class="text-center my-3" size="xl">{{__('users.heading')}}</flux:heading>

                <div class="grid grid-cols-3 gap-4">
                    @foreach($users as $user)
                        <div class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg mb-3">
                            <flux:heading size="xl">{{ $user->name }} <flux:text>{{ $user->role }}</flux:text></flux:heading>
                            <flux:text class="text-lg">{{ $user->email }}</flux:text>
                            <flux:text class="text-lg">{{ __('users.disponible_points') }}: <span id="available-{{ $user->id }}">{{ $user->points }}</span></flux:text>
                            <flux:text class="text-lg">{{ __('users.points_used') }}: <span id="spent-{{ $user->id }}">{{ $user->spent_points }}</span></flux:text>

                            <button onclick="openModal({{ $user->id }})"
                                class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                                {{ __('users.look') }}
                            </button>
                        </div>

                        <!-- Modal -->
                        <!-- Modal -->
<div id="modal-{{ $user->id }}" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-50 flex items-center justify-center">
    <div class="bg-black p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-xl font-bold mb-4 text-white">Editar {{ $user->name }}</h2>
        <div class="space-y-3 text-white">
            <div>
                <label class="block mb-1 font-semibold">Nombre:</label>
                <input type="text" id="name-{{ $user->id }}" value="{{ $user->name }}"
                    class="bg-gray-800 text-white px-2 py-1 rounded w-full">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Rol:</label>
                <select id="role-{{ $user->id }}" class="bg-gray-800 text-white px-2 py-1 rounded w-full">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="alumno" {{ $user->role == 'alumno' ? 'selected' : '' }}>Alumno</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Foto de perfil:</label>
                <input type="file" id="photo-{{ $user->id }}"
                    class="bg-gray-800 text-white px-2 py-1 rounded w-full">
            </div>

            <div class="flex justify-between items-center">
                <span><strong>Puntos disponibles:</strong></span>
                <input type="number" id="points-{{ $user->id }}" value="{{ $user->points }}"
                    class="bg-gray-800 text-white px-2 py-1 rounded w-20 text-right">
            </div>

            <div class="flex justify-between items-center">
                <span><strong>Puntos usados:</strong></span>
                <input type="number" id="spent-points-{{ $user->id }}" value="{{ $user->spent_points }}"
                    class="bg-gray-800 text-white px-2 py-1 rounded w-20 text-right">
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <button onclick="closeModal({{ $user->id }})"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Cerrar
            </button>
            <button onclick="updatePoints({{ $user->id }})"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Guardar
            </button>
        </div>
    </div>
</div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<script>
    function openModal(userId) {
        document.getElementById('modal-' + userId).classList.remove('hidden');
    }

    function closeModal(userId) {
        document.getElementById('modal-' + userId).classList.add('hidden');
    }
    
    function updatePoints(userId) {
        const formData = new FormData();
        formData.append('points', document.getElementById('points-' + userId).value);
        formData.append('spent_points', document.getElementById('spent-points-' + userId).value);
        formData.append('name', document.getElementById('name-' + userId).value);
        formData.append('role', document.getElementById('role-' + userId).value);

        const photoInput = document.getElementById('photo-' + userId);
        if (photoInput.files.length > 0) {
            formData.append('profile_photo_url', photoInput.files[0]);
        }

        fetch(`/users/${userId}/update-points`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById('available-' + userId).textContent = formData.get('points');
                document.getElementById('spent-' + userId).textContent = formData.get('spent_points');
                closeModal(userId);
            } else {
                alert('Error al actualizar los datos');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al actualizar');
        });
    }
</script>
