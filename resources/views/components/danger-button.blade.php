<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-glass inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-400 hover:to-rose-400']) }}>
    {{ $slot }}
</button>