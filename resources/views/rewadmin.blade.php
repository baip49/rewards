<x-layouts.app :title="__('dashboard.rewadmin')">
   <div class="flex h-[calc(100vh-7vh)] bi-house-up-fill w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="relative h-full flex-1 overflow-y-scroll rounded-xl border border-neutral-200 dark:border-neutral-700">
         <div class="max-w-7xl mx-6 my-6 mx-auto">
            <flux:heading size="xl" class="text-center mb-4">
               Administrar premios
               <flux:text>
                  Aquí puedes administrar los premios disponibles para los usuarios.
               </flux:text>
            </flux:heading>

            <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-5 mb-6 mx-6 overflow-y-auto">
               <x-rewards.reward-card id="{{ __('reward-card.placeholder') }}" title="{{ __('reward-card.placeholder') }}"
                  description="{{ __('reward-card.placeholder-desc') }}" :cost="1" stock="0"
                  :points="0" type="add" />
               @foreach ($rewards as $reward)
                  <x-rewards.reward-card :reward="$reward" :id="$reward->id" :title="$reward->title" :description="$reward->description"
                     :cost="$reward->cost" :stock="$reward->stock" :image="$reward->image" :points="auth()->user()->points" type="editable" />
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
      showToast("{{ session('success') }}");
   @elseif (session('error'))
      showToast("{{ session('error') }}");
   @endif
</script>
