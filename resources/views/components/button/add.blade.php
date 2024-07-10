@props([
'route'
])

<x-button {{ $attributes->class(['btn btn-outline-success']) }} route="{{ $route }}">
    <x-icon.plus />
    {{ $slot }}
</x-button>