{{--
  Programs List View
  Route: /programming/schedule/  (age_group, type, level all optional query params)

  Legacy /programming/{juniors,adults}/{type?}/ URLs 301-redirect here with
  the equivalent query params — see routes/web.php.

  Variables injected by App\View\Composers\ProgramsComposer:
    $programs         array    View-ready program arrays
    $activeFilters    array    [param => value, ...] currently-active filters
    $clearUrl         string   URL with all filters cleared
    $filterUrl        Closure  (string $param, string $value): string — toggles a pill
    $groups           array    [{label, param, options}, ...] for <x-filter-bar>
    $accents          array    [program code => {card-bg, icon}, ...]
--}}

@extends('layouts.app')

@section('content')

  {{-- ── Breadcrumb ── --}}
  <nav class="flex items-center gap-2 text-xs text-slate-400 mb-4 px-1 animate__animated animate__fadeIn" aria-label="Breadcrumb">
    <a href="{{ home_url('/programming/') }}" class="hover:text-blue-500 transition-colors no-underline">
      Programming
    </a>
    <span aria-hidden="true">/</span>
    <span class="text-slate-600 font-medium">Schedule</span>
  </nav>

  {{-- ── FILTER BAR ── --}}
  <x-filter-bar :groups="$groups" :active-filters="$activeFilters" :filter-url="$filterUrl" :clear-url="$clearUrl" />

  {{-- ── PROGRAMS ── --}}
  <main class="max-w-4xl mx-auto px-2 sm:px-8 mt-8 mb-16 animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
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
