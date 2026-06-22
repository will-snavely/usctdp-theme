@props(['url', 'label', 'active' => false])

<a href="{{ $url }}" {{ $attributes->merge(['class' => 'filter-pill ' . ($active ? 'filter-pill--active' : '')]) }}>
  {{ $label }}
</a>
