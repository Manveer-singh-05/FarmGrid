<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="glassmorphic-label block mb-2">{{ __('Email Address') }}</label>
            <input id="email" class="glassmorphic-input block w-full" type="email" name="email"
                :value="old('email', $request->email)" required autofocus autocomplete="username"
                placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('email')" class="glassmorphic-error" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="glassmorphic-label block mb-2">{{ __('New Password') }}</label>
            <input id="password" class="glassmorphic-input block w-full" type="password" name="password" required
                autocomplete="new-password" placeholder="Create a new password" />
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

        <button type="submit" class="glassmorphic-button w-full justify-center text-center">
            {{ __('Reset Password') }}
        </button>
    </form>
</x-guest-layout>