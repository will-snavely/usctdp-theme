{{--
Component: level-badge
Usage: @include('components.level-badge', [...])

$level string Level slug (tiny, red, orange, teen, green, yellow)
$label string Human-readable label
$ball_color string Hex color for the dot
--}}

<span class="level-badge level-badge--{{ $level }}" style="--badge-color: {{ $ball_color }};"
  aria-label="Level: {{ $label }}">
  <span class="level-badge__dot" aria-hidden="true"></span>
  {{ $label }}
</span>