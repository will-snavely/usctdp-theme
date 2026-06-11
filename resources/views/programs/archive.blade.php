{{--
  Template Name: Programs Archive
  Shared template for /juniors/ and /adults/ routes.

  Variables injected by App\View\Composers\ProgramsComposer:
    $audience       string   'junior' | 'adult'
    $programs       array    View-ready program arrays
    $activeFilters  array    Currently active filter values keyed by param name
    $seasons        array    [{value, label, session}, ...]
    $levels         array    [{value, label, color}, ...]
    $types          array    [{value, label}, ...]
--}}

@extends('layouts.app')

@section('content')
  @php
    $audienceLabel = $audience === 'adults' ? 'Adult' : 'Junior';
    $audienceSlug  = $audience === 'adults' ? 'adults' : 'juniors';
    $oppositeLabel = $audience === 'adults' ? 'Junior Programs' : 'Adult Programs';
    $oppositeUrl   = $audience === 'adults' ? home_url('/programming/juniors/') : home_url('/programming/adults/');

    // Helper: build a URL with updated params, preserving existing ones
    $filterUrl = function(string $param, string $value) use ($activeFilters) {
        $params = $activeFilters;
        if ($value === '') {
            unset($params[$param]);
        } else {
            $params[$param] = $value;
        }
        return '?' . http_build_query($params);
    };
  @endphp
  {{-- ── FILTER BAR ── --}}
  <div class="bg-white border-b border-stone-200 sticky top-0 z-10 shadow-sm">
    <div class="max-w-4xl mx-auto px-8 py-3 flex flex-wrap items-center gap-x-6 gap-y-3">
      {{-- Season --}}
      <div class="flex items-center gap-2">
        <span class="font-mono text-[10px] tracking-[2px] uppercase text-stone-400 shrink-0">Season:</span>
        <div class="flex bg-stone-100 rounded-lg overflow-hidden border border-stone-200">
          <a href="{{ $filterUrl('season', '') }}"
             class="px-3 py-1.5 text-[12px] font-medium transition-colors no-underline
                    {{ empty($activeFilters['season']) ? 'bg-court-dark text-white' : 'text-stone-500 hover:text-stone-800' }}">
            All
          </a>
          @foreach($seasons as $season)
            <a href="{{ $filterUrl('season', $season['value']) }}"
               class="px-3 py-1.5 text-[12px] font-medium transition-colors no-underline
                      {{ ($activeFilters['season'] ?? '') === $season['value'] ? 'bg-court-dark text-white' : 'text-stone-500 hover:text-stone-800' }}">
              {{ $season['label'] }}
            </a>
          @endforeach
        </div>
      </div>

      {{-- Type --}}
      <div class="flex items-center gap-2">
        <span class="font-mono text-[10px] tracking-[2px] uppercase text-stone-400 shrink-0">Type:</span>
        <div class="flex flex-wrap gap-1.5">
          <a href="{{ $filterUrl('type', '') }}"
             class="filter-pill {{ empty($activeFilters['type']) ? 'filter-pill--active' : '' }}">
            All
          </a>
          @foreach($types as $type)
            <a href="{{ $filterUrl('type', $type['value']) }}"
               class="filter-pill {{ ($activeFilters['type'] ?? '') === $type['value'] ? 'filter-pill--active' : '' }}">
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
             class="filter-pill {{ empty($activeFilters['level']) ? 'filter-pill--active' : '' }}">
            All
          </a>
          @foreach($levels as $level)
            <a href="{{ $filterUrl('level', $level['value']) }}"
               class="filter-pill {{ ($activeFilters['level'] ?? '') === $level['value'] ? 'filter-pill--active' : '' }}"
               style="--pill-color: {{ $level['color'] }}">
              <span class="inline-block w-1.5 h-1.5 rounded-full shrink-0"
                    style="background: {{ $level['color'] }}" aria-hidden="true"></span>
              {{ $level['label'] }}
            </a>
          @endforeach
        </div>
      </div>

      {{-- Active filter summary + clear --}}
      @if(count($activeFilters) > 0)
        <a href="?" class="ml-auto font-mono text-[11px] text-stone-400 hover:text-court-clay transition-colors no-underline whitespace-nowrap">
          ✕ Clear filters
        </a>
      @endif

    </div>

    {{-- Session info bar (shown when a season is selected) --}}
    @if(! empty($activeFilters['season']))
      @php $activeSeason = collect($seasons)->firstWhere('value', $activeFilters['season']); @endphp
      <div class="border-t border-stone-100 bg-stone-50 px-8 py-1.5 max-w-full">
        <div class="max-w-4xl mx-auto">
          <p class="font-mono text-[11px] text-stone-400">
            <span class="text-court-clay font-semibold">{{ $activeSeason['label'] }} Session:</span>
            {{ $activeSeason['session'] }}
          </p>
        </div>
      </div>
    @endif
  </div>

  {{-- ── PROGRAMS ── --}}
  <main class="max-w-4xl mx-auto px-8 mt-8 mb-16">
    @if(empty($programs))
      <div class="text-center py-24">
        <p class="font-display text-3xl text-stone-300 mb-2">No programs found</p>
        <p class="text-stone-400 text-sm">
          Try adjusting your filters, or <a href="?" class="text-court-clay hover:underline">clear all filters</a>.
        </p>
      </div>
    @else
      <div class="flex flex-col gap-4">
        @foreach($programs as $program)
          @include('components.program-card', ['program' => $program])
        @endforeach
      </div>
    @endif
  </main>
@endsection
