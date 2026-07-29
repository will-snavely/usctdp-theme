{{--
  Component: filter-bar
  Shared sticky filter-pill bar used by the Programs archive and the
  WooCommerce product archive, so both pages look and behave identically.

  $groups        array  [{label, param, options: [{value, label, color?}, ...]}, ...]
  $activeFilters array  [param => value, ...] currently-active filters
  $filterUrl     Closure(string $param, string $value): string — toggles the pill
  $clearUrl      string  URL with all filters cleared
--}}

@props(['groups', 'activeFilters', 'filterUrl', 'clearUrl'])

<div class="bg-white border-b border-stone-200 sticky top-0 z-10 shadow-sm">
  <div class="max-w-4xl mx-auto px-2 sm:px-8 py-3 flex flex-col gap-2">
    @foreach($groups as $group)
      <div class="flex items-center gap-3">
        <span class="font-mono text-xs tracking-[2px] uppercase text-stone-600 shrink-0 w-20 text-right">{{ $group['label'] }}:</span>
        <div class="flex flex-wrap gap-1.5">
          @foreach($group['options'] as $option)
            <x-filter-pill
              :url="$filterUrl($group['param'], $option['value'])"
              :label="$option['label']"
              :color="$option['color'] ?? null"
              :active="($activeFilters[$group['param']] ?? '') === $option['value']" />
          @endforeach
        </div>
      </div>
    @endforeach

    @if(count($activeFilters) > 0)
      <a href="{{ $clearUrl }}"
         class="self-end font-mono text-[11px] text-stone-400 hover:text-court-clay transition-colors no-underline whitespace-nowrap">
        ✕ Clear filters
      </a>
    @endif
  </div>
</div>
