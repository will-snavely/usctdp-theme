{{--
Component: schedule-drawer
$schedule array Grouped by day: [{day, day_full, times[]}, ...]
$season string

Relies on scheduleOpen from the parent program-card x-data scope.
--}}

@php
  ksort($schedule);
@endphp

<div x-show="scheduleOpen" x-collapse class="bg-stone-50 border-t-[1.5px] border-stone-200"
  :aria-hidden="(!scheduleOpen).toString()">
  <div class="px-6 py-4">

    <p class="font-mono text-[10px] uppercase tracking-[2px] text-stone-400 mb-4">
      {{ ucfirst($season !== 'both' ? $season : 'Current') }} Schedule
    </p>

    @if(count($schedule) > 0)
      <div class="flex flex-col gap-3">
        @foreach($schedule as $day => $dayInfo)
          @if(count($dayInfo['times']) > 0)
            <div>
              <p class="text-[11px] font-semibold uppercase tracking-wide text-stone-500 mb-1.5">
                {{ $dayInfo['day_full'] }}
              </p>
              <div class="flex flex-wrap gap-2">
                @foreach($dayInfo['times'] as $time)
                  <span class="bg-white border-[1.5px] border-stone-200 rounded-md px-3 py-1.5 text-[12px] text-stone-800">
                    {{ $time['start_time'] }} - {{ $time['end_time'] }}
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