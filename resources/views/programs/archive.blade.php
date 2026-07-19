{{--
  Programs List View
  Routes:
    /programming/juniors/         (no pre-selected type)
    /programming/juniors/{type}/  (type pre-selected from URL)
    /programming/adults/          (no pre-selected type)
    /programming/adults/{type}/   (type pre-selected from URL)

  Variables injected by App\View\Composers\ProgramsComposer:
    $audience         string   'juniors' | 'adults'
    $season           string   Active season value
    $programs         array    View-ready program arrays
    $activeFilters    array    All active filters (includes route type if set)
    $userFilters      array    Only query-param filters (excludes route type)
    $seasons          array    [{value, label, session}, ...]
    $levels           array    [{value, label, color}, ...]
    $types            array    [{value, label}, ...]
    $mailers          array    [{label, url}, ...]
    $routeType        ?string  Type value from URL segment, or null
    $routeTypeLabel   ?string  Human label for the route type, or null
    $audienceBaseUrl  string   e.g. 'https://example.com/programming/juniors/'
--}}

@extends('layouts.app')

@section('content')
  @php
    $audienceLabel = $audience === 'adults' ? 'Adults' : 'Juniors';

    // Helper: build a URL with updated query params, preserving existing user filters.
    $filterUrl = function(string $param, string $value) use ($userFilters) {
        $params = $userFilters;
        if ($value === '') {
            unset($params[$param]);
        } else {
            $params[$param] = $value;
        }
        return '?' . http_build_query($params);
    };

    // "Clear filters" target: type URL (if route-based) or bare '?'
    $clearUrl = $routeType
        ? rtrim($audienceBaseUrl, '/') . '/' . $routeType . '/'
        : '?';
  @endphp

  {{-- ── Breadcrumb ── --}}
  <nav class="flex items-center gap-2 text-xs text-slate-400 mb-4 px-1 animate__animated animate__fadeIn" aria-label="Breadcrumb">
    <a href="{{ home_url('/programming/') }}" class="hover:text-blue-500 transition-colors no-underline">
      Programming
    </a>
    <span aria-hidden="true">/</span>
    <a href="{{ $audienceBaseUrl }}" class="hover:text-blue-500 transition-colors no-underline">
      {{ $audienceLabel }}
    </a>
    @if($routeTypeLabel)
      <span aria-hidden="true">/</span>
      <span class="text-slate-600 font-medium">{{ $routeTypeLabel }}</span>
    @endif
  </nav>

  {{-- ── FILTER BAR ── --}}
  <div class="bg-white border-b border-stone-200 sticky top-0 z-10 shadow-sm">
    <div class="max-w-4xl mx-auto px-8 py-3 flex flex-wrap items-center gap-x-6 gap-y-3">

      {{-- Type — navigates via URL segments when type comes from the route --}}
      <div class="flex items-center gap-2">
        <span class="font-mono text-[10px] tracking-[2px] uppercase text-stone-400 shrink-0">Type:</span>
        <div class="flex flex-wrap gap-1.5">
          @foreach($types as $type)
            @php
              $typeIsActive = $routeType === $type['value']
                           || (!$routeType && ($activeFilters['type'] ?? '') === $type['value']);
              // When type comes from the URL, each pill is a sibling type URL,
              // preserving level/season as query params.
              $typeHref = $routeType !== null
                ? rtrim($audienceBaseUrl, '/') . '/' . $type['value'] . '/'
                    . (count($userFilters) ? '?' . http_build_query($userFilters) : '')
                : $filterUrl('type', $type['value']);
            @endphp
            <a href="{{ $typeHref }}"
               class="filter-pill {{ $typeIsActive ? 'filter-pill--active' : '' }}">
              {{ $type['label'] }}
            </a>
          @endforeach
        </div>
      </div>

      {{-- Level --}}
      <div class="flex items-center gap-2">
        <span class="font-mono text-[10px] tracking-[2px] uppercase text-stone-400 shrink-0">Level:</span>
        <div class="flex flex-wrap gap-1.5">
          <a href="{{ $filterUrl('level', '') }}"
             class="filter-pill {{ empty($userFilters['level']) ? 'filter-pill--active' : '' }}">
            All
          </a>
          @foreach($levels as $level)
            <a href="{{ $filterUrl('level', $level['value']) }}"
               class="filter-pill {{ ($userFilters['level'] ?? '') === $level['value'] ? 'filter-pill--active' : '' }}"
               style="--pill-color: {{ $level['color'] }}">
              <span class="inline-block w-1.5 h-1.5 rounded-full shrink-0"
                    style="background: {{ $level['color'] }}" aria-hidden="true"></span>
              {{ $level['label'] }}
            </a>
          @endforeach
        </div>
      </div>

      {{-- Clear user-applied filters --}}
      @if(count($userFilters) > 0)
        <a href="{{ $clearUrl }}"
           class="ml-auto font-mono text-[11px] text-stone-400 hover:text-court-clay transition-colors no-underline whitespace-nowrap">
          ✕ Clear filters
        </a>
      @endif
    </div>
  </div>

  {{-- ── PROGRAMS ── --}}
  <main class="max-w-4xl mx-auto px-8 mt-8 mb-16 animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
    @if(empty($programs))
      <div class="text-center py-24">
        <p class="font-display text-3xl text-stone-300 mb-2">No programs found</p>
        <p class="text-stone-400 text-sm">
          Try adjusting your filters, or
          <a href="{{ $clearUrl }}" class="text-court-clay hover:underline">clear all filters</a>.
        </p>
      </div>
    @else
      <div class="flex flex-col gap-4">
        @foreach($programs as $program)
          @include('components.program-card', [
              'program' => $program,
              'accent'  => $accents[$program['code']] ?? null,
            ])
        @endforeach
      </div>
    @endif
  </main>

@endsection
