@props(['url', 'label', 'active' => false])

@php
  $baseClasses = 'px-4 py-1.5 rounded-full border text-sm transition';
  $activeClasses = 'bg-blue-600 border-blue-600 text-white';
  $inactiveClasses = 'bg-white border-gray-200 text-gray-700 hover:border-gray-400';
  $classes = $baseClasses . ' ' . ($active ? $activeClasses : $inactiveClasses);
@endphp

<a href="{{ $url }}" {{ $attributes->merge(['class' => $classes]) }}>
  {{ $label }}
</a>
