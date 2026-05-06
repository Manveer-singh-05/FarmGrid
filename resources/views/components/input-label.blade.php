@props(['value'])

<label {{ $attributes->merge(['class' => 'glass-label']) }}>
    {{ $value ?? $slot }}
</label>