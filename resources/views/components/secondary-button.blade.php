<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn-glass btn-blue inline-flex items-center justify-center gap-2']) }}>
    {{ $slot }}
</button>