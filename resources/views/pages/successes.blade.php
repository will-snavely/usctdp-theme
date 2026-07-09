{{--
  Template Name: Successes
  Description: "Where Are They Now" page celebrating high school, college, and pro
  athletes who came up through the program.

  $stories below is placeholder content — replace with real alumni once available.
  Longer term this list is a good candidate for a custom post type / ACF repeater
  (mirroring how staff.archive.blade.php is fed by StaffRepository) rather than a
  hardcoded array in the template.
--}}

@extends('layouts.app')

@section('content')
@while(have_posts()) @php(the_post())

@php
  $levels = [
    'high_school' => ['label' => 'High School', 'color' => '#f97316'],
    'college'     => ['label' => 'College',     'color' => '#0092be'],
    'pro'         => ['label' => 'Pro',         'color' => '#E71C28'],
  ];

  // Placeholder alumni — swap in real profiles as they're collected.
  $stories = [
    [
      'name'        => '[Athlete Name]',
      'level'       => 'high_school',
      'headline'    => 'PIAA State Qualifier',
      'detail'      => 'Upper St. Clair High School • Class of 2026',
      'quote'       => 'USCTDP is where I fell in love with competing.',
      'image'       => null,
    ],
    [
      'name'        => '[Athlete Name]',
      'level'       => 'high_school',
      'headline'    => 'WPIAL Doubles Champion',
      'detail'      => 'Upper St. Clair High School • Class of 2027',
      'quote'       => null,
      'image'       => null,
    ],
    [
      'name'        => '[Athlete Name]',
      'level'       => 'college',
      'headline'    => 'NCAA Division I Commit',
      'detail'      => 'Now playing at [University] • Class of 2025',
      'quote'       => 'The coaches pushed me to become a student of the game.',
      'image'       => null,
    ],
    [
      'name'        => '[Athlete Name]',
      'level'       => 'college',
      'headline'    => 'Team Captain',
      'detail'      => '[University] Tennis • Class of 2024',
      'quote'       => null,
      'image'       => null,
    ],
    [
      'name'        => '[Athlete Name]',
      'level'       => 'pro',
      'headline'    => 'ITF Pro Circuit',
      'detail'      => 'Turned pro in [Year]',
      'quote'       => 'Every rally at USCTDP taught me something I still use today.',
      'image'       => null,
    ],
    [
      'name'        => '[Athlete Name]',
      'level'       => 'pro',
      'headline'    => 'ATP/WTA Ranked',
      'detail'      => 'Trained at USCTDP through [Year]',
      'quote'       => null,
      'image'       => null,
    ],
  ];
@endphp

<div x-data="{ filter: 'all' }" class="successes-page">

  {{-- ── Intro ── --}}
  <section class="mb-10 animate__animated animate__fadeIn">
    <h2 class="section-heading green text-2xl font-bold text-slate-800 mb-4">
      Where Are They Now
    </h2>
    <p class="text-slate-700 leading-relaxed max-w-3xl">
      From weekend clinics to state titles, college scholarships, and professional careers —
      these are some of the players who got their start on our courts. [Placeholder intro copy;
      update with a note about how alumni are selected/submitted.]
    </p>
  </section>

  {{-- ── Filter Bar ── --}}
  <div class="flex flex-wrap items-center gap-2 mb-8 animate__animated animate__fadeIn" style="animation-delay: 0.05s;">
    <button type="button" @click="filter = 'all'"
      class="filter-pill" :class="{ 'filter-pill--active': filter === 'all' }">
      All
    </button>
    @foreach($levels as $value => $meta)
      <button type="button" @click="filter = '{{ $value }}'"
        class="filter-pill" :class="{ 'filter-pill--active': filter === '{{ $value }}' }"
        style="--pill-color: {{ $meta['color'] }}">
        <span class="inline-block w-1.5 h-1.5 rounded-full shrink-0" style="background: {{ $meta['color'] }}" aria-hidden="true"></span>
        {{ $meta['label'] }}
      </button>
    @endforeach
  </div>

  {{-- ── Alumni Grid ── --}}
  @if(empty($stories))
    <p class="text-slate-500 italic">No success stories yet — check back soon.</p>
  @else
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
      @foreach($stories as $story)
        @php
          $levelMeta = $levels[$story['level']] ?? null;
          $initials = collect(explode(' ', preg_replace('/[\[\]]/', '', $story['name'])))
            ->map(fn($part) => mb_strtoupper(mb_substr($part, 0, 1)))
            ->take(2)
            ->implode('');
        @endphp
        <article
          x-show="filter === 'all' || filter === '{{ $story['level'] }}'"
          x-transition
          class="group flex flex-col rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-sm transition-[box-shadow,transform] duration-200 hover:shadow-lg hover:-translate-y-0.5"
          aria-label="{{ $story['name'] }}"
        >
          <div class="aspect-square overflow-hidden bg-slate-100">
            @if($story['image'])
              <img src="{{ $story['image'] }}" alt="Photo of {{ $story['name'] }}"
                class="w-full h-full object-cover block transition-transform duration-[350ms] ease-in-out group-hover:scale-[1.04]"
                loading="lazy" decoding="async">
            @else
              <div class="w-full h-full flex items-center justify-center bg-blue-50" aria-hidden="true">
                <span class="text-4xl font-bold text-blue-600 select-none">{{ $initials }}</span>
              </div>
            @endif
          </div>

          <div class="px-5 pt-4 pb-5 flex flex-col gap-2 flex-1">
            @if($levelMeta)
              <span class="inline-flex items-center gap-1.5 self-start px-2.5 py-0.5 rounded-full text-[11px] font-semibold border"
                style="background-color: {{ $levelMeta['color'] }}1a; color: {{ $levelMeta['color'] }}; border-color: {{ $levelMeta['color'] }}40;">
                <span class="inline-block w-1.5 h-1.5 rounded-full shrink-0" style="background: {{ $levelMeta['color'] }};" aria-hidden="true"></span>
                {{ $levelMeta['label'] }}
              </span>
            @endif

            <h3 class="text-lg font-bold text-slate-800 m-0">{{ $story['name'] }}</h3>
            <p class="text-sm font-semibold text-slate-700 m-0">{{ $story['headline'] }}</p>
            <p class="text-sm text-slate-500 m-0">{{ $story['detail'] }}</p>

            @if($story['quote'])
              <p class="text-sm italic text-slate-600 px-3 py-2.5 border-l-2 border-[#0092be] mt-1 bg-slate-50 rounded-lg">
                &ldquo;{{ $story['quote'] }}&rdquo;
              </p>
            @endif
          </div>
        </article>
      @endforeach
    </div>
  @endif

  {{-- ── Share Your Story CTA ── --}}
  <section class="mt-16 animate__animated animate__fadeIn" style="animation-delay: 0.15s;">
    <div class="rounded-2xl bg-slate-900 text-white px-8 py-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
      <div>
        <h2 class="text-2xl font-black text-white uppercase tracking-tight mt-2 mb-2">Are You a USCTDP Alum?</h2>
        <p class="text-slate-300 text-sm leading-relaxed max-w-md">
          We'd love to feature your story. Let us know what you're up to — on the court or off.
        </p>
      </div>
      <div class="flex flex-col sm:flex-row gap-3 shrink-0">
        <a href="{{ get_permalink(get_page_by_path('contact')) ?: '/contact' }}"
          class="px-6 py-3 bg-[#0092be] hover:bg-[#007aa0] text-white font-semibold rounded-xl transition-colors shadow text-center">
          Share Your Story
        </a>
      </div>
    </div>
  </section>

</div>

@endwhile
@endsection
