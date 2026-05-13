{{--
  Component: program-card
  Usage: @include('components.program-card', ['program' => $program])

  $program is a view-data array from ProgramRepository::toViewData():
    id, name, description, level, level_label, ball_color,
    age_range, season, price_one_day, price_two_day,
    product_url, schedule, schedule_days
--}}

<article
  class="program-card program-card--{{ $program['level'] }}"
  data-level="{{ $program['level'] }}"
  data-days="{{ implode(',', array_keys($program['schedule_days'])) }}"
  aria-label="{{ $program['name'] }}"
>
  {{-- Colored top accent bar --}}
  <div class="program-card__accent" style="background: {{ $program['ball_color'] }};" aria-hidden="true"></div>

  <div class="program-card__body">

    <div class="program-card__info">

      {{-- Level badge --}}
      @include('components.level-badge', [
        'level'      => $program['level'],
        'label'      => $program['level_label'],
        'ball_color' => $program['ball_color'],
      ])

      <h2 class="program-card__title">{{ $program['name'] }}</h2>

      <p class="program-card__ages">{{ $program['age_range'] }}</p>

      <p class="program-card__desc">{{ $program['description'] }}</p>

    </div>

    {{-- Pricing --}}
    <div class="program-card__pricing" aria-label="Pricing">
      <p class="program-card__price-from">From</p>
      <p class="program-card__price" style="color: {{ $program['ball_color'] }};">
        ${{ number_format($program['price_one_day'], 0) }}
      </p>
      <p class="program-card__price-period">per week · 1 day</p>
      @if($program['price_two_day'])
        <p class="program-card__price-alt">
          ${{ number_format($program['price_two_day'], 0) }} / 2 days
        </p>
      @endif
    </div>

  </div>{{-- /.program-card__body --}}

  {{-- Footer: schedule toggle + register CTA --}}
  <div class="program-card__footer">

    <button
      class="schedule-toggle"
      aria-expanded="false"
      aria-controls="schedule-{{ $program['id'] }}"
    >
      <svg class="schedule-toggle__icon" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
        <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      <span class="schedule-toggle__label">View Schedule</span>
    </button>

    <a
      href="{{ $program['product_url'] }}"
      class="btn btn--register"
      aria-label="Register for {{ $program['name'] }}"
    >
      Register &rarr;
    </a>

  </div>

  {{-- Schedule drawer --}}
  @include('components.schedule-drawer', [
    'programId' => $program['id'],
    'schedule'  => $program['schedule'],
    'season'    => $program['season'],
  ])

</article>
