<x-guest-layout>
    <script>
        console.log('Forgot Password Page Loaded');
        document.addEventListener('submit', function(e) {
            console.log('Submit event intercepted:', e.target.action);
        }, true);
    </script>
    <div class="mb-6 text-center text-white text-opacity-90">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" onsubmit="console.log('Form submitting to: ' + this.action); return true;" novalidate>
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="glassmorphic-label">{{ __('Email Address') }}</label>
            <input id="email" class="glassmorphic-input" type="email" name="email" value="{{ old('email') }}"
                required autofocus placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('email')" class="glassmorphic-error" />
        </div>

        <button type="submit" class="glassmorphic-button">
            {{ __('Send Password Reset Link') }}
        </button>

        <!-- Back to Login -->
        <div class="text-center">
            <a class="glassmorphic-link" href="{{ route('login') }}">
                {{ __('← Back to Login') }}
            </a>
        </div>
    </form>
</x-guest-layout>