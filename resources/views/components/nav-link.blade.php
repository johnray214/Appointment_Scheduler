@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:text-orange-200 transition-colors duration-200'
: 'inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:text-orange-200 transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>