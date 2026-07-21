{{--
Component: schedule-drawer
$schedule array Grouped by day: [{day, day_full, times[]}, ...]
$season string
$accentColor string Optional. Hex color used to accent session markers; falls back to a default blue.

Relies on scheduleOpen from the parent program-card x-data scope.
--}}

<div x-show="scheduleOpen" x-collapse class="bg-stone-50 border-t-[1.5px] border-stone-200"
  :aria-hidden="(!scheduleOpen).toString()">
  <div class="px-6 py-4">

    <p class="font-mono text-[10px] uppercase tracking-[2px] text-stone-500 mb-3 pb-2 border-b border-stone-200">
      {{ ucfirst($season !== 'both' ? $season : 'Current') }} Schedule
    </p>
    
    @if(count($sessions) > 0)
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-5">
        @foreach($sessions as $session)
          <div class="bg-white border-[1.5px] border-stone-200 rounded-lg pl-3 pr-3.5 py-2.5 max-w-xs"
            style="border-left: 3px solid {{ $accentColor ?? '#3893de' }};">
            <p class="text-[13px] font-semibold text-stone-700 m-0">
              {{ $session['title'] }}
            </p>
            <p class="flex items-center gap-1.5 text-[12px] font-medium text-stone-600 mt-1">
              <svg class="shrink-0" width="13" height="13" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <rect x="2" y="3" width="12" height="11" rx="1.5" stroke="currentColor" stroke-width="1.3" />
                <path d="M2 6.5h12" stroke="currentColor" stroke-width="1.3" />
                <path d="M5 1.5v3M11 1.5v3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
              </svg>
              {{ $session['start_date'] }} &ndash; {{ $session['end_date'] }}
            </p>
            @if(!empty($session['note']))
              <p class="flex items-start gap-1.5 text-[12px] text-stone-600 leading-snug mt-1.5">
                <svg class="shrink-0 mt-0.5" width="13" height="13" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                  <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.3" />
                  <path d="M8 7.25v4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                  <circle cx="8" cy="4.9" r="0.9" fill="currentColor" />
                </svg>
                {{ $session['note'] }}
              </p>
            @endif
          </div>
        @endforeach
      </div>
    @endif

    @if(count($schedule) > 0)
      <div class="flex flex-col gap-3">
        @foreach($schedule as $day => $dayInfo)
          @if(count($dayInfo['times']) > 0)
            <div>
              <p class="text-[11px] font-semibold uppercase tracking-wide text-stone-500 mb-1.5">
                {{ $dayInfo['day_full'] }}
              </p>
              <div class="flex flex-wrap gap-2">
                @foreach($dayInfo['times'] as $start_time => $time)
                  <span class="inline-flex flex-col items-start gap-1 bg-white border-[1.5px] border-stone-200 rounded-md px-3 py-1.5 text-[12px] text-stone-800">
                    <span class="inline-flex items-center gap-1">
                      {{ $time['start_time'] }} - {{ $time['end_time'] }}
                      @if(!empty($time['note']))
                        <span
                          x-data="{ tipOpen: false }"
                          class="relative inline-flex"
                          @mouseenter="tipOpen = true" @mouseleave="tipOpen = false"
                          @click.outside="tipOpen = false"
                        >
                          <button
                            type="button"
                            class="inline-flex items-center justify-center -m-2 p-2 rounded-full text-stone-400 hover:text-stone-600 focus:text-stone-600 focus:outline-none"
                            @click="tipOpen = !tipOpen" @focus="tipOpen = true" @blur="tipOpen = false"
                            aria-label="More details"
                            :aria-expanded="tipOpen.toString()"
                          >
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                              <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.3" />
                              <path d="M8 7.25v4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                              <circle cx="8" cy="4.9" r="0.9" fill="currentColor" />
                            </svg>
                          </button>
                          <span
                            x-show="tipOpen" x-transition.opacity.duration.150ms x-cloak
                            class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-2 w-40 rounded-lg bg-stone-800 text-white text-[11px] font-normal leading-snug px-2.5 py-2 shadow-lg normal-case tracking-normal"
                            role="tooltip"
                          >
                            {{ $time['note'] }}
                          </span>
                        </span>
                      @endif
                    </span>
                    @if(!empty($time['level_label']))
                      <span class="inline-flex items-center gap-1 px-1.5 py-[1px] rounded-full text-[10px] font-semibold"
                        style="background-color: {{ $time['level_color'] }}1a; color: {{ $time['level_color'] }};">
                        {{ $time['level_label'] }}
                      </span>
                    @endif
                  </span>
                @endforeach
              </div>
            </div>
          @endif
        @endforeach
      </div>
    @else
      <p class="text-[13px] text-stone-400 italic">Schedule to be announced.</p>
    @endif

  </div>
</div>