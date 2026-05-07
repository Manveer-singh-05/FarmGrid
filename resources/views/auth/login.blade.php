<x-guest-layout>
    <div class="auth-card-title">Welcome Back</div>
    <div class="auth-card-subtitle">Sign in to manage your electricity distribution</div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="glassmorphic-label">{{ __('Email Address') }}</label>
            <input id="email" class="glassmorphic-input" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder="name@farmgrid.com" />
            <x-input-error :messages="$errors->get('email')" class="glassmorphic-error" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="glassmorphic-label">{{ __('Password') }}</label>
            <input id="password" class="glassmorphic-input" type="password" name="password" required
                autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="glassmorphic-error" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="form-footer">
            <div class="remember-section">
                <input id="remember_me" type="checkbox" class="glassmorphic-checkbox" name="remember">
                <label for="remember_me">{{ __('Remember me') }}</label>
            </div>
            @if (Route::has('password.request'))
                <a class="glassmorphic-link" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit" class="glassmorphic-button">
            {{ __('Sign In') }}
        </button>

        <!-- Sign Up Link -->
        <div class="form-link-section">
            <span class="form-link-text">
                {{ __('Don\'t have an account?') }}
                <a class="glassmorphic-link" href="{{ route('register') }}">
                    {{ __('Create one') }}
                </a>
            </span>
        </div>
    </form>
</x-guest-layout>