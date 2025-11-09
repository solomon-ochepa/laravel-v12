@props([
    'title' => null,
])
<div {{ $attributes->merge(['class' => 'toast-header']) }}>
    <strong class="me-auto">{{ __($title) }}</strong>
    {{ $slot }}
    <button aria-label="Close" class="btn-close" data-bs-dismiss="toast" type="button"></button>
</div>
