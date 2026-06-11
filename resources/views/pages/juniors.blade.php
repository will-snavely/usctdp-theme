{{--
  Template Name: Juniors Programs
  Variables injected by App\View\Composers\JuniorsComposer:
    $programs      array
    $levels        array
    $seasons       array
    $activeSeason  string
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())

  {{-- ── Alpine root component ── --}}
  <div
    x-data="{
      activeLevel: 'all',
      activeDay: 'all',
      activeSeason: '{{ $activeSeason }}',
      seasons: {{ json_encode($seasons) }},

      get sessionLabel() {
        return this.seasons.find(s => s.value === this.activeSeason)?.session ?? ''
      },

      setSeason(season) {
        const url = new URL(window.location.href)
        url.searchParams.set('season', season)
        window.location.href = url.toString()
      },

      matchesFilters(level, days) {
        const levelOk = this.activeLevel === 'all' || level === this.activeLevel
        const dayOk   = this.activeDay === 'all' || days.split(',').includes(this.activeDay)
        return levelOk && dayOk
      },

      get visibleCount() {
        return {{ collect($programs)->count() }}
          - [...document.querySelectorAll('[data-program-card]')]
            .filter(el => el.hasAttribute('hidden')).length
      }
    }"
  >
    {{-- ── LEVEL FILTER PILLS ── --}}
    <div class="bg-white border-b border-stone-200 px-8 py-3 flex items-center gap-4 overflow-x-auto"
         role="group" aria-label="Filter by level">
      <span class="font-mono text-[10px] tracking-[2px] uppercase text-stone-400 whitespace-nowrap shrink-0">
        Filter by level:
      </span>
      <div class="flex gap-2 flex-wrap">
        <button
          class="level-pill level-pill--all"
          :class="{ 'is-active': activeLevel === 'all' }"
          :aria-pressed="activeLevel === 'all' ? 'true' : 'false'"
          @click="activeLevel = 'all'"
          style="--pill-color: black"
        >

          <span class="inline-block w-2 h-2 rounded-full shrink-0"
                style="background: black" aria-hidden="true"></span>
          All Levels
        </button>

        @foreach($levels as $lvl)
          <button
            class="level-pill level-pill--{{ $lvl['level'] }}"
            :class="{ 'is-active': activeLevel === '{{ $lvl['level'] }}' }"
            :aria-pressed="activeLevel === '{{ $lvl['level'] }}' ? 'true' : 'false'"
            @click="activeLevel = '{{ $lvl['level'] }}'"
          >
            <span class="inline-block w-2 h-2 rounded-full shrink-0"
                  style="background: {{ $lvl['color'] }}" aria-hidden="true"></span>
            {{ $lvl['label'] }}
          </button>
        @endforeach
      </div>
    </div>

    {{-- ── CONTROLS BAR ── --}}
    <div class="max-w-4xl mx-auto px-8 mt-8 flex gap-4 items-center flex-wrap">
      {{-- Season toggle --}}
      <div class="flex bg-white border-[1.5px] border-stone-300 rounded-lg overflow-hidden"
           role="group" aria-label="Select season">
        @foreach($seasons as $season)
          <button
            class="px-5 py-2 text-[13px] font-medium transition-colors"
            :class="activeSeason === '{{ $season['value'] }}'
              ? 'bg-court-dark text-white'
              : 'text-stone-500 hover:text-stone-800'"
            :aria-pressed="activeSeason === '{{ $season['value'] }}' ? 'true' : 'false'"
            @click="setSeason('{{ $season['value'] }}')"
          >{{ $season['label'] }}</button>
        @endforeach
      </div>

      {{-- Session badge --}}
      <div class="ml-auto bg-court-clay text-white rounded-lg px-4 py-2 text-[12px] font-medium leading-snug"
           aria-live="polite">
        <strong class="block text-[11px] uppercase tracking-wider opacity-85">
          <span x-text="activeSeason.charAt(0).toUpperCase() + activeSeason.slice(1)"></span> Session
        </strong>
        <span x-text="sessionLabel"></span>
      </div>

    </div>

    {{-- ── PROGRAMS GRID ── --}}
    <main class="max-w-4xl lg:mx-16 mt-6 mb-16">
      @if(empty($programs))
        <p class="text-center py-16 text-stone-400">No programs available. Please check back soon.</p>
      @else
        <div class="flex flex-col gap-4">
          @foreach($programs as $program)
            @include('components.program-card', ['program' => $program])
          @endforeach
        </div>
      @endif

      {{-- No results message --}}
      <p class="text-center py-16 text-stone-400"
         x-show="!{{ empty($programs) ? 'false' : 'true' }} || $el.previousElementSibling.querySelectorAll('[data-program-card]:not([hidden])').length === 0"
         x-cloak>
        No programs match your filters. Try a different day or level.
      </p>
    </main>
  </div>{{-- /x-data --}}
  @endwhile
@endsection
