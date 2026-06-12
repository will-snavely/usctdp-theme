{{--
  Component: program-card
  Usage: @include('components.program-card', ['program' => $program])
--}}

<article
  data-program-card
  x-transition:enter="transition duration-200 ease-out"
  x-transition:enter-start="opacity-0 translate-y-2"
  x-transition:enter-end="opacity-100 translate-y-0"
  x-data="{ scheduleOpen: false }"
  class="bg-white rounded-2xl border-[1.5px] border-stone-200 overflow-hidden transition-shadow duration-200 hover:shadow-xl"
  aria-label="{{ $program['name'] }}"
>
  {{-- Colored accent bar --}}
  <div class="h-[5px]" style="background: {{ $program['ball_color'] }};" aria-hidden="true"></div>

  <div class="p-6 pb-0 grid grid-cols-[1fr_auto] gap-4 items-start">

    <div class="min-w-0">
      <h2 class="font-display text-[26px] tracking-wide leading-none mt-2 mb-1 text-stone-900">
        {{ $program['name'] }}
      </h2>
      <p class="font-mono text-[11px] tracking-wide text-stone-400 mb-2">
        {{ $program['age_range'] }}
      </p>
      <p class="text-[14px] text-stone-600 leading-relaxed max-w-xl">
        {{ $program['description'] }}
      </p>
    </div>

    {{-- Pricing --}}
    <div class="text-right shrink-0" aria-label="Pricing">
      <p class="text-[10px] font-semibold uppercase tracking-widest text-stone-400 mb-0.5">From</p>
      <p class="font-display text-[32px] leading-none" style="color: {{ $program['ball_color'] }};">
        ${{ number_format($program['price_one_day'], 0) }}
      </p>
      <p class="text-[11px] text-stone-400 mt-0.5">per week · 1 day</p>
      @if($program['price_two_day'])
        <p class="text-[11px] text-stone-400 mt-1 italic">
          ${{ number_format($program['price_two_day'], 0) }} / 2 days
        </p>
      @endif
    </div>

  </div>

  {{-- Footer --}}
  <div class="px-6 py-4 flex items-center justify-between gap-4 flex-wrap">
    <button
      class="inline-flex items-center  gap-1.5 bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 rounded-md px-3 py-1.5 text-[12px] font-medium transition-colors"
      :aria-expanded="scheduleOpen.toString()" @click="scheduleOpen = !scheduleOpen">
      <svg class="transition-transform duration-200 shrink-0" :class="{ 'rotate-180': scheduleOpen }" width="12"
        height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
        <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
      </svg>
      <span x-text="scheduleOpen ? 'Hide Schedule' : 'View Schedule'"></span>
    </button>
    <a href="{{ $program['product_url'] }}"
      class="inline-block bg-court-dark hover:bg-court-clay text-white rounded-lg px-5 py-2 text-[13px] font-semibold tracking-wide transition-colors no-underline"
      aria-label="Register for {{ $program['name'] }}">
      Register &rarr;
    </a>
  </div>

  {{-- Schedule drawer --}}
  @include('components.schedule-drawer', [
  'schedule' => $program['schedule'],
  'sessions' => $program['sessions'],
  'season' => $program['season'],
])

</article>
