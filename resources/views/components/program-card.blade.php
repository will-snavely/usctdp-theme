{{--
  Component: program-card
  Usage: @include('components.program-card', ['program' => $program])
--}}

@php
  $typeLabel = match($program['type'] ?? '') {
    'cardio'  => 'Cardio Tennis',
    default   => ucfirst($program['type'] ?? ''),
  };
  $accentColor = $accent['card-bg'] ?? $program['ball_color'];
  $iconUrl = isset($accent['icon']) ? Vite::asset('resources/images/' . $accent['icon']) : null;
@endphp

<article
  data-program-card
  x-transition:enter="transition duration-200 ease-out"
  x-transition:enter-start="opacity-0 translate-y-2"
  x-transition:enter-end="opacity-100 translate-y-0"
  x-data="{ scheduleOpen: false }"
  class="bg-white rounded-2xl border-[1.5px] border-stone-200 overflow-hidden transition-shadow duration-200 hover:shadow-xl"
  aria-label="{{ $program['name'] }}"
>

  {{-- Accent bar --}}
  <div class="h-[5px]" style="background: {{ $accentColor }};" aria-hidden="true"></div>

  {{-- Body --}}
  <div class="p-6 pb-0">

    {{-- Name + age range --}}
    <div class="flex items-center gap-3 flex-wrap mb-2">
      @if ($iconUrl)
        <img src="{{ $iconUrl }}" alt="" class="w-8 h-8 shrink-0" aria-hidden="true">
      @endif
      <h2 class="font-display text-[26px] tracking-wide leading-none text-stone-900 m-0">
        {{ $program['name'] }}
      </h2>
      <span class="text-sm font-semibold text-stone-500">Ages {{ $program['age_range'] }}</span>
    </div>

    {{-- Level + type pills --}}
    <div class="flex gap-2 flex-wrap mb-3">
      @if (!empty($program['level_label']))
        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold border"
          style="background-color: {{ $program['ball_color'] }}1a; color: {{ $program['ball_color'] }}; border-color: {{ $program['ball_color'] }}40;">
          <span class="inline-block w-1.5 h-1.5 rounded-full shrink-0" style="background: {{ $program['ball_color'] }};" aria-hidden="true"></span>
          {{ $program['level_label'] }}
        </span>
      @endif
      @if ($typeLabel)
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-stone-100 text-stone-500 border border-stone-200">
          {{ $typeLabel }}
        </span>
      @endif
    </div>

    <p class="text-[14px] text-stone-600 leading-relaxed">
      {{ $program['description'] }}
    </p>

  </div>

  {{-- Footer --}}
  <div class="px-6 py-4 flex items-center justify-between gap-4 flex-wrap">
    <button
      class="inline-flex items-center gap-1.5 bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 rounded-md px-3 py-1.5 text-[12px] font-medium transition-colors"
      :aria-expanded="scheduleOpen.toString()" @click="scheduleOpen = !scheduleOpen">
      <svg class="transition-transform duration-200 shrink-0" :class="{ 'rotate-180': scheduleOpen }" width="12"
        height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
        <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
      </svg>
      <span x-text="scheduleOpen ? 'Hide Schedule' : 'View Schedule'"></span>
    </button>
    <a href="{{ $program['product_url'] }}"
      class="inline-block bg-blue-900 hover:bg-blue-950 text-white rounded-lg px-5 py-2 text-[12px] font-bold tracking-widest uppercase transition-colors no-underline"
      aria-label="Register for {{ $program['name'] }}">
      Register &rarr;
    </a>
  </div>

  {{-- Schedule drawer --}}
  @include('components.schedule-drawer', [
    'schedule' => $program['schedule'],
    'sessions' => $program['sessions'],
    'season'   => $program['season'],
    'accentColor' => $accentColor,
  ])

</article>
