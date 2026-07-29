@props(['url', 'label', 'active' => false, 'color' => null])

<a href="{{ $url }}" {{ $attributes->merge(['class' => 'filter-pill ' . ($active ? 'filter-pill--active' : '')]) }}>
  @if($color)
    <span class="inline-block w-1.5 h-1.5 rounded-full shrink-0" style="background: {{ $color }}" aria-hidden="true"></span>
  @endif
  {{ $label }}
</a>
