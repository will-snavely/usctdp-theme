{{--
  Component: schedule-drawer
  Usage: @include('components.schedule-drawer', [...])

  $programId  int     Unique ID for aria-controls linkage
  $schedule   array   [{day, day_full, time}, ...]
  $season     string  'spring' | 'summer' | 'both'
--}}

<div
  class="schedule-drawer"
  id="schedule-{{ $programId }}"
  aria-hidden="true"
  hidden
>
  <div class="schedule-drawer__inner">

    <p class="schedule-drawer__heading">
      {{ ucfirst($season !== 'both' ? $season : 'Current') }} Schedule
    </p>

    @if(count($schedule) > 0)
      <ul class="schedule-slots" aria-label="Available time slots">
        @foreach($schedule as $slot)
          <li class="schedule-slot">
            <span class="schedule-slot__day">{{ $slot['day'] }}</span>
            <span class="schedule-slot__time">{{ $slot['time'] }}</span>
          </li>
        @endforeach
      </ul>
    @else
      <p class="schedule-drawer__empty">Schedule to be announced.</p>
    @endif

  </div>
</div>
