<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="glassmorphic-label block mb-2">{{ __('Email Address') }}</label>
            <input id="email" class="glassmorphic-input block w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="glassmorphic-error" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="glassmorphic-label block mb-2">{{ __('Password') }}</label>
            <input id="password" class="glassmorphic-input block w-full" type="password" name="password" required
                autocomplete="current-password" placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="glassmorphic-error" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-3">
            <input id="remember_me" type="checkbox" class="glassmorphic-checkbox rounded" name="remember">
            <label for="remember_me" class="text-sm text-white opacity-90 cursor-pointer">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Forgot Password & Login Button -->
        <div class="flex items-center justify-between pt-4">
            @if (Route::has('password.request'))
                <a class="glassmorphic-link" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @else
                <div></div>
            @endif

            <button type="submit" class="glassmorphic-button">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Sign Up Link -->
        <div class="text-center pt-4 border-t border-white border-opacity-10">
            <span class="text-white text-opacity-80 text-sm">{{ __('Don\'t have an account?') }}</span>
            <a class="glassmorphic-link ml-2" href="{{ route('register') }}">
                {{ __('Sign up') }}
            </a>
        </div>
    </form>
</x-guest-layout>