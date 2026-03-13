<x-layouts.guest>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" class="mb-4" />

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label :value="__('Email')" for="email" />
            <x-text-input :value="old('email')" autofocus class="mt-1 block w-full" id="email" name="email" required
                type="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-end">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-layouts.guest>
