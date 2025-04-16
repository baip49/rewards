<x-layouts.app :title="__('dashboard.rewadmin')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="max-w-7xl mx-6 my-6">
                <flux:heading size="xl" class="text-center mb-4">Administrar premios</flux:heading>
                <div class="grid grid-cols-3 gap-5 mb-6 mx-6">
                    <x-rewards.reward-card2 title="Spotify" description="Tarjeta prepago de Spotify $200" cost="5000"
                        stock="10" points="{{ auth()->user()->points }}" />
                    <x-rewards.reward-card2 title="Netflix" description="Tarjeta prepago de Netflix $300" cost="7000"
                        stock="5" points="{{ auth()->user()->points }}" />
                    <x-rewards.reward-card2 title="Amazon" description="Tarjeta de regalo Amazon $500" cost="10000"
                        stock="0" points="{{ auth()->user()->points }}" />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
