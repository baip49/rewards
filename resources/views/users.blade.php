<x-layouts.app :title="__('dashboard.rewards')">
   <div class="flex h-[calc(100vh-7vh)] w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-y-scroll rounded-xl border border-neutral-200 dark:border-neutral-700">
         <div class="max-w-7xl mx-6 my-6 mx-auto">
            <flux:heading class="text-center my-3" size="xl">{{ __('users.heading') }}</flux:heading>

            <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 mb-6 mx-6">

               @foreach ($users as $user)
                  <div
                     class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg mb-3">
                     <flux:heading size="xl">
                        {{ $user->name }}
                        <flux:text>
                           {{ $user->role === 'admin' ? __('users.admin') : __('users.student') }}
                        </flux:text>
                     </flux:heading>
                     <flux:text class="text-lg">{{ __('users.email') . ': ' . $user->email }}</flux:text>
                     <flux:text class="text-lg">{{ __('users.disponible_points') }}: <span
                           id="available-{{ $user->id }}">{{ $user->points }}</flux:text>
                     <flux:text class="text-lg">{{ __('users.spent_points') }}: <span
                           id="spent-{{ $user->id }}">{{ $user->spent_points }}</span></flux:text>

                     @can('update', $user)
                        <button onclick="openModal({{ $user->id }})"
                           class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                           <flux:icon.pencil />
                           {{ __('users.edit') }}
                        </button>
                     @endcan
                  </div>

                  <!-- Modal -->
                  <div id="modal-{{ $user->id }}"
                     class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center">
                     <div
                        class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/20 p-8 rounded-xl space-y-6 shadow-lg mb-3 min-w-[65%] min-h-auto">
                        <flux:fieldset class="space-y-3">
                           <div class="flex justify-between items-center">
                              <flux:legend class="text-xl">{{ __('users.editing') . ' ' . $user->name }}</flux:legend>
                              <button onclick="closeModal({{ $user->id }})"
                                 class="p-2 bg-red-400 text-white rounded-lg hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
                                 <flux:icon.x-mark />
                              </button>
                           </div>
                           <form action="{{ route('admin.users.update', $user->id) }}" method="post"
                              class="space-y-3">
                              @csrf
                              @method('PUT')
                              <flux:field>
                                 <flux:label>{{ __('users.name') }}</flux:label>

                                 <flux:input wire:model="text" type="text" name="name"
                                    id="name-{{ $user->id }}" value="{{ $user->name }}" />

                                 <flux:error name="name" />
                              </flux:field>

                              <flux:field>
                                 <flux:select label="{{ __('users.role') }}" name="role"
                                    id="role-{{ $user->id }}">
                                    <option value="admin" @if ($user->isAdmin()) selected @endif>
                                       {{ __('users.admin') }}
                                    </option>
                                    <option value="alumno" @if (!$user->isAdmin()) selected @endif>
                                       {{ __('users.student') }}
                                    </option>
                                 </flux:select>
                              </flux:field>

                              <flux:field>
                                 <flux:label>{{ __('users.disponible_points') }}</flux:label>

                                 <flux:input wire:model="number" type="number" name="points"
                                    id="points-{{ $user->id }}" value="{{ $user->points }}" />

                                 <flux:error name="points" />
                              </flux:field>

                              <flux:field>
                                 <flux:label>{{ __('users.spent_points') }}</flux:label>

                                 <flux:input wire:model="number" type="number" name="spent_points"
                                    id="points-{{ $user->id }}" value="{{ $user->spent_points }}"
                                    min="0" />

                                 <flux:error name="spent-points" />
                              </flux:field>



                              <div class="mt-6 flex justify-end space-x-3">
                                 <button type="submit"
                                    class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                                    <flux:icon.check />
                                    {{ __('users.save') }}
                                 </button>
                              </div>
                           </form>
                        </flux:fieldset>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
         <div id="toast"
            class="fixed bottom-15 right-15 px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
            <span id="toast-icon"></span>
            <p id="toast-message"></p>
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
</script>

<script>
   function showToast(message, type = 'success') {
      const toast = document.getElementById('toast');
      const toastMessage = document.getElementById('toast-message');
      const toastIcon = document.getElementById('toast-icon');

      toastMessage.textContent = message;
      toast.classList.remove('bg-green-700', 'bg-red-700');
      toast.classList.add(type === 'success' ? 'bg-green-700' : 'bg-red-700');

      toastIcon.innerHTML = type === 'success' ?
         `<flux:icon.check-circle />` :
         `<flux:icon.x-circle" />`;

      setTimeout(() => {
         toast.classList.add('show');
      }, 500);
      setTimeout(() => {
         toast.classList.remove('show');
      }, 5000);
   }

   @if (session('success'))
      showToast("{{ session('success') }}", 'success');
   @elseif (session('error'))
      showToast("{{ session('error') }}", 'error');
   @endif
</script>
