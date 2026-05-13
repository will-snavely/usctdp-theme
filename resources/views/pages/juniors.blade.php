{{--
Template Name: Juniors Programs
Description: Junior development programs listing page.

Variables injected by App\View\Composers\JuniorsComposer:
$programs array View-ready program arrays
$levels array [{level, label, color}, ...]
$seasons array [{value, label, session}, ...]
$activeSeason string 'spring' | 'summer'
$availableDays array [{code, label}, ...]
--}}

@extends('layouts.app')
@section('content')
@while(have_posts()) @php(the_post())

{{-- ── LEVEL FILTER PILLS ── --}}
<div class="level-filter" role="group" aria-label="Filter by level">
  <span class="level-filter__label">Filter by level:</span>
  <div class="level-filter__pills">
    {{-- "All" pill --}}
    <button class="level-pill level-pill--all is-active" data-level="all" aria-pressed="true">
      All Levels
    </button>
    @foreach($levels as $lvl)
      <button class="level-pill level-pill--{{ $lvl['level'] }}" data-level="{{ $lvl['level'] }}" aria-pressed="false"
        style="--pill-color: {{ $lvl['color'] }}">
        <span class="level-pill__dot" aria-hidden="true"></span>
        {{ $lvl['label'] }}
      </button>
    @endforeach
  </div>
</div>

{{-- ── CONTROLS BAR ── --}}
<div class="programs-controls">

  {{-- Season toggle --}}
  <div class="season-toggle" role="group" aria-label="Select season">
    @foreach($seasons as $season)
      <button class="season-toggle__btn {{ $season['value'] === $activeSeason ? 'is-active' : '' }}"
        data-season="{{ $season['value'] }}" data-session="{{ $season['session'] }}"
        aria-pressed="{{ $season['value'] === $activeSeason ? 'true' : 'false' }}">
        {{ $season['label'] }}
      </button>
    @endforeach
  </div>
</div>

{{-- ── PROGRAMS GRID ── --}}
<main class="programs-main" id="programs-main">
  @if(empty($programs))
    <p class="programs-empty">No programs available. Please check back soon.</p>
  @else
    <div class="programs-grid" id="js-programs-grid">
      @foreach($programs as $program)
        @include('components.program-card', ['program' => $program])
      @endforeach
    </div>
  @endif

  <p class="programs-no-results" id="js-no-results" hidden>
    No programs match your filters. Try a different day or level.
  </p>

</main>

@endwhile
@endsection