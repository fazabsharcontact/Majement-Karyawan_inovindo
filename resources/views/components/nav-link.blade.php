@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center w-full px-4 py-2 rounded-lg bg-white text-black text-sm font-bold 
       shadow-md relative
       before:content-[""] before:absolute before:left-0 before:top-0 before:h-full before:w-1 before:bg-blue-600'
    : 'flex items-center w-full px-4 py-2 rounded-lg text-gray-800 
       hover:bg-white hover:text-black text-sm font-semibold transition relative';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>