<x-layouts.guest>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form action="{{ route('password.confirm') }}" method="POST">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label :value="__('Password')" for="password" />

            <x-text-input autocomplete="current-password" class="mt-1 block w-full" id="password" name="password" required
                type="password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4 flex justify-end">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-layouts.guest>
