@props(['type' => 'submit', 'variant' => 'primary'])

@php
$classVariant = $variant === 'danger' ? 'btn-danger' : 'btn-primary';
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn-base ' . $classVariant]) }}>
    {{ $slot }}
</button>

<style>
    .btn-base {
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-primary {
        background: #2563EB;
    }

    .btn-danger {
        background: #DC2626;
    }
</style>