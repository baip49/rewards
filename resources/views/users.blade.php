<x-layouts.app :title="__('dashboard.rewards')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="max-w-7xl mx-6 my-6">
                {{-- CARD --}}
                <div
                    class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 [:where(&)]:p-6 [:where(&)]:rounded-xl space-y-6 shadow-lg">
                    <flux:heading size="xl">{{ auth()->user()->name }}</flux:heading>
                    <flux:text>{{ auth()->user()->email }}</flux:text>
                    <button
                        class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                        {{ __('users.edit') }}
                    </button>
                </div>
            </div>
        </div>
</x-layouts.app>