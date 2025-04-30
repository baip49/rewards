<x-layouts.app :title="__('dashboard.rewards')">
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl mx-auto">
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
         <x-rewards.summary 
         name="{{ auth()->user()->name }}" 
         role="{{ auth()->user()->role }}"
         points="{{ auth()->user()->points }}" 
         spent_points="{{ auth()->user()->spent_points }}" 
         />
         <div class="max-w-7xl mx-auto">
            <div class="text-center mb-6">
               <flux:heading size="xl">{{ __('rewards.heading') }}</flux:heading>
               <flux:text>{{ __('rewards.text') }}</flux:text>
            </div>

            <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 mb-6 mx-6">
               @foreach ($rewards as $reward)
               <x-rewards.reward-card 
                  :id="$reward->id"
                  :title="$reward->title"
                  :description="$reward->description"
                  :cost="$reward->cost"
                  :stock="$reward->stock"
                  :image="$reward->image"
                  :points="auth()->user()->points"
               />
            @endforeach
            </div>
         </div>
      </div>
   </div>
</x-layouts.app>

@if (session('success') || session('error'))
   <script>
      const toast = document.getElementById('toast');
      const toastMessage = document.getElementById('toast-message');
      const toastIcon = document.getElementById('toast-icon');
      toast.classList.remove('hidden');
      toast.classList.add('{{ session('success') ? 'bg-green-500' : 'bg-red-500' }}');

      toastMessage.innerText = "{{ session('success') ?? session('error') }}";
      toastIcon.innerHTML = "{{ session('success') ? '✅' : '❌' }}";

      setTimeout(() => {
         toast.classList.add('hidden');
      }, 3000);
   </script>
@endif

<div id="toast" class="hidden fixed bottom-10 right-10 px-4 py-3 rounded-lg text-white flex items-center space-x-2 shadow-lg z-50">
   <span id="toast-icon"></span>
   <p id="toast-message"></p>
</div>
