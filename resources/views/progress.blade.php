<x-layouts.app :title="__('dashboard.progress')">
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

         {{-- Resumen de recompensas --}}
         <x-rewards.summary 
            name="{{ auth()->user()->name }}" 
            role="{{ auth()->user()->role }}"
            points="{{ auth()->user()->points }}" 
            spent_points="{{ auth()->user()->spent_points }}" 
         />

         <div class="max-w-7xl mx-auto">
            <div class="text-center mb-6">
               <flux:heading size="xl">{{ __('progress.heading') }}</flux:heading>
               <flux:text>{{ __('progress.text') }}</flux:text>
            </div>

            <div class="grid grid-cols-1 gap-5 mb-6 mx-6">
               @if (auth()->user()->goalReward)
                  {{-- Recompensa meta actual --}}
                  <x-rewards.reward-card
                     id="{{ auth()->user()->goalReward->id }}"
                     title="{{ auth()->user()->goalReward->title }}"
                     description="{{ auth()->user()->goalReward->description }}"
                     cost="{{ auth()->user()->goalReward->cost }}"
                     stock="{{ auth()->user()->goalReward->stock }}"
                     points="{{ auth()->user()->points }}"
                  />
               @else
                  {{-- Mensaje cuando no hay recompensa meta --}}
                  <div class="p-6 rounded-lg shadow-lg text-center bg-white dark:bg-neutral-800">
                     <p class="text-xl mb-4 text-neutral-600 dark:text-neutral-300">
                        Oops, al parecer aún no tienes una recompensa meta, selecciona una.
                     </p>

                     {{-- Lista de recompensas disponibles --}}
                     <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($rewards as $reward)
                           <div class="relative bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-4 shadow-lg hover:shadow-xl transition">

                              {{-- Botón para fijar recompensa --}}
                              <button
                                 onclick="fixReward({{ $reward->id }})"
                                 class="absolute top-2 right-2 px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
                                 Fijar
                              </button>

                              {{-- Información de la recompensa --}}
                              <flux:heading size="xl">
                                 {{ $reward->title }}
                                 <flux:text class="text-sm text-neutral-500 dark:text-neutral-300 block">
                                    {{ __('Costo') . ': ' . $reward->cost . ' pts' }}
                                 </flux:text>
                              </flux:heading>

                              <flux:text class="text-lg text-neutral-700 dark:text-neutral-200">
                                 {{ $reward->description }}
                              </flux:text>

                              {{-- Formulario oculto para fijar recompensa --}}
                              <form 
                                 id="reward-{{ $reward->id }}" 
                                 method="POST" 
                                 action="{{ route('goal-reward.set') }}" 
                                 class="hidden">
                                 @csrf
                                 <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                              </form>
                           </div>
                        @endforeach
                     </div>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </div>

   {{-- Script para fijar recompensa --}}
   <script>
      function fixReward(id) {
         const form = document.getElementById(`reward-${id}`);
         if (form) {
            form.submit();
         }
      }
   </script>
</x-layouts.app>
