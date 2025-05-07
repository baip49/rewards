<div class="flex flex-col gap-6">
    <x-auth-header :title="__('auth.login_to_account')" :description="__('auth.login_description')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('auth.email')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@unach.mx"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('auth.password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('auth.password')"
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    {{ __('auth.forgot_password') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('auth.remember_me')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('auth.login') }}</flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('auth.dont_have_account') }}
            <flux:link :href="route('register')" wire:navigate>{{ __('auth.register') }}</flux:link>
        </div>
    @endif
</div>
