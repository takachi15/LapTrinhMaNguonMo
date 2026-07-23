@props(['type' => 'success', 'title' => 'Thông báo'])

@php
    $isSuccess = $type === 'success';
@endphp

<div class="alert-box {{ $isSuccess ? 'alert-success' : 'alert-warning' }}">
    <strong style="font-weight: 600;">{{ $title }}:</strong> 
    <span>{{ $slot }}</span>
</div>

<style>
    .alert-box {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 12px;
    }
    .alert-success {
        background: #ECFDF5;
        color: #065F46;
    }
    .alert-warning {
        background: #FEF3C7;
        color: #92400E;
    }
</style>