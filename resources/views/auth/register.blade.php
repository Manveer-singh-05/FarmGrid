<x-guest-layout>
    <div class="auth-card-title">Create Account</div>
    <div class="auth-card-subtitle">Join thousands of farmers managing electricity efficiently</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="glassmorphic-label">{{ __('Full Name') }}</label>
            <input id="name" class="glassmorphic-input" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" placeholder="John Farmer" />
            <x-input-error :messages="$errors->get('name')" class="glassmorphic-error" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="glassmorphic-label">{{ __('Email Address') }}</label>
            <input id="email" class="glassmorphic-input" type="email" name="email" :value="old('email')" required
                autocomplete="username" placeholder="name@farmgrid.com" />
            <x-input-error :messages="$errors->get('email')" class="glassmorphic-error" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="glassmorphic-label">{{ __('Password') }}</label>
            <input id="password" class="glassmorphic-input" type="password" name="password" required
                autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="glassmorphic-error" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="glassmorphic-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="glassmorphic-input" type="password" name="password_confirmation"
                required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="glassmorphic-error" />
        </div>

        <!-- Create Account Button -->
        <button type="submit" class="glassmorphic-button">
            {{ __('Create Account') }}
        </button>

        <!-- Sign In Link -->
        <div class="form-link-section">
            <span class="form-link-text">
                {{ __('Already have an account?') }}
                <a class="glassmorphic-link" href="{{ route('login') }}">
                    {{ __('Sign in') }}
                </a>
            </span>
        </div>
    </form>
</x-guest-layout>