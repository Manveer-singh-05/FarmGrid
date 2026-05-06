<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-glass btn-green inline-flex items-center justify-center gap-2']) }}>
    {{ $slot }}
</button>