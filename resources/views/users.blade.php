<x-layouts.app :title="__('dashboard.rewards')">
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <div class="max-w-7xl mx-6 my-6 mx-auto">
            @can('isAdmin', App\Models\User::class)
               <flux:heading class="text-center my-3" size="xl">{{ __('users.heading') }}</flux:heading>

               <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 mb-6 mx-6">



                  @foreach ($users as $user)
                     <div
                        class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg mb-3">
                        <flux:heading size="xl">{{ $user->name }} <flux:text>{{ $user->role }}</flux:text>
                        </flux:heading>
                        <flux:text class="text-lg">{{ __('users.email') . ': ' . $user->email }}</flux:text>
                        <flux:text class="text-lg">{{ __('users.disponible_points') }}: <span
                              id="available-{{ $user->id }}">{{ $user->points }}</flux:text>
                        <flux:text class="text-lg">{{ __('users.spent_points') }}: <span
                              id="spent-{{ $user->id }}">{{ $user->spent_points }}</span></flux:text>

                        <button onclick="openModal({{ $user->id }})"
                           class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
                           {{ __('users.edit') }}
                        </button>
                     </div>

                     <!-- Modal -->
                     <!-- Modal -->
                     <div id="modal-{{ $user->id }}"
                        class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center">
                        <div
                           class="bg-zinc-600 dark:bg-zinc-900 border border-zinc-200 dark:border-white/20 p-6 rounded-xl space-y-6 shadow-lg mb-3 w-100">
                           <flux:fieldset class="space-y-3">
                              <flux:legend class="text-xl">{{ __('users.editing') . ' ' . $user->name }}</flux:legend>

                              <flux:field>
                                 <flux:label>{{ __('users.name') }}</flux:label>

                                 <flux:input wire:model="text" type="text" id="name-{{ $user->id }}"
                                    value="{{ $user->name }}" required />

                                 <flux:error name="name" />
                              </flux:field>

                              <flux:field>
                                 <flux:select label="{{ __('users.role') }}" id="role-{{ $user->id }}" required>
                                    <option value="Administrador" @if ($user->role === 'Administrador') selected @endif>
                                       {{ __('users.admin') }}
                                    </option>
                                    <option value="Alumno" @if ($user->role === 'Alumno') selected @endif>
                                       {{ __('users.student') }}
                                    </option>
                                 </flux:select>

                                 <flux:error name="role" />
                              </flux:field>

                              <flux:field>
                                 <flux:label>{{ __('users.disponible_points') }}</flux:label>

                                 <flux:input wire:model="number" type="number" id="points-{{ $user->id }}"
                                    value="{{ $user->points }}" required />

                                 <flux:error name="points" />
                              </flux:field>

                              <flux:field>
                                 <flux:label>{{ __('users.spent_points') }}</flux:label>

                                 <flux:input wire:model="number" type="number" id="points-{{ $user->id }}"
                                    value="{{ $user->spent_points }}" min="0" required />

                                 <flux:error name="spent-points" />
                              </flux:field>

                           </flux:fieldset>

                           <div class="mt-6 flex justify-end space-x-3">
                              <button onclick="closeModal({{ $user->id }})"
                                 class="px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
                                 Cerrar
                              </button>
                              <button onclick="updatePoints({{ $user->id }})"
                                 class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
                                 {{ __('users.save') }}
                              </button>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         @endcan
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
