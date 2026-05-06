<x-guest-layout>
    <div class="mb-6 text-center text-white text-opacity-90">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div
            class="mb-6 p-4 bg-green-500 bg-opacity-20 border border-green-400 border-opacity-30 rounded-lg text-center text-green-100 text-sm">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-8 space-y-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
            <button type="submit" class="glassmorphic-button w-full justify-center text-center">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="glassmorphic-link w-full text-center py-2">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>