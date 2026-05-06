<x-guest-layout>
    <div class="mb-6 text-center text-white text-opacity-90">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="glassmorphic-label block mb-2">{{ __('Password') }}</label>
            <input id="password" class="glassmorphic-input block w-full" type="password" name="password" required
                autocomplete="current-password" placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="glassmorphic-error" />
        </div>

        <button type="submit" class="glassmorphic-button w-full justify-center text-center">
            {{ __('Confirm') }}
        </button>
    </form>
</x-guest-layout>