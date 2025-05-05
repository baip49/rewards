@props(['reward' => null, 'id', 'title', 'description', 'cost', 'stock', 'image' => '', 'points', 'type' => 'reward'])

<div class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6 shadow-lg">
   <div class="space-y-4">
      <div class="flex justify-between items-center">
         <div class="flex gap-2 items-center">
            @if ($image)
               <div class="mask-radial-at-center mask-radial-from-100% bg-cover bg-center"
                  style="background-image: url('{{ asset('storage/' . $image) }}'); width: 50px; height: 50px; border-radius: 50%;">
               </div>
            @else
               <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                  <flux:icon.x-mark class="text-gray-500" />
               </div>
            @endif
            <flux:heading size="lg" class="text-2xl!" id="rewardTitle-{{ $id }}">
               {{ $title }}
            </flux:heading>
         </div>

         @if ($type === 'reward')
            @if ($stock > 0 && $points >= $cost)
               <button onclick="openModal('redeem-{{ $id }}')"
                  class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                  <flux:icon.shopping-cart />
                  {{ __('reward-card.redeem') }}
               </button>
            @elseif ($stock <= 0)
               <button
                  class="px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed opacity-50 flex items-center gap-2"
                  disabled>
                  <flux:icon.x-mark />
                  {{ __('reward-card.out_of_stock') }}
               </button>
            @else
               <button
                  class="px-4 py-2 bg-yellow-400 text-white rounded-lg cursor-not-allowed opacity-50 flex items-center gap-2"
                  disabled>
                  <flux:icon.exclamation-triangle />
                  {{ __('reward-card.not_enough_points') }}
               </button>
            @endif
         @elseif ($type === 'add')
            @can('create', App\Models\Reward::class)
               <button onclick="openModal('add-{{ $id }}')"
                  class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                  <flux:icon.plus />
                  {{ __('reward-card.add') }}
               </button>
            @endcan
         @elseif ($type === 'pin')
            <button onclick="openModal('pin-{{ $id }}')"
               class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
               <flux:icon.paper-clip />
               {{ __('reward-card.pin') }}
            </button>
         @elseif ($type === 'unpin')
            <div class="flex gap-2">
               @if ($stock > 0 && $points >= $cost)
                  <button onclick="openModal('redeem-{{ $id }}')"
                     class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                     <flux:icon.shopping-cart />
                     {{ __('reward-card.redeem') }}
                  </button>
               @elseif ($stock <= 0)
                  <button
                     class="px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed opacity-50 flex items-center gap-2"
                     disabled>
                     <flux:icon.x-mark />
                     {{ __('reward-card.out_of_stock') }}
                  </button>
               @else
                  <button
                     class="px-4 py-2 bg-yellow-400 text-white rounded-lg cursor-not-allowed opacity-50 flex items-center gap-2"
                     disabled>
                     <flux:icon.exclamation-triangle />
                     {{ __('reward-card.not_enough_points') }}
                  </button>
               @endif
               <button onclick="openModal('unpin-{{ $id }}')"
                  class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                  <flux:icon.archive-box-x-mark />
               </button>
            </div>
         @else
            <div class="flex gap-1">
               @can('update', $reward)
                  <button onclick="openModal('edit-{{ $id }}')"
                     class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
                     <flux:icon.pencil />
                     {{ __('reward-card.edit') }}
                  </button>
               @endcan
               @can('delete', $reward)
                  <button onclick="openModal('delete-{{ $id }}')"
                     class="p-2 bg-red-400 text-white rounded-lg hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
                     <flux:icon.trash />
                  </button>
               @endcan
            </div>
         @endif
      </div>

      <p class="text-sm text-zinc-600 dark:text-zinc-300">{{ $description }}</p>
   </div>

   <div class="flex justify-between items-center">
      <div class="flex flex-row text-green-600 dark:text-green-400">
         <flux:icon.trophy class="me-1" />
         <span class="text-lg font-bold">
            {{ $cost . ' ' . __('reward-card.points') }}
         </span>
      </div>
      <span class="text-sm text-zinc-500 dark:text-zinc-400">
         {{ $stock > 0 ? $stock . ' ' . __('reward-card.stock') : __('reward-card.out_of_stock') }}
      </span>
   </div>

   <flux:text>Progreso</flux:text>
   <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
      <div class="bg-blue-600 h-4 rounded-full" style="width: {{ min(($points / $cost) * 100, 100) }}%;"></div>
   </div>
</div>

{{-- Modal: Redeem Confirmation --}}
<div id="modal-redeem-{{ $id }}"
   class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center">
   <div
      class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/20 p-8 rounded-xl space-y-6 shadow-lg w-[500px] max-w-full">
      <flux:heading size="lg">{{ __('reward-card.redeem_confirmation') }}</flux:heading>
      <flux:text>{{ __('reward-card.redeem_description', ['title' => $title]) }}</flux:text>
      <div class="flex justify-end gap-3">
         <button type="button" onclick="closeModal('redeem-{{ $id }}')"
            class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
            {{ __('reward-card.cancel') }}
         </button>
         <form action="{{ route('rewards.redeem', $id) }}" method="POST">
            @csrf
            <button type="submit"
               class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
               {{ __('reward-card.confirm') }}
            </button>
         </form>
      </div>
   </div>
</div>

{{-- Modal: Pin Reward --}}
<div id="modal-pin-{{ $id }}" class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center">
   <div
      class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/20 p-8 rounded-xl space-y-6 shadow-lg w-[500px] max-w-full">
      <flux:heading size="lg">{{ __('reward-card.pin_confirmation') }}</flux:heading>
      <flux:text>{{ __('reward-card.pin_description', ['title' => $title]) }}</flux:text>
      <div class="flex justify-end gap-3">
         <button type="button" onclick="closeModal('pin-{{ $id }}')"
            class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
            {{ __('reward-card.cancel') }}
         </button>
         <form action="{{ route('rewards.pin', $id) }}" method="POST">
            @csrf
            <button type="submit"
               class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
               {{ __('reward-card.confirm') }}
            </button>
         </form>
      </div>
   </div>
</div>

{{-- Modal: Unpin Reward --}}
<div id="modal-unpin-{{ $id }}"
   class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center">
   <div
      class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/20 p-8 rounded-xl space-y-6 shadow-lg w-[500px] max-w-full">
      <flux:heading size="lg">{{ __('reward-card.unpin_confirmation') }}</flux:heading>
      <flux:text>{{ __('reward-card.unpin_description', ['title' => $title]) }}</flux:text>
      <div class="flex justify-end gap-3">
         <button type="button" onclick="closeModal('unpin-{{ $id }}')"
            class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
            {{ __('reward-card.cancel') }}
         </button>
         <form action="{{ route('rewards.unpin', $id) }}" method="POST">
            @csrf
            <button type="submit"
               class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
               {{ __('reward-card.confirm') }}
            </button>
         </form>
      </div>
   </div>
</div>

{{-- Modal: Add Reward --}}
<div id="modal-add-{{ $id }}" class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center">
   <div
      class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/20 p-8 rounded-xl space-y-6 shadow-lg min-w-[65%] min-h-auto">
      <flux:heading size="lg">{{ __('reward-card.add', ['title' => $title]) }}</flux:heading>
      <form action="{{ route('admin.rewards.add', $id) }}" method="POST" enctype="multipart/form-data"
         class="space-y-4">
         @csrf
         @method('POST')
         <flux:field>
            <flux:label>{{ __('reward-card.title') }}</flux:label>
            <flux:input type="text" name="title" value="{{ $title }}" />
         </flux:field>
         <flux:field>
            <flux:label>{{ __('reward-card.description') }}</flux:label>
            <flux:textarea name="description">{{ $description }}</flux:textarea>
         </flux:field>
         <flux:field>
            <flux:label>{{ __('reward-card.cost') }}</flux:label>
            <flux:input type="number" name="cost" value="{{ $cost }}" min="0" />
         </flux:field>
         <flux:field>
            <flux:label>{{ __('reward-card.stock') }}</flux:label>
            <flux:input type="number" name="stock" value="{{ $stock }}" min="0" />
         </flux:field>
         <flux:field>
            <flux:label>{{ __('reward-card.image') }}</flux:label>
            <flux:input type="file" name="image" />
         </flux:field>
         <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal('add-{{ $id }}')"
               class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
               {{ __('reward-card.cancel') }}
            </button>
            <button type="submit"
               class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
               {{ __('reward-card.save') }}
            </button>
         </div>
      </form>
   </div>
</div>


{{-- Modal: Edit Reward --}}
<div id="modal-edit-{{ $id }}"
   class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center">
   <div
      class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/20 p-8 rounded-xl space-y-6 shadow-lg min-w-[65%] min-h-auto">
      <flux:heading size="lg">{{ __('reward-card.editing', ['title' => $title]) }}</flux:heading>
      <form action="{{ route('admin.rewards.update', $id) }}" method="POST" enctype="multipart/form-data"
         class="space-y-4">
         @csrf
         @method('PUT')
         <flux:field>
            <flux:label>{{ __('reward-card.title') }}</flux:label>
            <flux:input type="text" name="title" value="{{ $title }}" />
         </flux:field>
         <flux:field>
            <flux:label>{{ __('reward-card.description') }}</flux:label>
            <flux:textarea name="description">{{ $description }}</flux:textarea>
         </flux:field>
         <flux:field>
            <flux:label>{{ __('reward-card.cost') }}</flux:label>
            <flux:input type="number" name="cost" value="{{ $cost }}" min="0" />
         </flux:field>
         <flux:field>
            <flux:label>{{ __('reward-card.stock') }}</flux:label>
            <flux:input type="number" name="stock" value="{{ $stock }}" min="0" />
         </flux:field>
         <flux:field>
            <flux:label>{{ __('reward-card.image') }}</flux:label>
            <flux:input type="file" name="image" />
         </flux:field>
         <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal('edit-{{ $id }}')"
               class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
               {{ __('reward-card.cancel') }}
            </button>
            <button type="submit"
               class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer flex items-center gap-2">
               {{ __('reward-card.save') }}
            </button>
         </div>
      </form>
   </div>
</div>

{{-- Modal: Delete Confirmation --}}
<div id="modal-delete-{{ $id }}"
   class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center">
   <div
      class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/20 p-8 rounded-xl space-y-6 shadow-lg w-[500px] max-w-full">
      <flux:heading size="lg">{{ __('reward-card.delete_confirmation') }}</flux:heading>
      <flux:text>{{ __('reward-card.delete_description', ['title' => $title]) }}</flux:text>
      <div class="flex justify-end gap-3">
         <button type="button" onclick="closeModal('delete-{{ $id }}')"
            class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
            {{ __('reward-card.cancel') }}
         </button>
         <form action="{{ route('admin.rewards.delete', $id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
               class="px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 duration-100 ease-in-out hover:shadow-xl cursor-pointer">
               {{ __('reward-card.confirm') }}
            </button>
         </form>
      </div>
   </div>
</div>

<script>
   function openModal(modalId) {
      document.getElementById('modal-' + modalId).classList.remove('hidden');
   }

   function closeModal(modalId) {
      document.getElementById('modal-' + modalId).classList.add('hidden');
   }
</script>
