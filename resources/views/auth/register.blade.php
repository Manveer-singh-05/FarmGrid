<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="glassmorphic-label block mb-2">{{ __('Full Name') }}</label>
            <input id="name" class="glassmorphic-input block w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="glassmorphic-error" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="glassmorphic-label block mb-2">{{ __('Email Address') }}</label>
            <input id="email" class="glassmorphic-input block w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="glassmorphic-error" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="glassmorphic-label block mb-2">{{ __('Password') }}</label>
            <input id="password" class="glassmorphic-input block w-full" type="password" name="password" required
                autocomplete="new-password" placeholder="Create a password" />
            <x-input-error :messages="$errors->get('password')" class="glassmorphic-error" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation"
                class="glassmorphic-label block mb-2">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="glassmorphic-input block w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="glassmorphic-error" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="glassmorphic-button w-full justify-center text-center mt-8">
            {{ __('Create Account') }}
        </button>

        <!-- Login Link -->
        <div class="text-center pt-4 border-t border-white border-opacity-10">
            <span class="text-white text-opacity-80 text-sm">{{ __('Already have an account?') }}</span>
            <a class="glassmorphic-link ml-2" href="{{ route('login') }}">
                {{ __('Sign in') }}
            </a>
        </div>
    </form>
</x-guest-layout>